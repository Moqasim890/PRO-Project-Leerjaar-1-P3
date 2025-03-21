<?php

declare(strict_types=1);

require_once 'dbh.inc.php';

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

function getUsersWithROle($Achternaam = null)
{
    $result = ZoekLedenMetRole($GLOBALS["pdo"], $Achternaam);
?>
    <div class="container gym-feature py-5">
        <div class="tab-class">
            <div class="table-responsive">
                <table class="table table-bordered table-lg m-0">
                    <thead class="bg-secondary text-white text-center">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Relation number</th>
                            <th>Member added</th>

                        </tr>
                    </thead>
                    <tbody id="class-table-body">
                        <?php
                        if (empty($result)) {
                            echo "<tr> 
                        <td colspan='5'>Can't find the last name</td>
                                  </tr>";
                        } else {
                            foreach ($result as $row) {
                                // Samenvoegen van de naamvelden, waarbij trim() dubbele spaties voorkomt
                                $volledigeNaam = trim("{$row['Voornaam']} {$row['Tussenvoegsel']} {$row['Achternaam']}");

                                echo "<tr>
                                    <td style='text-align: start;
                                    margin-left: 50px;'>" . $volledigeNaam . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['mobiel'] . "</td>
                                    <td>" . $row['relatienummer'] . "</td>
                                    <td>" . date("d-m-Y", strtotime($row['Datumaangemaakt'])) . "</td>
                              </tr>";
                            }
                        }
                }
