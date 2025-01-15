<?php
session_start();
include 'db.php';

// Produkte abrufen
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produkte</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Zentriert den Inhalt horizontal */
        }
        h1 {
            color: #333;
            text-align: center; /* Zentriert den Titel */
            margin-bottom: 20px;
        }
        .logo {
            font-size: 3em; /* Größe des Logos */
            font-weight: bold; /* Fettgedruckt */
            text-align: center; /* Zentriert das Logo */
            margin-bottom: 20px; /* Abstand nach unten */
            overflow: hidden; /* Versteckt den überflüssigen Text */
            white-space: nowrap; /* Verhindert Zeilenumbruch */
            border-right: 0.15em solid orange; /* Blinkender Cursor */
            animation: typing 4s steps(15, end), blink-caret 0.75s step-end infinite; /* Animationen */
            display: inline-block; /* Damit die Animation von der Mitte aus funktioniert */
        }
        @keyframes typing {
            from { width: 0; }
            to { width: 15ch; } /* Länge des Textes "Mein Onlineshop" */
        }
        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: orange; }
        }
        .product-container {
            display: flex;
            flex-wrap: wrap; /* Ermöglicht das Umfließen der Produkte */
            justify-content: space-between; /* Verteilt den Platz gleichmäßig */
            width: 100%; /* Nimmt die volle Breite ein */
        }
        .product {
            background: #fff;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(25% - 20px); /* 4 Produkte pro Reihe, abzüglich des Abstands */
            box-sizing: border-box; /* Berücksichtigt Padding und Margin in der Breite */
        }
        .product img {
            max-width: 10%; /* Bild anpassen */
            height: auto; /* Höhe automatisch anpassen */
            border-radius: 5px; /* Ecken abrunden */
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="logo">Mein Onlineshop</div> <!-- Logo-Text -->

<h1>Produkte</h1>

<div class="product-container">
    <?php while ($product = $result->fetch_assoc()): ?>
        <div class="product">
            <h2><?php echo $product['name']; ?></h2>
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <p><?php echo $product['description']; ?></p>
            <p>Preis: <?php echo number_format($product['price'], 2); ?> EUR</p>
            <a href="cart.php?add_to_cart=<?php echo $product['id']; ?>" class="btn">In den Warenkorb</a>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>