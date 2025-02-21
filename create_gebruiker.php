<?php
if (isset($_POST['submit'])) {
    // Include database configuration
    include('config/config.php');

    // Database connection using PDO
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    


    


    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "INSERT INTO Gebruiker (
                Voornaam,
                Tussenvoegsel,
                Achternaam,
                Gebruikersnaam,
                Wachtwoord,
                IsIngelogd,
                Ingelogd,
                Uitgelogd,
                IsActief,
                Opmerking,
                DatumAangemaakt,
                DatumGewijzigd
            ) VALUES (
                :voornaam,
                :tussenvoegsel,
                :achternaam,
                :gebruikersnaam,
                :wachtwoord,
                :isIngelogd,
                :ingelogd,
                :uitgelogd,
                :isActief,
                :opmerking,
                NOW(),
                NOW()
            )";

    // Prepare and bind parameters
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
    $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
    $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
    $statement->bindValue(':gebruikersnaam', $_POST['gebruikersnaam'], PDO::PARAM_STR);
    $statement->bindValue(':wachtwoord', password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT), PDO::PARAM_STR);
    $statement->bindValue(':isIngelogd', $_POST['isIngelogd'], PDO::PARAM_INT);
    $statement->bindValue(':ingelogd', $_POST['ingelogd'] ?: NULL, PDO::PARAM_STR);
    $statement->bindValue(':uitgelogd', $_POST['uitgelogd'] ?: NULL, PDO::PARAM_STR);
    $statement->bindValue(':isActief', $_POST['isActief'], PDO::PARAM_INT);
    $statement->bindValue(':opmerking', $_POST['opmerking'], PDO::PARAM_STR);

    // Execute the query and handle success or failure
    if ($statement->execute()) {
        $successMessage = "De gebruiker is succesvol toegevoegd. U wordt binnen 3 seconden teruggestuurd.";
        header("Refresh:3; url=index.php");
    } else {
        $errorMessage = "Er is een fout opgetreden bij het toevoegen van de gebruiker.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nieuwe Gebruiker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div>  

    <!-- Success or Error Message -->
    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success text-center"><?= $successMessage ?></div>
    <?php elseif (isset($errorMessage)): ?>
        <div class="alert alert-danger text-center"><?= $errorMessage ?></div>
    <?php endif; ?>

   
    <h3 class="mb-3">Voeg een nieuwe gebruiker toe</h3>

 
    <form action="create_gebruiker.php" method="POST" class="mo">
        <div class="mb-3">
            <label for="inputVoornaam" class="form-label">Voornaam:</label>
            <input name="voornaam" type="text" class="form-control" id="inputVoornaam" required>
        </div>
        <div class="mb-3">
            <label for="inputTussenvoegsel" class="form-label">Tussenvoegsel:</label>
            <input name="tussenvoegsel" type="text" class="form-control" id="inputTussenvoegsel">
        </div>
        <div class="mb-3">
            <label for="inputAchternaam" class="form-label">Achternaam:</label>
            <input name="achternaam" type="text" class="form-control" id="inputAchternaam" required>
        </div>
        <div class="mb-3">
            <label for="inputGebruikersnaam" class="form-label">Gebruikersnaam:</label>
            <input name="gebruikersnaam" type="text" class="form-control" id="inputGebruikersnaam" required>
        </div>
        <div class="mb-3">
            <label for="inputWachtwoord" class="form-label">Wachtwoord:</label>
            <input name="wachtwoord" type="password" class="form-control" id="inputWachtwoord" required>
        </div>
        <div class="mb-3">
            <label for="inputIsIngelogd" class="form-label">Is Ingelogd (1 = Ja, 0 = Nee):</label>
            <input name="isIngelogd" type="number" min="0" max="1" class="form-control" id="inputIsIngelogd" required>
        </div>
        <div class="mb-3">
            <label for="inputIngelogd" class="form-label">Ingelogd Datum (optioneel):</label>
            <input name="ingelogd" type="datetime-local" class="form-control" id="inputIngelogd">
        </div>
        <div class="mb-3">
            <label for="inputUitgelogd" class="form-label">Uitgelogd Datum (optioneel):</label>
            <input name="uitgelogd" type="datetime-local" class="form-control" id="inputUitgelogd">
        </div>
        <div class="mb-3">
            <label for="inputIsActief" class="form-label">Is Actief (1 = Ja, 0 = Nee):</label>
            <input name="isActief" type="number" min="0" max="1" class="form-control" id="inputIsActief" required>
        </div>
        <div class="mb-3">
            <label for="inputOpmerking" class="form-label">Opmerking:</label>
            <textarea name="opmerking" class="form-control" id="inputOpmerking"></textarea>
        </div>
        <div class="d-grid gap-2">
            <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Opslaan</button>
            <a href="index.php" class="btn btn-secondary btn-lg mt-2">Annuleren</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
