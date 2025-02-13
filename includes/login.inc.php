<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) { // If no user found, return error
            $errors["login_incorrect"] = "Incorrect login info!";
        } else {
            $hashedpwd = $result["Wachtwoord"];

            // Verify password
            if (!is_password_wrong($pwd, $hashedpwd)) {
                $errors["incorrect_password"] = "Incorrect login info!";
            }
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header("Location: ../account/login.php");
            exit;
        }

        session_id(session_create_id() . "_" . $result["Id"]);
        $_SESSION["user_id"] = $result["Id"];
        $_SESSION["user_username"] = htmlspecialchars($result["Gebruikersnaam"]);
        $_SESSION["user_voornaam"] = htmlspecialchars($result["Voornaam"]);
        $_SESSION["user_created"] = htmlspecialchars($result["DatumAangemaakt"]);
        $_SESSION["rol_naam"] = htmlspecialchars($result["RolNaam"]);
        $_SESSION["last_regeneration"] = time();

        header("Location: /index.php?login=success");
        exit;
    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header("Location: ../account/login.php");
    exit;
}


