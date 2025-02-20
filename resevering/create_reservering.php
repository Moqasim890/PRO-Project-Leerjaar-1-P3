<?php
include('../config/config.php'); 

$errors = [];
$successMessage = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
                             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $voornaam = $_POST['voornaam'] ?? '';
    $tussenvoegsel = $_POST['tussenvoegsel'] ?? '';
    $achternaam = $_POST['achternaam'] ?? '';
    $nummer = $_POST['nummer'] ?? '';
             $datum = $_POST['datum'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $reserveringstatus = $_POST['reserveringstatus'] ?? 'Bevestigd';
    $isActief = $_POST['isActief'] ?? 1;
    $opmerking = $_POST['opmerking'] ?? '';


    if (empty($voornaam)) $errors[] = "Voornaam is verplicht.";
    if (empty($achternaam)) $errors[] = "Achternaam is verplicht.";
    if (empty($nummer)) $errors[] = "Nummer is verplicht.";
    if (empty($datum)) $errors[] = "Datum is verplicht.";
    if (empty($tijd)) $errors[] = "Tijd is verplicht.";

    if (empty($errors)) {
        try {
        
            $sql = "INSERT INTO Reservering 
                    (Voornaam, Tussenvoegsel, Achternaam, Nummer, Datum, Tijd, Reserveringstatus, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd) 
                    VALUES 
                    (:voornaam, :tussenvoegsel, :achternaam, :nummer, :datum, :tijd, :reserveringstatus, :isActief, :opmerking, NOW(), NOW())";

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

         
            if ($stmt->execute()) {
                $successMessage = "De reservering is succesvol toegevoegd.";
                header("Refresh:3; url=overview_reservering.php");
                exit();
            } else {
                $errors[] = "Er is een fout opgetreden bij het toevoegen van de reservering.";
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
    <title>Reservering Registratie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Nieuwe Reservering</h3>

   
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


    <form action="create_reservering.php" method="POST">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam:</label>
            <input type="text" name="voornaam" id="voornaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tussenvoegsel" class="form-label">Tussenvoegsel:</label>
            <input type="text" name="tussenvoegsel" id="tussenvoegsel" class="form-control">
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam:</label>
            <input type="text" name="achternaam" id="achternaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nummer" class="form-label">Nummer:</label>
            <input type="text" name="nummer" id="nummer" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="datum" class="form-label">Datum:</label>
            <input type="date" name="datum" id="datum" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd:</label>
            <input type="time" name="tijd" id="tijd" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reserveringstatus" class="form-label">Reserveringstatus:</label>
            <select name="reserveringstatus" id="reserveringstatus" class="form-control">
                <option value="Bevestigd">Bevestigd</option>
                <option value="Geannuleerd">Geannuleerd</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="isActief" class="form-label">Is Actief (1 = Ja, 0 = Nee):</label>
            <input type="number" name="isActief" id="isActief" class="form-control" min="0" max="1" value="1" required>
        </div>
        <div class="mb-3">
            <label for="opmerking" class="form-label">Opmerking:</label>
            <textarea name="opmerking" id="opmerking" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
</body>
</html>
