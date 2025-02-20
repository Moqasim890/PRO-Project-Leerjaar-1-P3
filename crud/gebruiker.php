<?php
include('../config/config.php');

try {
    // Database connection
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);

    // SQL query to fetch user data
    $sql = "SELECT Id, Voornaam, Tussenvoegsel, Achternaam, Gebruikersnaam, IsActief, DatumAangemaakt 
            FROM Gebruiker
            ORDER BY DatumAangemaakt DESC";

    $statement = $pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>FitForFun - Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link href="../img/favicon.ico" rel="icon">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    
        <!-- I used a custom bootstrap cause i felt like it. DONT CHANGE ANYTHING. Kind regards
         Hernan -->
        <link href="../css/style.min.css" rel="stylesheet">
    </head>
<body>
<div id="navbar-placeholder"></div>
    
    <script>
        fetch('../shared/navbar.php')  // Adjusted path to the 'shared' folder
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading navbar:', error));
    </script>
</div>
    <div class="container mt-3">
        <h3 class="mb-3">account registratie</h3>


        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Gebruikersnaam</th>
                    <th>Actief</th>
                    <th>Datum Aangemaakt</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                    <th>Profiel</th>   
                    <th>reservering</th>
                </tr>
            </thead>
            <tbody class="table-dark">
                <?php if (!empty($result)): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row->Voornaam) ?></td>
                            <td><?= htmlspecialchars($row->Tussenvoegsel) ?></td>
                            <td><?= htmlspecialchars($row->Achternaam) ?></td>
                            <td><?= htmlspecialchars($row->Gebruikersnaam) ?></td>
                            <td><?= $row->IsActief ? 'Ja' : 'Nee' ?></td>
                            <td><?= htmlspecialchars($row->DatumAangemaakt) ?></td>
                           
                            <td>
                                <a href="update.php?id=<?= $row->Id ?>" class="btn btn-warning btn-sm">Bewerken</a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?= $row->Id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Verwijderen</a>
                            </td> 
                            <td>
                                <?php if ($row->IsActief): ?>
                                    <a href="gebruiker_profiel.php?id=<?= $row->Id ?>" class="btn btn-info btn-sm">Bekijk Profiel</a>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" disabled>Niet Actief</button>
                                    <div class="alert alert-danger mt-2" role="alert">Deze gebruiker is niet actief.</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="../resevering/overview_reservering.php">reservering</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Geen gebruikers gevonden.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
