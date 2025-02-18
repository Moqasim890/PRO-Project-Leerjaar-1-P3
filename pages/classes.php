<?php
require_once "../includes/config_session.inc.php";
require_once "../includes/login_view.inc.php";
require_once "../includes/login_model.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Naam = $_POST["Naam"];

} else {
    $Naam = null;
}
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

    <!-- I used a custom bootstrap cause I felt like it. DONT CHANGE ANYTHING. Kind regards, Hernan -->
    <link href="../css/style.min.css" rel="stylesheet">
</head>



<!-- Load Navbar -->
<div id="navbar-placeholder"></div>

<script>
    fetch('../shared/navbar.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('navbar-placeholder').innerHTML = data;
        })
        .catch(error => console.error('Error loading navbar:', error));
</script>

<?php
    if (isset($_SESSION["user_id"])) { ?>
<div class="d-flex flex-column align-items-center text-center mb-5">
    <form action="classes.php" method="post" class="w-50 p-3 bg-dark rounded-3 shadow">
        <div class="input-group">
            <input type="search" name="Naam" class="form-control form-control-lg border-0 shadow-sm" placeholder="Search for classes">
            <button class="btn btn-primary btn-lg px-4">Search</button>
        </div>
    </form>
</div>
<?php } ?>

<?php
    if (!isset($_SESSION["user_id"])) { ?>
<div class="d-flex flex-column text-center mb-5">
        <h4 class="display-4 font-weight-bold">Log in to book a lesson</h4>
    </div>
    <?php } ?> 


<?php
    if (isset($_SESSION["user_id"])) { ?>
<div class="container gym-feature py-5">
    <div class="d-flex flex-column text-center mb-5">
        <h4 class="text-primary font-weight-bold">Class Timetable</h4>
        <h4 class="display-4 font-weight-bold">Working Hours and Class Time</h4>
    </div>
    <?php } ?>
    <?php
    if (isset($_SESSION["user_id"])) { ?>
    <div> <?php GetClassesWithName($Naam); ?></div>
    <?php } ?>
</div>


<!-- Footer -->
<div id="footer-placeholder"></div>

<script src="script.js"></script><!-- Navbar End -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>