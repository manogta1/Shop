<?php
session_start();
include 'db.php';

// Überprüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Produkt hinzufügen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
    $conn->query($sql);
}

// Produkt entfernen
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id=$id";
    $conn->query($sql);
}

// Produkt bearbeiten
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Produkt aktualisieren
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";
    $conn->query($sql);
    header("Location: admin.php"); // Nach dem Speichern zurück zur Admin-Seite
    exit;
}

// Produkte abrufen
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Bestellungen abrufen
$order_sql = "SELECT * FROM shop_order ORDER BY order_at DESC";
$order_result = $conn->query($order_sql);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Neues CSS-Stylesheet -->
</head>
<body>

<h1>Produkte verwalten</h1>

<!-- Knopf zum Hinzufügen eines Produkts -->
<button class="toggle-button" onclick="toggleForm('addProductForm')">Produkt hinzufügen</button>
<div id="addProductForm" class="hidden">
    <h2>Produkt hinzufügen</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Produktname</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Beschreibung</label>
            <textarea name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Preis</label>
            <input type="number" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="image">Bild-URL</label>
            <input type="text" name="image" required>
        </div>
        <button type="submit" name="add_product" class="btn">Produkt hinzufügen</button>
    </form>
</div>

<!-- Produktliste -->
<h2>Produktliste</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Preis</th>
            <th>Bild</th>
            <th>Aktionen</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo number_format($row['price'], 2); ?> EUR</td>
            <td><img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width: 50px;"></td>
            <td>
                <button onclick="openEditForm(<?php echo $row['id']; ?>)">Bearbeiten</button>
                <a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Sind Sie sicher, dass Sie dieses Produkt löschen möchten?');">Löschen</a>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <div id="editProductForm_<?php echo $row['id']; ?>" class="editProductForm hidden">
                    <h2>Produkt bearbeiten</h2>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label for="name">Produktname</label>
                            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Beschreibung</label>
                            <textarea name="description" required><?php echo $row['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Preis</label>
                            <input type="number" name="price" value="<?php echo $row['price']; ?>" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Bild-URL</label>
                            <input type="text" name="image" value="<?php echo $row['image']; ?>" required>
                        </div>
                        <button type="submit" name="update_product" class="btn">Produkt aktualisieren</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Bestellungen anzeigen -->
<h2>Getätigte Bestellungen</h2>
<table>
    <thead>
        <tr>
            <th>Bestell-ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Adresse</th>
            <th>E-Mail</th>
            <th>Telefon</th>
            <th>Status</th>
            <th>Bestelldatum</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($order = $order_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $order['id']; ?></td>
            <td><?php echo $order['first_name']; ?></td>
            <td><?php echo $order['last_name']; ?></td>
            <td><?php echo $order['address']; ?></td>
            <td><?php echo $order['email']; ?></td>
            <td><?php echo $order['mobile']; ?></td>
            <td><?php echo $order['order_status']; ?></td>
            <td><?php echo date('d.m.Y H:i', strtotime($order['order_at'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script src="script.js"></script> <!-- Neues JavaScript-File -->
</body>
</html>