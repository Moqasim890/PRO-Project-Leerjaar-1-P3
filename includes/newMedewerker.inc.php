<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $lastname = $_POST["lastname"];
    $number = $_POST["nummer"];
    $employeerole = $_POST["check"];
    

    try {

        require_once 'dbh.inc.php';
        require_once 'newMedewerker_model.inc.php';
        require_once 'newMedewerker_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (
            is_input_empty(
                $firstname,
                $lastname,
                $number,
                $employeerole

            )
        ) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (check_duplicate_user($pdo, $firstname, $lastname)) {
            $errors["member_taken"] = "Member already exists";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            header("location: ../account/newMedewerker.php");
            die();
        }

        create_lid(
            $pdo,
            $firstname,
            $middlename,
            $lastname,
            $number,
            $employeerole
        );

        header("location: ../account/Medewerker-overzicht.php?newMedewerker=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die('Query failed ' . $e->getMessage());
    }
} else {
    header("location: ../account/Medewerker-overzicht.php");
    die();
}
