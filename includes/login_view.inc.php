<?php

declare(strict_types=1);

require_once 'dbh.inc.php';


function output_created()
{
    if (!empty($_SESSION["user_created"])) {
        echo $_SESSION["user_created"];
    } else {
        echo "Not available"; // Fallback message
    }
}

function getUserInfo(): array
{
    return [
        'username' => $_SESSION['user_username'],
        'voornaam' => $_SESSION['user_voornaam'],
        'datumaangemaakt' => $_SESSION['user_created'],
        'rolnaam' => $_SESSION['rol_naam']
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
<<<<<<< Updated upstream
                            echo "<tr><td colspan='7'>Nothing found</td></tr>";
=======
                            echo "<tr> 
                        <td colspan='5'>Can't find the last name</td>
                                  </tr>";
>>>>>>> Stashed changes
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


function getEmployeesWithROle($Achternaam = null)
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



                        <?php
                        function GetClassesWithName($Naam = null)
                        {
                            // Assuming zoekLesNaam returns the result based on the search term
                            $result = getClassesInfo($GLOBALS["pdo"], $Naam);
                        ?>


                            <div class="container gym-feature py-5">
                                <div class="tab-class">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-lg m-0">
                                            <thead class="bg-secondary text-white text-center">
                                                <tr>
                                                    <th>Class Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Min Participants</th>
                                                    <th>Max Participants</th>
                                                    <th>Availability</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center" id="class-schedule-body">

                                            <?php
                                            if (empty($result)) {
                                                echo "<tr><td colspan='7'>no lessons found with this name</td></tr>";
                                            } else {
                                                foreach ($result as $row) {
                                                    echo "<tr>
                                <td>{$row['Naam']}</td>
                                <td>{$row['Datum']}</td>
                                <td>{$row['Tijd']}</td>
                                <td>{$row['MinAantalPersonen']}</td>
                                <td>{$row['MaxAantalPersonen']}</td>
                                <td>{$row['Beschikbaarheid']}</td>
                                <td>{$row['Opmerking']}</td>
                            </tr>";
<<<<<<< Updated upstream

                            }
                        }
}
?>
=======
                                                }
                                            }
                                        }
                                            ?>
>>>>>>> Stashed changes
