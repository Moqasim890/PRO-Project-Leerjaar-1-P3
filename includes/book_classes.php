<?php
session_start();
include 'config.php';

header('Content-Type: application/json');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "You must be logged in to book a class."]);
    exit();
}

// Retrieve user and class details
$user_id = $_SESSION['user_id'];
$lesson_id = $_POST['lesson_id'];

// Get user details
$user_query = $conn->prepare("SELECT Voornaam, Tussenvoegsel, Achternaam FROM Lid WHERE Id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();

if (!$user) {
    echo json_encode(["status" => "error", "message" => "User not found."]);
    exit();
}

$voornaam = $user['Voornaam'];
$tussenvoegsel = $user['Tussenvoegsel'];
$achternaam = $user['Achternaam'];

$lesson_query = $conn->prepare("SELECT Datum, Tijd, MaxAantalPersonen FROM Les WHERE Id = ?");
$lesson_query->bind_param("i", $lesson_id);
$lesson_query->execute();
$lesson_result = $lesson_query->get_result();
$lesson = $lesson_result->fetch_assoc();

if (!$lesson) {
    echo json_encode(["status" => "error", "message" => "Lesson not found."]);
    exit();
}

$datum = $lesson['Datum'];
$tijd = $lesson['Tijd'];

$count_query = $conn->prepare("SELECT COUNT(*) AS booked FROM Reservering WHERE Datum = ? AND Tijd = ? AND IsActief = 1");
$count_query->bind_param("ss", $datum, $tijd);
$count_query->execute();
$count_result = $count_query->get_result();
$booked = $count_result->fetch_assoc()['booked'];

if ($booked >= $lesson['MaxAantalPersonen']) {
    echo json_encode(["status" => "error", "message" => "Class is fully booked."]);
    exit();
}

$sql = "INSERT INTO Reservering (Voornaam, Tussenvoegsel, Achternaam, Nummer, Datum, Tijd, Reserveringstatus, IsActief)
        VALUES (?, ?, ?, ?, ?, ?, 'Geboekt', 1)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiss", $voornaam, $tussenvoegsel, $achternaam, $user_id, $datum, $tijd);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Lesson booked successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

$stmt->close();
$conn->close();
?>