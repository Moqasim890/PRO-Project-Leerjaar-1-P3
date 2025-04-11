<?php
// create_reservering.php
include('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'voornaam' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'tussenvoegsel' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'achternaam' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'nummer' => FILTER_SANITIZE_NUMBER_INT,
        'datum' => FILTER_SANITIZE_STRING,
        'tijd' => FILTER_SANITIZE_STRING,
        'reserveringstatus' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'isActief' => FILTER_VALIDATE_INT,
        'opmerking' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ]);

    $voornaam = $_POST['voornaam'] ?? '';
    $tussenvoegsel = $_POST['tussenvoegsel'] ?? '';
    $achternaam = $_POST['achternaam'] ?? '';
    $nummer = ltrim($_POST['nummer'] ?? '', '0');
    $datum = $_POST['datum'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $reserveringstatus = $_POST['reserveringstatus'] ?? 'Bevestigd';
    $isActief = $_POST['isActief'] ?? 1;
    $opmerking = $_POST['opmerking'] ?? '';

    $errors = [];
    if (empty($voornaam)) $errors[] = "Voornaam is verplicht.";
    if (empty($achternaam)) $errors[] = "Achternaam is verplicht.";
    if (empty($nummer)) {
        $errors[] = "Telefoonnummer is verplicht.";
    } elseif (!preg_match('/^\d{8,11}$/', $nummer)) {
        $errors[] = "Nummer moet tussen 8 en 11 cijfers bevatten.";
    }
    if (empty($datum)) $errors[] = "Datum is verplicht.";
    if (empty($tijd)) $errors[] = "Tijd is verplicht.";

    if (!empty($errors)) {
        $msg = urlencode(implode(" | ", $errors));
        header("Location: reservering_message.php?success=0&msg=$msg&redirect=create_reservering.php");
        exit;
    }

    try {
        $sql = "INSERT INTO Reservering 
                (Voornaam, Tussenvoegsel, Achternaam, Nummer, Datum, Tijd, Reserveringstatus, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
                VALUES 
                (:voornaam, :tussenvoegsel, :achternaam, :nummer, :datum, :tijd, :reserveringstatus, :isActief, :opmerking, NOW(), NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':voornaam' => $voornaam,
            ':tussenvoegsel' => $tussenvoegsel,
            ':achternaam' => $achternaam,
            ':nummer' => $nummer,
            ':datum' => $datum,
            ':tijd' => $tijd,
            ':reserveringstatus' => $reserveringstatus,
            ':isActief' => $isActief,
            ':opmerking' => $opmerking
        ]);

        header("Location: reservering_message.php?success=1&msg=De reservering is succesvol toegevoegd.");
        exit;
    } catch (PDOException $e) {
        $msg = urlencode("Databasefout: " . $e->getMessage());
        header("Location: reservering_message.php?success=0&msg=$msg&redirect=create_reservering.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Reservering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Nieuwe Reservering</h3>
    <form action="create_reservering.php" method="POST">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam:</label>
            <input type="text" name="voornaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tussenvoegsel" class="form-label">Tussenvoegsel:</label>
            <input type="text" name="tussenvoegsel" class="form-control">
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam:</label>
            <input type="text" name="achternaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nummer" class="form-label">Telefoonnummer (8-11 cijfers):</label>
            <input type="text" name="nummer" id="nummer" class="form-control" maxlength="11" required>
        </div>
        <div class="mb-3">
            <label for="datum" class="form-label">Datum:</label>
            <input type="date" name="datum" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd:</label>
            <input type="time" name="tijd" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reserveringstatus" class="form-label">Status:</label>
            <select name="reserveringstatus" class="form-control">
                <option value="Bevestigd">Bevestigd</option>
                <option value="Geannuleerd">Geannuleerd</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="isActief" class="form-label">Is Actief (1=Ja, 0=Nee):</label>
            <input type="number" name="isActief" class="form-control" value="1" min="0" max="1" required>
        </div>
        <div class="mb-3">
            <label for="opmerking" class="form-label">Opmerking:</label>
            <textarea name="opmerking" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
</body>
</html>
