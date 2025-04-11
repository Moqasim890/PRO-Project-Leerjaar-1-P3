<?php
$success = isset($_GET['success']) && $_GET['success'] === '1';
$message = $_GET['msg'] ?? 'Geen bericht beschikbaar.';
$redirect = $_GET['redirect'] ?? ($success ? 'overview_reservering.php' : 'javascript:history.back()');
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bericht</title>
    <meta http-equiv="refresh" content="3;url=<?= htmlspecialchars($redirect) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="alert <?= $success ? 'alert-success' : 'alert-danger' ?> text-center mb-4" role="alert">
                    <h5 class="mb-3"><?= $success ? '✅ Gelukt' : '❌ Mislukt' ?></h5>
                    <?= htmlspecialchars($message) ?>
                </div>
                <p class="text-center text-muted">
                    U wordt binnen 3 seconden doorgestuurd...
                </p>
                <div class="text-center">
                    <a href="<?= htmlspecialchars($redirect) ?>" class="btn btn-outline-secondary mt-2">Nu terugkeren</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
