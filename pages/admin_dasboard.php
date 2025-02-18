<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FitForFun - Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- I used a custom bootstrap cause i felt like it. DONT CHANGE ANYTHING. Kind regards
         Hernan -->
    <link href="../css/style.min.css" rel="stylesheet">
</head>

<body class="bg-white">
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

    <!-- MEMBERSHIPS BRO  -->
    <!-- MEMBERSHIPS BRO -->

    <!-- Memberships Start -->
    <div class="container-fluid position-relative bg-secondary">
        <div class="container">
            <div class="d-flex flex-column text-center mb-5">
       
                <h4 class="display-4 font-weight-bold text-white">Admin Dashboard</h4>
            </div>
            <div class="row">
                <!-- Basic Plan -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg-dark text-center text-white">
                        <div class="card-body py-4">
                            <h3 class="text-primary font-weight-bold">Manage Members</h3>
                            <h4 class="display-4 font-weight-bold text-white">
                                <span class="text-muted font-weight-light"></span>
                            </h4>
                            <ul class="list-unstyled my-4">
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <l><i class="fa fa-check text-primary mr-2"></i> </l>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <l><i class="fa fa-check text-primary mr-2"></i> </l>

                            </ul>
                            <a href="../account/leden-overzicht.php" class="btn btn-primary btn-lg">Memberships Overview</a>
                        </div>
                    </div>
                </div>
                <!-- Standard Plan -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg-primary text-center text-white">
                        <div class="card-body py-4">
                            <h3 class="text-white font-weight-bold">Manage Employees</h3>
                            <h4 class="display-4 font-weight-bold text-white"><span
                                    class="text-muted font-weight-light"></span></h4>
                            <ul class="list-unstyled my-4">
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <l><i class="fa fa-check text-primary mr-2"></i> </l>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                            </ul>
                            <a href="../account/Medewerker-overzicht.php" class="btn btn-light btn-lg">Employee
                                Overview</a>
                            <!-- Changed for better contrast -->
                        </div>
                    </div>
                </div>
                <!-- Premium Plan -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg-dark text-center text-white">
                        <div class="card-body py-4">
                            <h3 class="text-primary font-weight-bold">Manage bookings/lessons</h3>
                            <h4 class="display-4 font-weight-bold text-white"><span
                                    class="text-muted font-weight-light"></span></h4>
                            <ul class="list-unstyled my-4">
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <l><i class="fa fa-check text-primary mr-2"></i> </l>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                                <li><i class="fa fa-check text-primary mr-2"></i> </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-lg">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Memberships End -->

    <!--Footer-->
    <div id="footer-placeholder"></div>

    <script>
        fetch('../shared/footer.html')  // Adjusted path to the 'shared' folder
            .then(response => response.text())
            .then(data => {
                document.getElementById('footer-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading navbar:', error));
    </script>
    <!-- Navbar End -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>