<?php

declare(strict_types=1);

function get_username(object $pdo, string $username): ?string
{
    $query = "SELECT Gebruikersnaam FROM gebruiker WHERE Gebruikersnaam = :Gebruikersnaam;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Gebruikersnaam", $username, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["Gebruikersnaam"] ?? null;
}

function set_user(
    object $pdo,
    string $firstname,
    string $middlename,
    string $lastname,
    string $username,
    string $pwd,
): void {
    $query = "INSERT INTO gebruiker 
    (Voornaam, Tussenvoegsel, Achternaam, Gebruikersnaam, Wachtwoord, IsIngelogd, Ingelogd, Uitgelogd, IsActief, Opmerking) 
    VALUES 
    (:Voornaam, :Tussenvoegsel, :Achternaam, :Gebruikersnaam, :Wachtwoord, 0, NULL, NULL, 1, NULL);";



    $stmt = $pdo->prepare($query);

    $options = ['cost' => 12];
    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":Voornaam", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":Tussenvoegsel", $middlename, PDO::PARAM_STR);
    $stmt->bindParam(":Achternaam", $lastname, PDO::PARAM_STR);
    $stmt->bindParam(":Gebruikersnaam", $username, PDO::PARAM_STR);
    $stmt->bindParam(":Wachtwoord", $hashedpwd, PDO::PARAM_STR);

    $stmt->execute();
}


