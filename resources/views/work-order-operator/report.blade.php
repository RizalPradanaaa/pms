<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Work Orders</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; margin: 0; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: center; }
        th { background-color: #f0f0f0; }
        @media print {
            @page { size: A4; margin: 10mm; }
            body { margin: 0; padding: 0; }
            table { page-break-inside: avoid; }
            h2 { margin-top: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Work Orders</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Total Jumlah</th>
                <th>Completed</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->nomor_wo }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->statusLogs->where('status_baru', 'Completed')->sum('quantity_selesai') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
