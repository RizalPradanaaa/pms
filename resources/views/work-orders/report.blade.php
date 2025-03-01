<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Work Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }
            body {
                margin: 0;
                padding: 0;
            }
            table {
                page-break-inside: avoid;
            }
            h2 {
                margin-top: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Work Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Pending</th>
                <th>In Progress</th>
                <th>Completed</th>
                <th>Canceled</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $namaProduk => $statuses)
                <tr>
                    <td>{{ $namaProduk }}</td>
                    <td>{{ $statuses->firstWhere('status', 'Pending')->total_quantity ?? 0 }}</td>
                    <td>{{ $statuses->firstWhere('status', 'In Progress')->total_quantity ?? 0 }}</td>
                    <td>{{ $statuses->firstWhere('status', 'Completed')->total_quantity ?? 0 }}</td>
                    <td>{{ $statuses->firstWhere('status', 'Canceled')->total_quantity ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
