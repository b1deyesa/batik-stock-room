<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 Generate PDF Example - ItSolutionStuff.com</title>
    <style>
        :root {
            font-size: .7em;
        }
        body {
            padding: 2em;
            max-width: 1000px;
            margin: auto
        }
        ul {
            padding: 0;
        }
        li {
            list-style: none;
            padding: 0;
            line-height: 1em;
        }
        table {
            border-collapse: collapse
        }
        table th {
            padding: .4em 1em;
            background: #eee;
        }
        table td {
            padding: 0 1em;
            vertical-align: middle;
        }
        .banner {
            display: flex;
            align-items: center;
            gap: 1em;
        }
        .banner img {
            height: 8em;
        }
        h1, h4 {
            line-height: 1em;
            margin: 0;
            margin-bottom: 10px
        }
    </style>
</head>
<body>
    <table style="max-width: 800px">
        <tr>
            <td width="1%">
                <img style="width: 100px" src="{{ asset('asset/img/logo.png') }}" alt="">
            </td>
            <td width="100%">
                <div class="text">
                    <h1>{{ $title }}</h1>
                    <h4>Periode: {{ $date }}</h4>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="margin-bottom: 2em">Pada laporan ini, disajikan rangkuman dari berbagai transaksi yang telah dilakukan selama periode yang ditentukan. Laporan ini mencakup transaksi pembelian, penjualan, serta pengembalian barang. Tujuan laporan ini adalah untuk memberikan pemahaman yang jelas tentang aktivitas transaksi yang terjadi dalam periode yang bersangkutan.</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table border="1"  style="width:100%"">
                    <tr>
                        <th style="white-space: nowrap">Tanggal</th>
                        <th style="white-space: nowrap">No. Transaksi</th>
                        <th style="white-space: nowrap">Nama Batik</th>
                        <th style="white-space: nowrap">ID Anggota</th>
                        <th style="white-space: nowrap">Qty.</th>
                        <th style="white-space: nowrap">Harga</th>
                        <th style="white-space: nowrap">Total</th>
                    </tr>
                    @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->created_at->format('d/m/Y') }}</td>
                            <td align="center">{{ $transaksi->code }}</td>
                            <td width="100%">
                                @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                                    <ul>
                                        <li>{{ $detailTransaksi->inventory->name }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td align="center">{{ $transaksi->user->code }}</td>
                            <td align="center">
                                @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                                    <ul>
                                        <li>{{ $detailTransaksi->quantity }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td style="white-space: nowrap">
                                @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                                    <ul>
                                        <li>{{ $detailTransaksi->inventory->currency($detailTransaksi->inventory->harga_jual * $detailTransaksi->quantity) }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td style="white-space: nowrap">{{ "Rp " . number_format($transaksi->grandtotal, 2, ',', '.'); }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br><br><hr><br><br>
                <h4>Total Pendapatan: {{ "Rp " . number_format($transaksis->sum('grandtotal'), 2, ',', '.'); }}</h4>
                <h4>Total Transaksi: {{ $transaksis->count() }}</h4>
            </td>
        </tr>
    </table>
</body>
</html>