<?php
declare(strict_types=1);

function get_user(PDO $pdo, string $username): mixed
{
    // $query = "SELECT * FROM gebruiker WHERE Gebruikersnaam = :Gebruikersnaam;";
    $query = "SELECT g.Id, g.Voornaam, g.Tussenvoegsel, g.Achternaam, g.Gebruikersnaam, g.Wachtwoord, r.Naam as 'RolNaam' \n"
        . "FROM gebruiker g\n"
        . "LEFT JOIN rol r ON r.GebruikerId = g.Id\n"
        . "WHERE Gebruikersnaam = :Gebruikersnaam;"
        . "ORDER BY g.Id;";


    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Gebruikersnaam", $username);
    $stmt->execute();


    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
/**
 * Geef bepaalde leden op met de rol Lid.
 * @param PDO $pdo
 * @param mixed $Rol 
 * @return array
 */
function ZoekLedenMetRole(PDO $pdo, $Rol, $Achternaam = null): array
{
    $zoukOpNaam = false;
    $sql = "SELECT g.Id, g.Voornaam, g.Tussenvoegsel, g.Achternaam, g.Gebruikersnaam, r.Naam \n"
        . "FROM gebruiker g\n"
        . "LEFT JOIN rol r ON r.GebruikerId = g.Id\n"
        . "WHERE Naam = :Rol \n";
    if ($Achternaam !== null) {
        $sql .= "AND g.Achternaam like :Achternaam\n";
        $zoukOpNaam = true;
    }
    $sql .= "ORDER BY g.Voornaam;\n";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":Rol", $Rol);
    if ($zoukOpNaam === true) {
        $like = "%{$Achternaam}%";
        $stmt->bindParam(":Achternaam", $like);
    }
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getClassesInfo(PDO $pdo, $Naam = null)
{
    $zoeklesnaam = false;
    $sql = "SELECT Id, Naam, Datum, Tijd, MinAantalPersonen, MaxAantalPersonen, Beschikbaarheid, IsActief, Opmerking 
            FROM les l
            WHERE IsActief = 1 ";

    if ($Naam !== null) {
        $sql .= "AND l.Naam LIKE :Naam ";
        $zoeklesnaam = true;
    }
    $sql .= "ORDER BY Datum ASC, Tijd ASC;";
    $stmt = $pdo->prepare($sql);

    if ($zoeklesnaam) {
        $like = "%{$Naam}%";
        $stmt->bindParam(":Naam", $like, PDO::PARAM_STR);
    }
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}




