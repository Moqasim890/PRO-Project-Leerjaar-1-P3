<?php
include('../config/config.php'); 

try {
    // Database connection
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);

    // Fetch specific user profile using `Id` passed as a GET parameter
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $sql = "SELECT Id, Voornaam, Tussenvoegsel, Achternaam, Gebruikersnaam, IsActief, DatumAangemaakt, DatumGewijzigd 
                    FROM Gebruiker 
                    WHERE Id = :id";

            $statement = $pdo->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $gebruiker = $statement->fetch();

            if (!$gebruiker) {
                die("Geen gebruiker gevonden met ID $id");
            }
        } else {
            die("Ongeldig ID opgegeven.");
        }
    } else {
        die("Geen ID opgegeven.");
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gebruiker Profiel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-3 sser">
        <h3 class="mb-3">Gebruiker Profiel</h3>

       
        <div class="card ssss">
            <div class="card-header bg-primary text-white">
                <h5>Profiel van: <?= htmlspecialchars($gebruiker->Voornaam . ' ' . $gebruiker->Tussenvoegsel . ' ' . $gebruiker->Achternaam) ?></h5>
            </div>
            <div class="card-body">
                <p><strong>Voornaam:</strong> <?= htmlspecialchars($gebruiker->Voornaam) ?></p>
                <p><strong>Tussenvoegsel:</strong> <?= htmlspecialchars($gebruiker->Tussenvoegsel) ?></p>
                <p><strong>Achternaam:</strong> <?= htmlspecialchars($gebruiker->Achternaam) ?></p>
                <p><strong>Gebruikersnaam:</strong> <?= htmlspecialchars($gebruiker->Gebruikersnaam) ?></p>
                <p><strong>Actief:</strong> <?= $gebruiker->IsActief ? 'Ja' : 'Nee' ?></p>
                <p><strong>Datum Aangemaakt:</strong> <?= htmlspecialchars($gebruiker->DatumAangemaakt) ?></p>
                <p><strong>Datum Gewijzigd:</strong> <?= htmlspecialchars($gebruiker->DatumGewijzigd) ?></p>
            </div>
            <div class="card-footer text-center">
                <a href="index.php" class="btn btn-secondary">Terug naar Overzicht</a>
                <a href="update.php?id=<?= $gebruiker->Id ?>" class="btn btn-warning">Profiel Bewerken</a>
                <a href="delete.php?id=<?= $gebruiker->Id ?>" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Profiel Verwijderen</a>
            </div>
        </div>
    </div>
</body>
</html>
