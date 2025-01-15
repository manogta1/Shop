<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add_to_cart'])) {
    $productId = $_GET['add_to_cart'];

    // Produkt aus der Datenbank abrufen ```php
    $sql = "SELECT * FROM products WHERE id=$productId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $_SESSION['cart'][] = $product;
    }
}

if (isset($_GET['remove_from_cart'])) {
    $productId = $_GET['remove_from_cart'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $productId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Warenkorb</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Ihr Warenkorb</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Preis</th>
            <th>Aktionen</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['cart'] as $item): ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo number_format($item['price'], 2); ?> EUR</td>
            <td>
                <a href="cart.php?remove_from_cart=<?php echo $item['id']; ?>">Entfernen</a>
            </td>
        </tr>
        <?php $totalPrice += $item['price']; endforeach; ?>
    </tbody>
</table>

<h2>Gesamtpreis: <?php echo number_format($totalPrice, 2); ?> EUR</h2>
<a href="checkout.php" class="btn">Zur Kasse</a>
<a href="index.php" class="btn">Weiter einkaufen</a>

</body>
</html>