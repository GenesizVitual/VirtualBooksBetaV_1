<?php

namespace App\Http\Controllers;

use App\Model\Persediaan\Pembayaran;
use Illuminate\Http\Request;

use Session;

use App\User as pengguna;
use App\Model\Persediaan\Instansi;
use App\Model\Persediaan\PembelianBarang;
use Hash;


class User extends Controller
{
    //
    public $paket = [
        '1' => [
            'ket'=>'Jumlah Pembelian Senilai 50jt - 150jt',
            'val'=> 120000
        ],
        '2' => [
            'ket'=>'Jumlah Pembelian Senilai 150jt - 550jt',
            'val'=> 260000
        ],
        '3' => [
            'ket'=>'Jumlah Pembelian Senilai diatas 1 milyar',
            'val'=> 400000
        ],
        '4' =>[
            'ket'=> 'Paket Anonymous',
            'val'=> 0
        ]
    ];

    public function login(){
        return view('page_login_regis.login');
    }

    public function Usercheck(Request $req)
    {
        $model = pengguna::where('email', $req->email)->first();

        if(empty($model)){
            return redirect('login')->with('message_error','Maaf, Email anda belum terdaftar');
        }

        $kode_uud = $this->unique_code(4);
        if(Hash::check($req->pass, $model->password)){
            $req->session()->put('user_id', $model->id);
            $req->session()->put('kode', $model->id);
            $req->session()->put('level', $model->level);
            $req->session()->put('name', $model->name);
            # Pengisian Instansi diawal aplikasi dimulai

            if($model->status_syarat == '0')
            {
                return redirect('pengaturan-awal')->with('message_info','Lengkapilah formulir pengaturan awal anda...!');
            }

            # Set session id Instansi
            if(!empty($model->linkToInstansi->id)){
                $req->session()->put('id_instansi', $model->linkToInstansi->id);
                $req->session()->put('status_paket', $model->linkToInstansi->paket_langganan);
            }

            $model_instansi = Instansi::find(Session::get('id_instansi'));

            $cek_thn_anggaran = $model_instansi->LinkToTahunAnggaran->where('status','1')->first();

            if(empty($cek_thn_anggaran)){
                return redirect('penentuan-tahun-anggaran')->with('message_info','Silahkah, masukan tahun anggaran');
            }

            # Check Persyaratan Berlangganan
            if($model_instansi->status_langganan == 'false')
            {
                return view('Persediaan.penentuan_paket_langganan',['paket'=> $this->paket])->with('message_info','Pilihlah paket langganan anda...!');
            }

            if($model_instansi->trial_aktif == 'true')
            {
                return view('Persediaan.penentuan_konfirmasi_pembayaran', ['data'=>$model_instansi,'kode_pembayaran'=>$kode_uud, 'paket'=> $this->paket]);
            }

            if($model_instansi->trial_aktif == 'confirmasi')
            {
                return view('Persediaan.pembayaran_sedang_d_konfirmasi', ['data'=>$model_instansi,'kode_pembayaran'=>$kode_uud, 'paket'=> $this->paket]);
            }

            $date_new =date_create(date('Y-m-d'));
            $date_after = date('Y-m-d',strtotime($model_instansi->durasi));
            $date = date_create($date_after);
            $sisa_hari = date_diff($date_new, $date);

            $req->session()->put('durasi', $sisa_hari->format("%R%a Hari"));

            return redirect('dashboard')->with('message_success','Selamat Datang '.$model->name);
        }else{
            return redirect('login')->with('message_error','Maaf, Email atau password anda salah. silahkah coba lagi');
        }
    }

    public function register(){
        return view('page_login_regis.register');
    }

    public function store(Request $req)
    {

        $this->validate($req,[
           'name'=>'required',
           'email'=> 'required|unique:users,email|max:255',
           'pass' => 'required'
        ]);

        if($this->check_email($req)==true){
            return redirect('register')->with('message_error','Email anda telah terdaftar');
        }

        $model = new pengguna();
        $model->name = $req->name;
        $model->email = $req->email;
        $model->password = bcrypt($req->pass);
        $model->level = '1';
        if($model->save())
        {
            if (empty($req->session()->user_id)){
                return redirect('login')->with('message_success','Silahkan login 5 menit kemudian');
            }else{
                return "User telah ditambahkan";
            }
        }
    }

    public function upDatePaketLangganan(Request $req)
    {
        try{

            $model = Instansi::findOrFail(Session::get('id_instansi'));
            $model->paket_langganan = $req->paket_langganan;
            $model->nilai_langganan = $this->paket[$req->paket_langganan]['val'];
            $model->status_langganan ='true';
            $model->trial_aktif ='false';
            $model->durasi =date('Y-m-d', strtotime('+31 days'));
            if($model->save()){
                return redirect('login')->with('message_success','Silahkan login 5 menit kemudian');
            }
        }catch (Throwable $e){
            return $e;
        }
    }

    public function konfirmasiPembayaran(Request $req){
        try{
            $this->validate($req,[
                'bukti_pembayaran'=>'required|image|mimes:jpeg,jpg,png|max:25000',
            ]);
            $gambar= $req->bukti_pembayaran;
            $imagename = time() . '.' . $gambar->getClientOriginalExtension();
            $model = Pembayaran::find(Session::get('id_instansi'));
            if(!empty($model->bukti_pembayaran))
            {
                $file_path =public_path('persediaan/bukti_pembayaran').'/' . $model->gambar;
                if (file_exists($file_path)) {
                    @unlink($file_path);
                }
            }
            $new_model = Pembayaran::updateOrCreate(
                [
                    'id_instansi'=>Session::get('id_instansi'),
                    'tgl_pembayaran'=>$req->tgl_pembayaran,
                    'kode_bayar'=> $req->kode_bayar
                ],
                [
                    'bukti_pembayaran'=>$imagename,
                    'status_bayar'=> 'aktif'
                ]
            );
            if($new_model->save()){
                $gambar->move(public_path('persediaan/bukti_pembayaran/'), $imagename);
                $model = Instansi::findOrFail($new_model->id_instansi);
                $model->trial_aktif ='confirmasi';
                $model->save();
                return redirect('login')->with('message_success','Terimah kasih telah melakukan pembayaran untuk layanan kami. Saat ini kami belum mengaktifkan akun anda sebelum pembayaran
                sudah di kami terima');
            }
        }catch (Throwable $e){
            return $e;
        }
    }

    public function check_email($req){
        $model = pengguna::where('email',$req->email)->where('level',1)->first();
        if(empty($model)){
            return false;
        }else{
            return true;
        }
    }

    private function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function LogOut(Request $req){
        $req->session()->flush();
        return redirect('login')->with('message_success','Anda telah keluar dari aplikasi');
    }
}
