<?php
include 'config.php'; // Ensure this file has your database connection

header('Content-Type: application/json');

$query = "SELECT Id, Naam, Datum, Tijd, MaxAantalPersonen, Beschikbaarheid FROM Les WHERE IsActief = 1 ORDER BY Datum, Tijd";
$result = $conn->query($query);

$classes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
}

echo json_encode($classes);
$conn->close();
?>