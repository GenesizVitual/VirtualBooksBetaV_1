<!doctype html>
<html lang="ri">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Surat Pesanan</title>

    <style>
        @page {
            margin: 20px;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
                background-color: white;
            }
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
            background-color: white;
            width: 210mm;
            /*height: 297mm;*/
        }

        td{
            padding: 2px;
        }

    </style>
</head>
<body style="background-color: grey">
<center>
    <div class="page">

            <table style="width: 90%;">
                <tbody>
                    <tr>
                        <td style="width: 15%;">
                            <img src="{{ asset('persediaan/logo/'.$nota->linkToInstansi->logo) }}" style="width:85%;">
                        </td>
                        <td>
                            <h3 style="text-align: center">
                                {{ strtoupper($nota->linkToInstansi->name_instansi) }}
                                <br>
                                 {{ strtoupper('Provinsi '.$nota->linkToInstansi->BelongsToProvinsi->nama) }}

                                @if($nota->linkToInstansi->level_instansi==1)
                                    {{ strtoupper('Kabupaten '.$nota->linkToInstansi->BelongsToKabupatenKot->nama)}}
                                @endif

                                @if($nota->linkToInstansi->level_instansi==2)
                                    {{ strtoupper('Kota '.$nota->linkToInstansi->BelongsToKabupatenKot->nama) }}
                                @endif

                                <br><label style="font-weight: normal;">Alamat: {{ $nota->linkToInstansi->alamat }}</label>
                                <br><label style="font-weight: normal;">No.Telp/Fax: {{ $nota->linkToInstansi->no_telp }} @if(!empty($nota->linkToInstansi->fax)) - {{ $nota->linkToInstansi->fax }} @endif</label>
                            </h3>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <hr style="border: 3px solid black;">
                            <hr style="border: 1px solid black;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h4 style="text-align: center;font-weight: bold">
                                <label style="text-decoration: underline">
                                    SURAT PESANAN (SP)
                                </label>
                                <br>
                                <label>
                                    PERMINTAAN PEMBELIAN
                                </label>
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>Nomor</td>
                                    <td>:</td>
                                    <td>@if(!empty($nota->linkToSuratPesanan->nomor_surat)) {{ $nota->linkToSuratPesanan->nomor_surat }} @endif</td>
                                </tr>
                                <tr>
                                    <td>Paket Pekerjaan</td>
                                    <td>:</td>
                                    <td>{{ $nota->linkToNotaBelongsToTbk->kode }} - {{ $nota->linkToNotaBelongsToTbk->jenis_tbk }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p style="padding-left: 4%">Yang bertanda tangan dibawah ini:</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td style="width: 75px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td style="width: 400px">
                                        @if(!empty($nota->linkToSuratPesanan->linkToBerwenang->nama)) {{ $nota->linkToSuratPesanan->linkToBerwenang->nama }}  @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td style="width: 10px">:</td>
                                    <td style="width: 400px">@if(!empty($nota->linkToSuratPesanan->alamat)) {{ $nota->linkToSuratPesanan->alamat }} @else {{ $nota->linkToInstansi->alamat }}  @endif</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td style="width: 10px">:</td>
                                    <td style="width: 400px">@if(!empty($nota->linkToSuratPesanan->jabatan)) {{ $nota->linkToSuratPesanan->jabatan }} @endif</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label>Dalam Hal ini mewakili Pengguna Barang/Jasa pada {{ $nota->linkToInstansi->name_instansi }} Selanjutnya disebut:</label><label id="jabatan"></label><br>
                                        <label style="padding-left: 5%">Dengan Ini memerintahkah :</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 75px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td style="width: 400px">{{ $nota->linkToPenyedia->penyedia }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td style="width: 10px">:</td>
                                    <td style="width: 400px">{{ $nota->linkToPenyedia->alamat }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label style="padding-left: 4%">Yang dalam hal ini diwakili oleh : {{ $nota->linkToPenyedia->pimpinan }} selanjutnya disebut sebagai penyedia,</label>
                                        <label>Untuk mengirimkan barang dengan memperhatikan ketentuan-ketentuan sebagai berikut:</label>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <ol style="font-weight: normal">
                                <li> Rincian Barang:
                                    <div>
                                        <table style="border-collapse: collapse;width: 100%" border="1">
                                            <thead>
                                            <tr style="text-align: center">
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Kuantitas</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan (Rp)</th>
                                                <th>Sub Total(Rp)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($no=1)
                                            @foreach($data as $data)
                                                <tr>
                                                    <td style="text-align: center">{{ $data[0] }}</td>
                                                    <td>{{ $data[1] }}</td>
                                                    <td>{{ $data[2] }}</td>
                                                    <td>{{ $data[3] }}</td>
                                                    <td>{{ $data[4] }}</td>
                                                    <td>{{ $data[5] }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="5" style="width: 555px">Total Pembelian </th>
                                                <th >{{ $total_sebelum_bajak }}</th>
                                            </tr>
                                            @if($nota->pph !=0 || $nota->ppn !=0 )
                                                <tr style="background-color: greenyellow">
                                                    <th rowspan="2">Pajak</th>
                                                    <th colspan="2">PPN 10%</th>
                                                    <th colspan="2">PPH 1.5%</th>
                                                    <th >Sub Total Pajak</th>
                                                </tr>
                                                <tr style="background-color: greenyellow">
                                                    <td colspan="2">{{ $ppn }}</td>
                                                    <td colspan="2">{{ $pph }}</td>
                                                    <td >{{ $total_pajak }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th colspan="5">Total Pembelian Setelah Pajak </th>
                                                <th >{{ $total_beli }}</th>
                                            </tr>
                                            <tr style="background-color: coral; text-align: center">
                                                <td colspan="6">Terbilang : {{ $terbilang }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        {{--<table style="width: 100%" >--}}
                                            {{--<tbody>--}}
                                            {{----}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    </div>
                                </li>
                                <li>
                                    Tanggal barang diterima: @if(!empty($nota->linkToSuratPesanan->tanggal_terima)) {{ date('d-m-Y', strtotime($nota->linkToSuratPesanan->tanggal_terima)) }} @endif
                                </li>
                                @if(!empty($nota->linkToSuratPesanan->syarat))
                                <li>
                                    Syarat-Syarat Pekerjaan:
                                    <p>{{ $nota->linkToSuratPesanan->syarat }}</p>
                                </li>
                                @endif
                                <li>
                                    Waktu Penyelesaian: <label style="font-weight: bold">@if(!empty($nota->linkToSuratPesanan->tanggal_terima)) {{ date('d-m-Y', strtotime($nota->linkToSuratPesanan->tanggal_terima)) }} @endif</label> sampai dengan <label style="font-weight: bold">@if(!empty($nota->linkToSuratPesanan->tanggal_penyelesaian)) {{ date('d-m-Y', strtotime($nota->linkToSuratPesanan->tanggal_penyelesaian)) }} @endif</label>
                                </li>
                                <li>
                                    Tempat Pelaksanaan Pekerjaan: {{ $nota->linkToPenyedia->alamat }}
                                </li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table style="width: 100%; text-align: center">
                                <tr>
                                    <td>
                                        <p style="font-weight:bold">@if(!empty($nota->linkToSuratPesanan->judul_penyedia)) {{ $nota->linkToSuratPesanan->judul_penyedia }} @else {{ "Menerima dan Menyetujui" }} @endif</p>
                                        <br>
                                        <br>
                                        <p><label style="text-decoration: underline;font-weight:bold ">{{ $nota->linkToPenyedia->pimpinan }}</label><br><label style="font-weight:bold">Perwakilan {{ $nota->linkToPenyedia->penyedia }}</label></p>
                                    </td>
                                    <td>
                                        <p  style="font-weight:bold">@if(!empty($nota->linkToSuratPesanan->judul_jabatan)) {{ $nota->linkToSuratPesanan->judul_jabatan }} @else {{ "Pejabat Anggaran" }} @endif</p>
                                        <br>
                                        <br>
                                        <p><label style="text-decoration: underline;font-weight:bold ">@if(!empty($nota->linkToSuratPesanan->linkToBerwenang->nama)) {{ $nota->linkToSuratPesanan->linkToBerwenang->nama }} @endif</label><br><label style="font-weight:bold">@if(!empty($nota->linkToSuratPesanan->linkToBerwenang->nip)) NIP:{{ $nota->linkToSuratPesanan->linkToBerwenang->nip }} @endif</label></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>

    </div>
</center>
</body>
</html>