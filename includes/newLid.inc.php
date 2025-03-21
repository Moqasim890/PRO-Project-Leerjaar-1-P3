<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $mobiel = $_POST["mobiel"];
    

    try {

        require_once 'dbh.inc.php';
        require_once 'newLid_model.inc.php';
        require_once 'newLid_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (
            is_input_empty(
                $firstname,
                $lastname,
                 $email,
                 $mobiel

            )
        ) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (check_duplicate_user($pdo, $email)) {
            $errors["member_taken"] = "Member already exists";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            header("location: ../account/new-lid.php");
            die();
        }

        create_lid(
            $pdo,
            $firstname,
            $middlename,
            $lastname,
            $email,
                    $mobiel
        );

        header("location: ../account/leden-overzicht.php?newLid=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die('Query failed ' . $e->getMessage());
    }
} else {
    header("location: ../account/leden-overzicht.php");
    die();
}
