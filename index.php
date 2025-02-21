<?php
require_once __DIR__ . '/config/config.php';

if (!isset($dbHost, $dbName, $dbUser, $dbPass)) {
    die("Configuratiefout. Neem contact op met de beheerder.");
}

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=UTF8", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);

    $sql = "SELECT Id, Voornaam, Tussenvoegsel, Achternaam, Gebruikersnaam, IsActief, DatumAangemaakt 
            FROM Gebruiker ORDER BY DatumAangemaakt DESC";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $e) {
    die("Databasefout. Probeer later opnieuw.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gebruikers Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="container mt-3">
    <h3>Account Registratie</h3>
    <a href="./create_gebruiker.php" class="btn btn-primary mb-3">Nieuwe Gebruiker</a>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Gebruikersnaam</th>
                <th>Actief</th><th>Datum Aangemaakt</th><th>Bewerken</th><th>Verwijderen</th><th>Profiel</th><th>Reservering</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php if ($result): foreach ($result as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row->Voornaam) ?></td>
                    <td><?= htmlspecialchars($row->Tussenvoegsel) ?></td>
                    <td><?= htmlspecialchars($row->Achternaam) ?></td>
                    <td><?= htmlspecialchars($row->Gebruikersnaam) ?></td>
                    <td><?= $row->IsActief ? 'Ja' : 'Nee' ?></td>
                    <td><?= htmlspecialchars($row->DatumAangemaakt) ?></td>
                    <td><a href="update.php?id=<?= urlencode($row->Id) ?>" class="btn btn-warning btn-sm">Bewerken</a></td>
                    <td><a href="delete.php?id=<?= urlencode($row->Id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Verwijderen</a></td>
                    <td>
                        <?php if ($row->IsActief): ?>
                            <a href="gebruiker_profiel.php?id=<?= urlencode($row->Id) ?>" class="btn btn-info btn-sm">Bekijk Profiel</a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>Niet Actief</button>
                        <?php endif; ?>
                    </td>
                    <td><a href="resevering/overview_reservering.php" class="btn btn-success btn-sm">Reservering</a></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="10" class="text-center">Geen gebruikers gevonden.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
