<?php
declare(strict_types=1);

function get_user(object $pdo, string $username)
{
    // $query = "SELECT * FROM gebruiker WHERE Gebruikersnaam = :Gebruikersnaam;";
    $query = "SELECT g.*, r.Naam as 'RolNaam' \n"
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
