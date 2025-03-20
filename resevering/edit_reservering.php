<?php
include('../config/config.php');


$errors = [];
$successMessage = null;

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

 
    try {
        $sql = "SELECT * FROM Reservering WHERE Id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $reservering = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$reservering) {
            die("Reservering niet gevonden.");
        }
    } catch (PDOException $e) {
        die("Databasefout: " . $e->getMessage());
    }
} else {
    die("Geen ID opgegeven.");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $voornaam = $_POST['voornaam'] ?? '';
    $tussenvoegsel = $_POST['tussenvoegsel'] ?? '';
    $achternaam = $_POST['achternaam'] ?? '';
    $nummer = $_POST['nummer'] ?? '';
    $datum = $_POST['datum'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $reserveringstatus = $_POST['reserveringstatus'] ?? '';
    $isActief = $_POST['isActief'] ?? 1;
    $opmerking = $_POST['opmerking'] ?? '';

    if (empty($voornaam)) $errors[] = "Voornaam is verplicht.";
    if (empty($achternaam)) $errors[] = "Achternaam is verplicht.";
    if (empty($nummer)) $errors[] = "Nummer is verplicht.";
    if (empty($datum)) $errors[] = "Datum is verplicht.";
    if (empty($tijd)) $errors[] = "Tijd is verplicht.";

    if (empty($errors)) {
        try {
            $sql = "UPDATE Reservering 
                    SET Voornaam = :voornaam, 
                        Tussenvoegsel = :tussenvoegsel, 
                        Achternaam = :achternaam, 
                        Nummer = :nummer, 
                        Datum = :datum, 
                        Tijd = :tijd, 
                        reserveringstatus = :reserveringstatus, 
                        IsActief = :isActief, 
                        Opmerking = :opmerking, 
                        DatumGewijzigd = NOW()
                    WHERE Id = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':voornaam', $voornaam, PDO::PARAM_STR);
            $stmt->bindValue(':tussenvoegsel', $tussenvoegsel, PDO::PARAM_STR);
            $stmt->bindValue(':achternaam', $achternaam, PDO::PARAM_STR);
            $stmt->bindValue(':nummer', $nummer, PDO::PARAM_STR);
            $stmt->bindValue(':datum', $datum, PDO::PARAM_STR);
            $stmt->bindValue(':tijd', $tijd, PDO::PARAM_STR);
            $stmt->bindValue(':reserveringstatus', $reserveringstatus, PDO::PARAM_STR);
            $stmt->bindValue(':isActief', $isActief, PDO::PARAM_INT);
            $stmt->bindValue(':opmerking', $opmerking, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $successMessage = "Reservering succesvol bijgewerkt.";
                header("Refresh:3; url=overview_reservering.php");
                exit();
            } else {
                $errors[] = "Er is een fout opgetreden bij het bijwerken van de reservering.";
            }
        } catch (PDOException $e) {
            $errors[] = "Databasefout: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservering Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Reservering Bewerken</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
    <?php endif; ?>

    <form action="edit_reservering.php?id=<?= $reservering->Id ?>" method="POST">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam:</label>
            <input type="text" name="voornaam" id="voornaam" class="form-control" value="<?= htmlspecialchars($reservering->Voornaam) ?>" required>
        </div>
        <div class="mb-3">
            <label for="tussenvoegsel" class="form-label">Tussenvoegsel:</label>
            <input type="text" name="tussenvoegsel" id="tussenvoegsel" class="form-control" value="<?= htmlspecialchars($reservering->Tussenvoegsel) ?>">
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam:</label>
            <input type="text" name="achternaam" id="achternaam" class="form-control" value="<?= htmlspecialchars($reservering->Achternaam) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nummer" class="form-label">Nummer:</label>
            <input type="text" name="nummer" id="nummer" class="form-control" value="<?= htmlspecialchars($reservering->Nummer) ?>" required>
        </div>
        <div class="mb-3">
            <label for="datum" class="form-label">Datum:</label>
            <input type="date" name="datum" id="datum" class="form-control" value="<?= htmlspecialchars($reservering->Datum) ?>" required>
        </div>
        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd:</label>
            <input type="time" name="tijd" id="tijd" class="form-control" value="<?= htmlspecialchars($reservering->Tijd) ?>" required>
        </div>
        <div class="mb-3">
            <label for="reserveringstatus" class="form-label">reserveringstatus:</label>
            <select name="reserveringstatus" id="reserveringstatus" class="form-control">
                <option value="Bevestigd" <?= $reservering->reserveringstatus === 'Bevestigd' ? 'selected' : '' ?>>Bevestigd</option>
                <option value="Geannuleerd" <?= $reservering->reserveringstatus === 'Geannuleerd' ? 'selected' : '' ?>>Geannuleerd</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="isActief" class="form-label">Is Actief (1 = Ja, 0 = Nee):</label>
            <input type="number" name="isActief" id="isActief" class="form-control" min="0" max="1" value="<?= htmlspecialchars($reservering->IsActief) ?>" required>
        </div>
        <div class="mb-3">
            <label for="opmerking" class="form-label">Opmerking:</label>
            <textarea name="opmerking" id="opmerking" class="form-control"><?= htmlspecialchars($reservering->Opmerking) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="overview_reservering.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
</body>
</html>
