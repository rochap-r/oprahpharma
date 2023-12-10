<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport de Stock</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 100%;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .table-danger {
            background-color: #f5c6cb;
        }
        .table-success {
            background-color: #c3e6cb;
        }
        .text-center {
            text-align: center;
        }
        .text-danger {
            color: #dc3545;
        }
        .text-success {
            color: #28a745;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Oprah Pharmacie Rapport de Stock </h1>
    <table>
        <thead>
        <tr>
            <th>Produit</th>
            <th>Qté stock</th>
            <th>Statut</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="{{ $product->stock_status === 'critical' ? 'table-danger' : 'table-success' }}">
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->latestSupply ? $product->latestSupply->quantity_in_stock : 'N/A' }} | {{ $product->unit->unit_sigle }}</td>

                <td class="text-center">
                    @if($product->stock_status === 'critical')
                        <span class="text-danger">Critique</span>
                    @else
                        <span class="text-success">Normal</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="footer">
        Généré le {{ now()->format('d/m/Y H:i') }}
    </div>
</div>
</body>
</html>
