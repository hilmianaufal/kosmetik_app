<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #ec4899;
        }

        .subtitle {
            color: #6b7280;
            margin-top: 5px;
        }

        .summary {
            width: 100%;
            margin-bottom: 25px;
        }

        .summary td {
            padding: 14px;
            border: 1px solid #fbcfe8;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #fce7f3;
            color: #be185d;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 9px;
            border-bottom: 1px solid #fce7f3;
        }

        .text-right {
            text-align: right;
        }

        .profit {
            color: #059669;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">MATANU BEAUTY STORE</div>
        <div class="subtitle">Laporan Penjualan</div>
    </div>

    <table class="summary">
        <tr>
            <td>
                <strong>Total Penjualan</strong><br>
                Rp {{ number_format($totalSales, 0, ',', '.') }}
            </td>

            <td>
                <strong>Total Laba</strong><br>
                Rp {{ number_format($totalProfit, 0, ',', '.') }}
            </td>

            <td>
                <strong>Total Transaksi</strong><br>
                {{ $transactions->count() }}
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembali</th>
                <th>Laba</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    <td>#{{ $transaction->id }}</td>
                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($transaction->payment, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($transaction->change, 0, ',', '.') }}</td>
                    <td class="profit">
                        Rp {{ number_format($transaction->items->sum('profit'), 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>