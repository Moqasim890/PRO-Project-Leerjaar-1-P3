<?php

declare(strict_types=1);

function check_duplicate_user(
    PDO $pdo,
    string $firstname,
    string $lastname
): bool {
    $query = "SELECT Voornaam, Achternaam
        FROM medewerker WHERE Voornaam = :Voornaam
        AND Achternaam = :Achternaam;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Voornaam", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":Achternaam", $lastname, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false;
}

function set_lid(
    PDO $pdo,
    string $firstname,
    ?string $middlename, // Middlename mag NULL zijn
    string $lastname,
    int $number,
    string $employeerole
): void {
    // Correcte SQL-query zonder extra komma of niet-bestaande parameter
    $query = "INSERT INTO medewerker 
            (Voornaam, Tussenvoegsel, Achternaam, Nummer, Medewerkersoort, Isactief) 
            VALUES 
            (:Voornaam, :Tussenvoegsel, :Achternaam, :Nummer, :Medewerkersoort, 1);";

    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":Voornaam", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":Tussenvoegsel", $middlename, PDO::PARAM_STR);
    $stmt->bindParam(":Achternaam", $lastname, PDO::PARAM_STR);
    $stmt->bindParam(":Nummer", $number, PDO::PARAM_INT);
    $stmt->bindParam(":Medewerkersoort", $employeerole, PDO::PARAM_STR);

    $stmt->execute();
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


