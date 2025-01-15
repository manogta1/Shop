<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hier kannst du die Logik für die Zahlungsabwicklung implementieren
    // Zum Beispiel: Bestellinformationen in die Datenbank speichern

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $orderStatus = 'In Bearbeitung';

    // Bestelldaten in die Datenbank einfügen
    $sql = "INSERT INTO shop_order (first_name, last_name, address, email, mobile, order_status, order_at) VALUES ('$firstName', '$lastName', '$address', '$email', '$mobile', '$orderStatus', NOW())";
    $conn->query($sql);
    $orderId = $conn->insert_id;

    // Warenkorb leeren
    $_SESSION['cart'] = [];

    header("Location: buy.php?id=$orderId");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kasse</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Kasse</h1>

<form method="POST">
    <div class="form-group">
        <label for="first_name">Vorname</label>
        <input type="text" name="first_name" required>
    </div>
    <div class="form-group">
        <label for="last_name">Nachname</label>
        <input type="text" name="last_name" required>
    </div>
    <div class="form-group">
        <label for="address">Adresse</label>
        <input type="text" name="address" required>
    </div>
    <div class="form-group">
        <label for="email">E-Mail</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="mobile">Telefon</label>
        <input type="text" name="mobile" required>
    </div>
    <button type="submit" class="btn">Bestellung abschicken</button>
</form>

</body>
</html>