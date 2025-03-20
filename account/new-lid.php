<?php
// Adjust the paths based on your folder structure.
require_once "../includes/config_session.inc.php";
require_once "../includes/newLid_view.inc.php";
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

    <!-- Registration Section -->
    <div class="container-fluid position-relative py-5 mt-7">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="font-weight-bold text-center mb-4">Create Your Account</h3>

                    <!-- Membership Selection -->

                    <!-- Standard Plan -->

                    <!-- Registration Form -->
                    <form action="../includes/newLid.inc.php" method="post">
                        <?php check_signup_errors(); ?>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Type firstname">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Middlename</label>
                            <input type="text" name="middlename" class="form-control" placeholder="Type Middlename">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lastname</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Type Lastname">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Type Email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone number</label>
                            <input type="tel" name="mobiel" class="form-control">
                        </div>
                        
                        <button class="btn btn-primary w-100">New Member</button>
                    </form>


                    <!-- Footer -->
                    <div id="footer-placeholder"></div>


                    <script>
                        fetch('../shared/footer.html')
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('footer-placeholder').innerHTML = data;
                            })
                            .catch(error => console.error('Error loading footer:', error));

                        // Google Address Autocomplete
                        function initAutocomplete() {
                            var input = document.getElementById("autocomplete");
                            var autocomplete = new google.maps.places.Autocomplete(input, {
                                types: ["geocode"]
                            });
                        }
                        google.maps.event.addDomListener(window, "load", initAutocomplete);

                        // Membership selection - click anywhere on the card
                        function selectMembership(id) {
                            document.getElementById(id).checked = true;
                            document.querySelectorAll(".membership-card").forEach(card => card.classList.remove("selected"));
                            document.querySelector(`label[for=${id}]`).classList.add("selected");
                        }

                        // Ensure Membership is Selected Before Submitting
                        function validateMembershipSelection() {
                            if (!document.querySelector('input[name="membership"]:checked')) {
                                alert("Please select a membership plan before registering.");
                                return false;
                            }
                            return true;
                        }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>