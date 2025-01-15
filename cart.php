<?php
session_start();
include 'db.php';

if (isset($_GET['add_to_cart'])) {
    $productId = $_GET['add_to_cart'];

    // Produkt aus der Datenbank abrufen
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    // Überprüfen, ob das Produkt existiert
    if ($product) {
        // Überprüfen, ob das Produkt bereits im Warenkorb ist
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $productId) {
                $item['quantity']++; // Menge erhöhen
                $found = true;
                break;
            }
        }

        // Wenn das Produkt nicht im Warenkorb ist, fügen Sie es hinzu
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
    }
}

// Weiterleitung zurück zur Produktseite
header("Location: index.php");
exit;
?>