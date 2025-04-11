<?php
// delete.php
include('../config/config.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    $success = false;
    $message = "Geen geldige ID opgegeven.";
} else {
    try {
        $stmt = $pdo->prepare("DELETE FROM Reservering WHERE Id = :id");
        $stmt->execute([':id' => $id]);

        $success = true;
        $message = "De reservering is succesvol verwijderd.";
    } catch (PDOException $e) {
        $success = false;
        $message = "Databasefout: " . $e->getMessage();
    }
}

// Delay and redirect
$redirect = 'overview_reservering.php';
$delay = 3;
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Verwijderen</title>
    <meta http-equiv="refresh" content="<?= $delay ?>;url=<?= htmlspecialchars($redirect) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <div class="alert <?= $success ? 'alert-success' : 'alert-danger' ?>" role="alert">
                    <h5><?= $success ? '✅ Gelukt' : '❌ Mislukt' ?></h5>
                    <p><?= htmlspecialchars($message) ?></p>
                </div>
                <p class="text-muted">U wordt binnen <?= $delay ?> seconden doorgestuurd...</p>
                <a href="<?= htmlspecialchars($redirect) ?>" class="btn btn-outline-secondary mt-2">Nu terugkeren</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
