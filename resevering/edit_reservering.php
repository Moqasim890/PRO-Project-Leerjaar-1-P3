<?php
// edit_reservering.php
include('../config/config.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: reservering_message.php?success=0&msg=Geen geldige ID opgegeven.&redirect=overview_reservering.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM Reservering WHERE Id = :id");
    $stmt->execute([':id' => $id]);
    $reservering = $stmt->fetch(PDO::FETCH_OBJ);
    if (!$reservering) {
        header("Location: reservering_message.php?success=0&msg=Reservering niet gevonden.&redirect=overview_reservering.php");
        exit;
    }
} catch (PDOException $e) {
    $msg = urlencode("Databasefout: " . $e->getMessage());
    header("Location: reservering_message.php?success=0&msg=$msg&redirect=overview_reservering.php");
    exit;
}

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
    $reserveringstatus = $_POST['reserveringstatus'] ?? '';
    $isActief = isset($_POST['isActief']) ? (int)$_POST['isActief'] : 1;
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
        $back = "edit_reservering.php?id=$id";
        header("Location: reservering_message.php?success=0&msg=$msg&redirect=$back");
        exit;
    }

    try {
        $sql = "UPDATE Reservering SET 
            Voornaam = :voornaam,
            Tussenvoegsel = :tussenvoegsel,
            Achternaam = :achternaam,
            Nummer = :nummer,
            Datum = :datum,
            Tijd = :tijd,
            Reserveringstatus = :reserveringstatus,
            IsActief = :isActief,
            Opmerking = :opmerking,
            DatumGewijzigd = NOW()
        WHERE Id = :id";

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
            ':opmerking' => $opmerking,
            ':id' => $id
        ]);

        header("Location: reservering_message.php?success=1&msg=Reservering succesvol bijgewerkt.");
        exit;
    } catch (PDOException $e) {
        $msg = urlencode("Databasefout: " . $e->getMessage());
        $back = "edit_reservering.php?id=$id";
        header("Location: reservering_message.php?success=0&msg=$msg&redirect=$back");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Reservering Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Reservering Bewerken</h3>
    <form action="edit_reservering.php?id=<?= htmlspecialchars($reservering->Id) ?>" method="POST">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam:</label>
            <input type="text" id="voornaam" name="voornaam" class="form-control" required value="<?= htmlspecialchars($reservering->Voornaam) ?>">
        </div>
        <div class="mb-3">
            <label for="tussenvoegsel" class="form-label">Tussenvoegsel:</label>
            <input type="text" id="tussenvoegsel" name="tussenvoegsel" class="form-control" value="<?= htmlspecialchars($reservering->Tussenvoegsel ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam:</label>
            <input type="text" id="achternaam" name="achternaam" class="form-control" required value="<?= htmlspecialchars($reservering->Achternaam) ?>">
        </div>
        <div class="mb-3">
            <label for="nummer" class="form-label">Telefoonnummer (8-11 cijfers):</label>
            <input type="text" id="nummer" name="nummer" class="form-control" maxlength="11" value="<?= htmlspecialchars($reservering->Nummer) ?>">
        </div>
        <div class="mb-3">
            <label for="datum" class="form-label">Datum:</label>
            <input type="date" id="datum" name="datum" class="form-control" required value="<?= htmlspecialchars($reservering->Datum) ?>">
        </div>
        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd:</label>
            <input type="time" id="tijd" name="tijd" class="form-control" required value="<?= htmlspecialchars($reservering->Tijd) ?>">
        </div>
        <div class="mb-3">
            <label for="reserveringstatus" class="form-label">Status:</label>
            <select name="reserveringstatus" id="reserveringstatus" class="form-control">
                <option value="Bevestigd" <?= $reservering->Reserveringstatus === 'Bevestigd' ? 'selected' : '' ?>>Bevestigd</option>
                <option value="Geannuleerd" <?= $reservering->Reserveringstatus === 'Geannuleerd' ? 'selected' : '' ?>>Geannuleerd</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="isActief" class="form-label">Is Actief (1=Ja, 0=Nee):</label>
            <input type="number" name="isActief" id="isActief" class="form-control" value="<?= htmlspecialchars($reservering->IsActief ?? 1) ?>" min="0" max="1" required>
        </div>
        <div class="mb-3">
            <label for="opmerking" class="form-label">Opmerking:</label>
            <textarea name="opmerking" id="opmerking" class="form-control"><?= htmlspecialchars($reservering->Opmerking ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
</body>
</html>