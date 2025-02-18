<?php
// Adjust the paths based on your folder structure.
require_once "../includes/config_session.inc.php";
require_once "../includes/register_view.inc.php";
require_once "../includes/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login | FitForFun</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- I used a custom bootstrap cause I felt like it. DONT CHANGE ANYTHING. Kind regards, Hernan -->
    <link rel="stylesheet" href="../css/css/reset.css">
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

    <!-- Login Section -->
    <div class="container-fluid position-relative py-5 mt-7">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="font-weight-bold text-center mb-4">Login to Your Account</h3>
                    <form action="../includes/login.inc.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" placeholder="Username" class="form-control form-label">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pwd" placeholder="Password" class="form-control form-label">
                        </div>
                        <?php
                        check_login_errors();
                        check_signup_errors();
                        ?>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <!-- Social Login Buttons -->
                    <div class="text-center mt-4">
                        <p class="mb-2">Or log in with</p>
                        <a href="#" class="btn btn-light w-100 mb-2 border">
                            <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" width="20" class="mr-2">
                            Sign in with Google
                        </a>
                        <a href="#" class="btn btn-dark w-100 mb-2 border">
                            <img src="https://cdn-icons-png.flaticon.com/512/179/179309.png" width="20" class="mr-2">
                            Sign in with Apple
                        </a>
                        <a href="#" class="btn btn-primary w-100 mb-2 border">
                            <img src="https://cdn-icons-png.flaticon.com/512/732/732221.png" width="20" class="mr-2">
                            Sign in with Microsoft
                        </a>
                    </div>

                    <div class="mt-3 text-center">
                        <small>Don't have an account? <a href="register.php">Register here</a></small>
                    </div>
                </div>
            </div>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>