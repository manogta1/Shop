<?php
$servername = "localhost";
$username = "root"; // Dein MySQL-Benutzername
$password = "maNu1997!"; // Dein MySQL-Passwort
$dbname = "online_shop";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>