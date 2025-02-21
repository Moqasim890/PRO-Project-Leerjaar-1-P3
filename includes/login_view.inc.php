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

function getUsersWithROle($Rol, $Achternaam = null)
{
    $result = ZoekLedenMetRole($GLOBALS["pdo"], $Rol, $Achternaam);
    ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody id="class-table-body">
                <?php
                if (empty($result)) {

                    echo " <tr> 
                <td>  NotHing found </td>
               </tr>";
                } else {


                    foreach ($result as $row) {
                        echo "<tr>
            <td>{$row['Voornaam']}</td>
            <td>{$row['Tussenvoegsel']}</td>
            <td>{$row['Achternaam']}</td>
            <td>{$row['Gebruikersnaam']}</td>
        </tr>";
                    }
                }
                ?>
                <!-- Classes will be loaded here via JavaScript -->
            </tbody>
        </table>
    </div>
    </div>
    <?php

}
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
                            echo "<tr><td colspan='7'>Nothing found</td></tr>";
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

                            }
                        }
}
?>
