<?php
require_once "../includes/config_session.inc.php";
require_once "../includes/login_view.inc.php";
require_once "../includes/db_connection.inc.php"; // Database connection

// Check if the user is an admin
if (!isValidRole(['Admin'])) {
    header("Location: ../index.php"); // Redirect non-admins
    exit();
}

// Fetch all users with their roles
$sql = "
    SELECT 
        g.Id AS GebruikerId,
        g.Gebruikersnaam,
        g.Voornaam,
        g.Achternaam,
        g.IsActief,
        g.DatumAangemaakt,
        r.Naam AS Rol
    FROM Gebruiker g
    LEFT JOIN Rol r ON g.Id = r.GebruikerId
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Admin Panel | GymSignUp</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="../css/style.min.css" rel="stylesheet">

    <style>
        .content-spacing { margin-top: 120px; }
        .table-responsive { overflow-x: auto; }
    </style>
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

    <!-- ADMIN USER OVERVIEW -->
    <div class="container mt-5"> 
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card border-0 bg-secondary text-white text-center p-3">
                    <img src="../img/admin_avatar.jpg" class="rounded-circle mb-3" width="100" alt="Admin Avatar">
                    <h4 class="font-weight-bold"><?php echo getUserInfo()["username"]; ?></h4>
                    <p class="text-muted">Admin Panel</p>
                    <hr class="bg-light">
                    <ul class="list-unstyled text-left">
                        <li class="py-2"><i class="fa fa-users text-primary mr-2"></i> <a href="#" class="text-white">Manage Users</a></li>
                        <li class="py-2"><i class="fa fa-cogs text-primary mr-2"></i> <a href="#" class="text-white">Settings</a></li>
                        <li class="py-2"><i class="fa fa-sign-out-alt text-danger mr-2"></i> <a href="logout.php" class="text-danger">Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="font-weight-bold mb-4">User Accounts Overview</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['GebruikerId']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Gebruikersnaam']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Voornaam'] . " " . $user['Achternaam']); ?></td>
                                    <td><?php echo htmlspecialchars($user['Rol'] ?? 'Geen rol'); ?></td>
                                    <td>
                                        <?php if ($user['IsActief'] == 1): ?>
                                            <span class="badge badge-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['DatumAangemaakt']); ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?php echo $user['GebruikerId']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete_user.php?id=<?php echo $user['GebruikerId']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ADMIN USER OVERVIEW END -->

    <div id="footer-placeholder"></div>

    <script>
        fetch('../shared/footer.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('footer-placeholder').innerHTML = data;
            })
            .catch(error => console.error('Error loading footer:', error));
    </script>
</body>
</html>