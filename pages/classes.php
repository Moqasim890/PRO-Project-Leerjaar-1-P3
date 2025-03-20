<?php
require_once "../includes/config_session.inc.php";
require_once "../includes/login_view.inc.php";
require_once "../includes/login_model.inc.php";

$Naam = $_SERVER["REQUEST_METHOD"] === "POST" ? $_POST["Naam"] ?? null : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Classes | FitForFun</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Custom Bootstrap - Do not change -->
    <link href="../css/style.min.css" rel="stylesheet">
</head>
<body class="bg-white">

    <!-- Load Navbar -->
    <div id="navbar-placeholder"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('../shared/navbar.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('navbar-placeholder').innerHTML = data;
                })
                .catch(error => console.error('Error loading navbar:', error));
        });
    </script>

    <main class="container mt-4">
        <?php if (isset($_SESSION["user_id"])): ?>
            <div class="d-flex flex-column align-items-center text-center mb-5">
                <form action="classes.php" method="post" class="w-50 p-3 bg-dark rounded-3 shadow">
                    <div class="input-group">
                        <input type="search" name="Naam" class="form-control form-control-lg border-0 shadow-sm" placeholder="Search for classes">
                        <button class="btn btn-primary btn-lg px-4">Search</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <div class="text-center mb-5">
            <h4 class="text-primary font-weight-bold">Class Timetable</h4>
            <h4 class="display-4 font-weight-bold">Working Hours and Class Time</h4>
        </div>

        <div class="container gym-feature py-5 text-center">
            <?php if (function_exists('isValidRole') && isValidRole(['Admin'])): ?>
                <a href="../crud/gebruiker.php" class="btn btn-primary rounded-pill px-4 text-white">Overview</a>
            <?php endif; ?>
        </div>

        <div>
            <?php if (function_exists('GetClassesWithName')): ?>
                <?php GetClassesWithName($Naam); ?>
            <?php else: ?>
                <p class="text-danger">Error: Function GetClassesWithName() not found.</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Load Footer -->
    <div id="footer-placeholder"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('../shared/footer.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('footer-placeholder').innerHTML = data;
                })
                .catch(error => console.error('Error loading footer:', error));
        });
    </script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
