<?php
session_start();
include 'db.php';

$order_id = $_GET['order_id'];
$sql = "SELECT * FROM shop_order WHERE id=$order_id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Danke für Ihre Bestellung</title>
</head>
<body>
    <h1>Danke für Ihre Bestellung!</h1>
    <p>Ihre Bestellung mit der ID <?php echo $order['id']; ?> wurde erfolgreich aufgegeben.</p>
    <p>Wir werden Sie bald kontaktieren.</p>
</body>
</html>