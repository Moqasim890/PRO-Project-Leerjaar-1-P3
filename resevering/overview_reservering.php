<?php
include('../config/config.php');

try {
    // Fetch all reservations from the database
    $sql = "SELECT * FROM Reservering ORDER BY DatumAangemaakt DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $reserveringen = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Fout bij het ophalen van de reserveringen: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="nl">
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
<div class="container mt-5">
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
    <h3 class="fw-bold text-warning">Gym Reserveringen</h3>
    <div class="d-flex justify-content-between mb-3">
        <a href="create_reservering.php" class="btn btn-success">+ Nieuwe Reservering</a>
    </div>

    <?php if (!empty($reserveringen)): ?>
        <div class="table-responsive">
            <table class="table table-dark table-hover table-bordered">
                <thead class="table-warning text-center">
                    <tr>
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Telefoonnummer</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Reserveringsstatus</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $today = date('Y-m-d'); 
                    
                    foreach ($reserveringen as $reservering): 
                        $reserveringsdatum = $reservering->Datum;
                        $status = $reservering->Reserveringstatus;

                        if ($reserveringsdatum < $today) {
                            $status = '<span class="text-danger">FOUT: Verlopen</span>';
                        } else {
                            $status = htmlspecialchars($status);
                        }
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($reservering->Voornaam ?? '') ?></td>
                            <td><?= htmlspecialchars($reservering->Tussenvoegsel ?? '') ?></td>
                            <td><?= htmlspecialchars($reservering->Achternaam ?? '') ?></td>
                            <td><?= htmlspecialchars($reservering->Nummer ?? '') ?></td>
                            <td><?= htmlspecialchars($reserveringsdatum) ?></td>
                            <td><?= htmlspecialchars($reservering->Tijd ?? '') ?></td>
                            <td class="text-center"><?= $status ?></td> 
                            <td class="text-center">
                                <a href="edit_reservering.php?id=<?= $reservering->Id ?>" class="btn btn-warning btn-sm">✏️ Bewerken</a>
                                <a href="delete.php?id=<?= $reservering->Id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze reservering wilt verwijderen?');">🗑️ Verwijderen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Geen reserveringen gevonden.</div>
    <?php endif; ?>
</div>
</body>
</html>
