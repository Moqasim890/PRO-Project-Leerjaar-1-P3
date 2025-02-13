<?php

declare(strict_types=1);

function output_username()
{
    if (isset($_SESSION["user_id"])) {
        echo $_SESSION["user_username"];
    } 
}

function output_created()
{
    if (!empty($_SESSION["user_created"])) {
        echo $_SESSION["user_created"];
    } else {
        echo "Not available"; // Fallback message
    }
}

function getUserInfo(): array {
    return [
        'username'=> $_SESSION['user_username'],
        'voornaam' => $_SESSION['user_voornaam'],
        'datumaangemaakt' => $_SESSION['user_created']
    ];
}


function check_login_errors()
{
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        foreach ($errors as $error) {
            echo '<div class="reset-text">' . $error . '</div>'; // Applying the .reset-text class
        }

        unset($_SESSION["errors_login"]);
    } else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo '<div class="success-text">Signup success</div>';
    }
}