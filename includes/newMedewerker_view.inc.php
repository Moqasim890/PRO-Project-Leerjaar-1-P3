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
    } else if (isset($_GET["newMedewerker"]) && $_GET["newMedewerker"] === "success") {
        echo '<div class="success-text">newMedewerker success</div>';
    }
}

function getEmployeesWithROle()
{
    $result = ZoekEmployeeMetRole($GLOBALS["pdo"]);
    ?>
        <div class="container gym-feature py-5">
            <div class="tab-class">
                <div class="table-responsive">
                    <table class="table table-bordered table-lg m-0">
                        <thead class="bg-secondary text-white text-center">
                            <tr>
                                <th>Whole naam</th>
                                <th>Employee number</th>
                                <th>Employees Role</th>
                                <th>Employee added</th>
                            </tr>
                        </thead>
                        <tbody id="class-table-body">
                        <?php
                        if (empty($result)) {
                            echo "<tr> 
                        <td colspan='4'></td>
                        </tr>";
                        } else {
                            foreach ($result as $row) {
                                // Samenvoegen van de naamvelden, waarbij trim() dubbele spaties voorkomt
                                $volledigeNaam = trim("{$row['Voornaam']} {$row['Tussenvoegsel']} {$row['Achternaam']}");

                                echo "<tr>
                            <td>" . ($volledigeNaam) . "</td>
                            <td>" . ($row['Nummer']) . "</td>
                            <td>" . ($row['Medewerkersoort']) . "</td>
                            <td>" . $row['Datumaangemaakt'] = date("d-m-Y", strtotime($row['Datumaangemaakt']));
                                "</td>
                          </tr>";
                            }
                        }
                    }
                        ?>
