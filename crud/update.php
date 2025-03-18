<?php
/**
 * Include the database configuration
 */
include('../config/config.php'); 

/**
 * Set up the PDO connection to the database
 */
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

if (isset($_POST['submit'])) {
    // Sanitize user input
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Prepare the update query
    $sql = "UPDATE Gebruiker 
            SET Voornaam = :voornaam,
                Tussenvoegsel = :tussenvoegsel,
                Achternaam = :achternaam,
                Gebruikersnaam = :gebruikersnaam,
                Wachtwoord = :wachtwoord,
                IsIngelogd = :isIngelogd,
                Ingelogd = :ingelogd,
                Uitgelogd = :uitgelogd,
                IsActief = :isActief,
                Opmerking = :opmerking,
                DatumGewijzigd = NOW()
            WHERE Id = :id";

    $statement = $pdo->prepare($sql);

    // Bind values from the form to the SQL query
    $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
    $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
    $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':gebruikersnaam', $_POST['gebruikersnaam'], PDO::PARAM_STR);
    
    // Only update password if a new one is entered
    if (!empty($_POST['wachtwoord'])) {
        $hashedPassword = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
    } else {
        // Fetch the existing password
        $passwordQuery = $pdo->prepare("SELECT Wachtwoord FROM Gebruiker WHERE Id = :id");
        $passwordQuery->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $passwordQuery->execute();
        $hashedPassword = $passwordQuery->fetchColumn();
    }

    $statement->bindValue(':wachtwoord', $hashedPassword, PDO::PARAM_STR);
    $statement->bindValue(':isIngelogd', $_POST['isIngelogd'], PDO::PARAM_INT);
    $statement->bindValue(':ingelogd', $_POST['ingelogd'] ?: NULL, PDO::PARAM_STR);
    $statement->bindValue(':uitgelogd', $_POST['uitgelogd'] ?: NULL, PDO::PARAM_STR);
    $statement->bindValue(':isActief', $_POST['isActief'], PDO::PARAM_INT);
    $statement->bindValue(':opmerking', $_POST['opmerking'], PDO::PARAM_STR);
    $statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

    // Execute the query
    if ($statement->execute()) {
        echo '<div class="alert alert-success text-center">De gebruiker is succesvol bijgewerkt.</div>';
        header('Refresh:3; url=/index.php'); // Redirect to index after 3 seconds
        exit();
    } else {
        echo '<div class="alert alert-danger text-center">Er is een fout opgetreden bij het bijwerken van de gebruiker.</div>';
    }
} else {
    // Fetch the record to edit based on the provided ID
    $sql = "SELECT * FROM Gebruiker WHERE Id = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_OBJ);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wijzig Gebruiker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3 class="mb-3 text-primary">Wijzig Gebruiker</h3>

    <form action="update_gebruiker.php" method="POST">
        <input type="hidden" name="id" value="<?= $result->Id ?? ''; ?>">

        <div class="mb-3">
            <label for="inputVoornaam" class="form-label">Voornaam:</label>
            <input name="voornaam" type="text" class="form-control" id="inputVoornaam" value="<?= $result->Voornaam ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="inputTussenvoegsel" class="form-label">Tussenvoegsel:</label>
            <input name="tussenvoegsel" type="text" class="form-control" id="inputTussenvoegsel" value="<?= $result->Tussenvoegsel ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="inputAchternaam" class="form-label">Achternaam:</label>
            <input name="achternaam" type="text" class="form-control" id="inputAchternaam" value="<?= $result->Achternaam ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="inputGebruikersnaam" class="form-label">Gebruikersnaam:</label>
            <input name="gebruikersnaam" type="text" class="form-control" id="inputGebruikersnaam" value="<?= $result->Gebruikersnaam ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="inputWachtwoord" class="form-label">Nieuw Wachtwoord (leeg laten om niet te wijzigen):</label>
            <input name="wachtwoord" type="password" class="form-control" id="inputWachtwoord">
        </div>
        <div class="mb-3">
            <label for="inputIsIngelogd" class="form-label">Is Ingelogd (1 = Ja, 0 = Nee):</label>
            <input name="isIngelogd" type="number" class="form-control" id="inputIsIngelogd" value="<?= $result->IsIngelogd ?? '0'; ?>" required>
        </div>
        <div class="mb-3">
            <label for="inputIngelogd" class="form-label">Ingelogd Datum:</label>
            <input name="ingelogd" type="datetime-local" class="form-control" id="inputIngelogd" value="<?= $result->Ingelogd ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="inputUitgelogd" class="form-label">Uitgelogd Datum:</label>
            <input name="uitgelogd" type="datetime-local" class="form-control" id="inputUitgelogd" value="<?= $result->Uitgelogd ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="inputIsActief" class="form-label">Is Actief (1 = Ja, 0 = Nee):</label>
            <input name="isActief" type="number" class="form-control" id="inputIsActief" value="<?= $result->IsActief ?? '1'; ?>" required>
        </div>
        <div class="mb-3">
            <label for="inputOpmerking" class="form-label">Opmerking:</label>
            <textarea name="opmerking" class="form-control" id="inputOpmerking"><?= $result->Opmerking ?? ''; ?></textarea>
        </div>
        <button name="submit" type="submit" class="btn btn-primary btn-lg"><a href="index.php">Wijzig</a></button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
