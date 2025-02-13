<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    

    try {

        require_once 'dbh.inc.php';
        require_once 'register_model.inc.php';
        require_once 'register_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (
            is_input_empty(
                $firstname,
                $lastname,
                $username,
                $pwd,
            )
        ) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            header("location: ../account/register.php");
            die();
        }

        create_user(
            $pdo,
            $firstname,
            $middlename,
            $lastname,
            $username,
            $pwd,
        );

        header("location: ../account/login.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die('Query failed ' . $e->getMessage());
    }
} else {
    header("location: ../account/register.php");
    die();
}
