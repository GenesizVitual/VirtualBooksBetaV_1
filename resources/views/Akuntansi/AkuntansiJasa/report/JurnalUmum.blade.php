<h1>{{ $judul }}</h1>

<table border="1">
    <thead>
        <tr>
            <td>Nomor Urut</td>
            <td>Tanggal</td>
            <td>Kode Transaksi/Kode Perkiraan</td>
            <td>Keterangan</td>
            <td>Debet</td>
            <td>Kredit</td>
        </tr>
    </thead>

    <tbody>
        @foreach($data['data_jurnal'] as $jurnalUmum)
        <tr>
            <td>{{ $jurnalUmum['no'] }}</td>
            <td>{{ $jurnalUmum['tanggal_transaksi'] }}</td>
            <td>{{ $jurnalUmum['kode'] }}</td>
            <td colspan="3">{{ $jurnalUmum['jurnal'] }}</td>
        </tr>
            @foreach($jurnalUmum['data'] as $data_akun)
                <tr>
                    <td colspan="2"></td>
                    <td>{{ $data_akun['kode_akun'] }}</td>
                    <td>{{ $data_akun['akun'] }}</td>
                    <td>{{ $data_akun['jum_debet'] }}</td>
                    <td>{{ $data_akun['jum_kredit'] }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align: center">Total</td>
            <td >{{ $data['total_debet'] }}</td>
            <td >{{ $data['total_kredit'] }}</td>
        </tr>
    </tfoot>
</table>