<?php
require_once "../includes/config_session.inc.php";
require_once "../includes/login_view.inc.php";
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

   
<div class="container my-5">
        <div class="text-center mb-4">
            <h2 class="text-primary">Class Timetable</h2>
            <p class="lead">View available classes and book your spot!</p>
        </div>

        <!-- Class Schedule Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>Class Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="class-table-body">
                    <!-- Classes will be loaded here via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Footer -->
    <div id="footer-placeholder"></div>

    <script>
        fetch('../shared/footer.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('footer-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading footer:', error));
    </script>
<script src="script.js"></script>

</body>
</html>