<?php
include 'db.php';

// Produkt abrufen
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width:300px;height:300px;">
    <p><?php echo $product['description']; ?></p>
    <p><?php echo $product['price']; ?> €</p>
    <a href="buy.php?id=<?php echo $product['id']; ?>">Kaufen</a>
    <br>
    <a href="index.php">Zurück zum Shop</a>
</body>
</html>

<?php $conn->close(); ?>