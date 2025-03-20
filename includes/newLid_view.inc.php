<?php

declare(strict_types=1);


function check_signup_errors()
{

    // Check if errors exist in the session
    if (isset($_SESSION["errors_signup"])) {
        // Loop through the errors and display them with your custom class
        $errors = $_SESSION["errors_signup"];
        foreach ($errors as $error) {
            echo '<div class="reset-text">' . $error . '</div>'; // Applying the .reset-text class
        }
        // Clear errors from session after displaying
        unset($_SESSION["errors_signup"]);
    } else if (isset($_GET["newLid"]) && $_GET["newLid"] === "success") {
        echo '<div class="success-text">newLid success</div>';
    }
}
