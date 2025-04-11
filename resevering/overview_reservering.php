<?php
// overview_reservering.php
require_once __DIR__ . '/../config/config.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM Reservering ORDER BY DatumAangemaakt DESC");
    $stmt->execute();
    $reserveringen = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Databasefout. Probeer later opnieuw.");
}

$today = new DateTime();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Reserveringen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container mt-5">
    <h3 class="fw-bold text-warning">Gym Reserveringen</h3>
    <a href="create_reservering.php" class="btn btn-success mb-3">+ Nieuwe Reservering</a>

    <?php if (!empty($reserveringen)): ?>
        <div class="table-responsive">
            <table class="table table-dark table-hover table-bordered align-middle text-center">
                <thead class="table-warning">
                    <tr>
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Telefoonnummer</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reserveringen as $res): 
                        $datum = $res->Datum ?? '';
                        $status = 'Onbekend';
                        if ($datum) {
                            $resDate = DateTime::createFromFormat('Y-m-d', $datum);
                            $status = ($resDate < $today)
                                ? '<span class="text-danger fw-bold">Verlopen</span>'
                                : htmlspecialchars($res->Reserveringstatus ?? 'Onbekend');
                        }
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($res->Voornaam ?? '') ?></td>
                            <td><?= htmlspecialchars($res->Tussenvoegsel ?? '') ?></td>
                            <td><?= htmlspecialchars($res->Achternaam ?? '') ?></td>
                            <td><?= htmlspecialchars($res->Nummer ?? '') ?></td>
                            <td><?= htmlspecialchars($datum) ?></td>
                            <td><?= htmlspecialchars($res->Tijd ?? '') ?></td>
                            <td><?= $status ?></td>
                            <td>
                                <a href="edit_reservering.php?id=<?= urlencode($res->Id) ?>" class="btn btn-warning btn-sm">✏️</a>
                                <a href="delete.php?id=<?= urlencode($res->Id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze reservering wilt verwijderen?');">🗑️</a>
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

