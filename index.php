<?php
include 'db.php';

// Produkte abrufen
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html <html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Online Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Willkommen in unserem Online-Shop</h1>

<!-- Produktliste -->
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
                <a href="cart.php?add_to_cart=<?php echo $row['id']; ?>">In den Warenkorb</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="cart.php" class="btn">Warenkorb anzeigen</a>
<a href="admin.php" class="btn">Admin-Bereich</a>

</body>
</html>
