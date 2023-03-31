<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Keluar</title>

    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body style="background-color: white;" onload="window.print()">

    <style>
        .line-title {
            border: 0;
            border-style: insert;
            border-top: 1px solid #000;
        }
        @media print {
            @page { margin-top: 0; }
            body { margin-top: 1.6cm; }
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table style="width: 100%;">
                        <tr>
                            <td align="center">
                                <span style="line-height: 1.6; font-weight: bold">
                                    Sujono Inventory
                                    <br> Yusuf Fadil
                                </span>
                            </td>
                        </tr>
                    </table>

                    <hr class="line-title">
                    <p align="center">
                        Laporan Data Barang Keluar
                    </p>
                    <p align="center">
                        Periode Tanggal {{date('d F Y', strtotime($tgl_laporan))}}
                    </p>
                    <hr/>

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>No Barang Keluar</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Tanggal Keluar</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>

                        @if($sum_total == 0)

                            <tr>
                                <td colspan="8">
                                    <center>
                                        <b> Data Tidak Ada Pada Periode Tanggal {{date('d F Y', strtotime($tgl_laporan))}} </b>
                                    </center>
                                </td>
                            </tr>

                        @else

                            @php $no=1; @endphp
                            @foreach($brg_keluar as $row)
                                <tr>
                                    <td>{{ $no++}}</td>
                                    <td>{{ $row->no_brg_keluar }}</td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td>{{ $row->nama_kategori }}</td>
                                    <td>{{ date('d F Y', strtotime($row->tgl_brg_keluar)) }}</td>
                                    <td>Rp. {{ number_format($row->harga) }}</td>
                                    <td>{{ $row->jml_brg_keluar }} Unit</td>
                                    <td>Rp. {{ number_format($row->total) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="7">Total Harga</td>
                                <td>Rp. {{ number_format($sum_total) }}</td>
                            </tr>
                        @endif
                            
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>