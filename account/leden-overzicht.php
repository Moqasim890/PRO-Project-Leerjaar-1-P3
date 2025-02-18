<?php
require_once "../includes/config_session.inc.php";
require_once "../includes/login_view.inc.php";
require_once "../includes/login_model.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Achternaam = $_POST["Achternaam"];

} else {
    $Achternaam = null;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Account Overview | FitForFun</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- I used a custom bootstrap cause I felt like it. DONT CHANGE ANYTHING. Kind regards, Hernan -->
    <link href="../css/style.min.css" rel="stylesheet">

</head>

<body class="bg-white">
    <div id="navbar-placeholder"></div>

    <script>
        fetch('../shared/navbar.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading navbar:', error));
    </script>

    <!-- Navbar End -->

    <div class="d-flex flex-column align-items-center text-center mb-5">
    <form action="leden-overzicht.php" method="post" class="w-50 p-3 bg-dark rounded-3 shadow">
        <div class="input-group">
            <input type="search" name="Achternaam" class="form-control form-control-lg border-0 shadow-sm" placeholder="Type here last name">
            <button class="btn btn-primary btn-lg px-4">Search Lid</button>
        </div>
    </form>
</div>

    <?php getUsersWithROle('Lid', $Achternaam); ?>

    <?php
    if (isValidRole(['Admin'])):
        ?>
        <a href="Medewerker-Overzicht.php">Medewerker Overzicht</a>
        <?php
    endif;
    ?>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>