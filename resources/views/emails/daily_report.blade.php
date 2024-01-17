<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Rapport de vente du {{ $today }}</title>
    <style>
        .report-container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .report-section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 10px;
        }
        @media (max-width: 600px) {
            .report-container {
                width: 100%;
            }
            .report-section {
                padding: 10px;
            }
        }
    </style>
</head>
<body style="background-color: #f4f4f4;">
<div class="report-container">
    <h2 style="color: #445566; text-align: center;">Oprah Pharmacie</h2>
    <p style="text-align: center;">Aujourd'hui le: <b>{{ $today }}</b></p>
    <hr style="border: none; border-top: 2px solid #1b1b1b;">

    <div class="report-section">
        <h3 style="color: blue;">Total Commande : {{ $orderCount }}</h3>
    </div>

    <div class="report-section">
        <h3 style="color: #0b1362;">Total vendu : {{ $salesRevenue }} FC</h3>
    </div>
    <!-- Section pour les détails de chaque utilisateur et ses ventes -->
    <div class="report-section">
        <h3 style="color: #0b1362;">Détails des ventes par utilisateur :</h3>
        @foreach($salesByusers as $user)
            <div class="user-sales-details">
                <h4>Vendeur : {{ $user->name }}</h4>
                <p>Total vendu : {{  number_format($user->total_sold,'0',',',' ') }} FC</p>
            </div>
        @endforeach
    </div>

    <div class="report-section">
        <h3 style="color: green;">Marge brute : {{ $grossMargin }} FC</h3>
    </div>

    <div class="report-section">
        <h3 style="color: magenta;">Marge brute en pourcentage: {{ $grossMarginPercentage }}%</h3>
    </div>

    <div class="report-section">
        <h3 style="color: red;">Produits en Stock critique : {{ $criticalStock }}</h3>
    </div>

    <div class="report-section">
        <h3 style="color:maroon;">Produits à risque d'expiration : {{ $criticalExpirations }}</h3>
    </div>
</div>
</body>

</html>
