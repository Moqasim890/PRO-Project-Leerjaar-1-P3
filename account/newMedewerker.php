<?php
// Adjust the paths based on your folder structure.
require_once "../includes/config_session.inc.php";
require_once "../includes/newMedewerker_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register | FitForFun</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">


    <!-- I used a custom bootstrap cause I felt like it. DONT CHANGE ANYTHING. Kind regards, Hernan -->
    <link rel="stylesheet" href="../css/css/reset.css">
    <link href="../css/style.min.css" rel="stylesheet">

    <!-- Google Places API for Address Autocomplete -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_API_KEY&libraries=places"></script>

</head>

<body class="bg-white">

    Load Navbar
    <div id="navbar-placeholder"></div>

    <script>
        fetch('../shared/navbar.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('navbar-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading navbar:', error));
    </script>

    <!-- Registration Section -->
    <div class="container-fluid position-relative py-5 mt-7">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="font-weight-bold text-center mb-4">Create Your Account</h3>

                    <!-- Membership Selection -->

                    <!-- Standard Plan -->

                    <!-- Registration Form -->
                    <form action="../includes/newMedewerker.inc.php" method="post">
                        <?php check_signup_errors(); ?>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Middlename</label>
                            <input type="text" name="middlename" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lastname</label>
                            <input type="text" name="lastname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Medewerker Nummer</label>
                            <input type="number" name="nummer" class="form-control">
                        </div>
                        <div class="mb-3">
                        <input type="radio" id="Manager" name="check" value="Manager">
                        <label for="Manager">Manager</label><br>
                        <input type="radio" id="Beheerder " name="check" value="Beheerder">
                        <label for="Beheerder ">Beheerder </label><br>
                        <input type="radio" id="Diskmedewerker" name="check" value="Diskmedewerker">
                        <label for="Diskmedewerker">Diskmedewerker</label><br><br>
                        </div>
                        
                        <button class="btn btn-primary w-100">New Member</button>
                    </form>

</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>