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

function ZoekLedenMetRole(PDO $pdo, $Achternaam = null): array
{
    $zoukOpNaam = false;
    $sql = "SELECT l.Voornaam, l.Tussenvoegsel, l.Achternaam, l.email, l.mobiel, l.relatienummer, Datumaangemaakt\n"
        . "FROM lid l\n";
    if ($Achternaam !== null) {
        $sql .= "WHERE l.Achternaam like :Achternaam\n";
        $zoukOpNaam = true;
    }
    $sql .= "ORDER BY l.relatienummer ASC;\n";

    $stmt = $pdo->prepare($sql);
    if ($zoukOpNaam === true) {
        $like = "%{$Achternaam}%";
        $stmt->bindParam(":Achternaam", $like);
    }
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function ZoekEmployeeMetRole(PDO $pdo): array
{
    $sql = "SELECT m.Voornaam, m.Tussenvoegsel, m.Achternaam, m.Nummer, m.Medewerkersoort, Datumaangemaakt
    FROM medewerker m\n
    ORDER BY m.Nummer ASC;\n";

    $stmt = $pdo->prepare($sql);
    
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




