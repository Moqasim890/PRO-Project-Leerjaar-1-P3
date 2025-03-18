<?php

declare(strict_types=1);

function check_duplicate_user(
    PDO $pdo,
    string $email
): bool {
    $query = "SELECT Email
        FROM lid WHERE Email = :Email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false;
}

function getRelationNumber($pdo) {
    $today = date('Ymd'); // Huidige datum in YYYYMMDD-formaat

    // Haal het hoogste relatienummer van vandaag op
    $stmt = $pdo->prepare("SELECT MAX(relatienummer) FROM lid WHERE relatienummer LIKE :todayPattern");
    $stmt->execute(['todayPattern' => "$today%"]);
    $maxNumber = $stmt->fetchColumn();

    // Bepaal het nieuwe nummer
    $newNumber = $maxNumber ? intval(substr($maxNumber, 8)) + 1 : 1;

    // Vorm het relatienummer met voorloopnullen (001, 002, ...)
    return $today . str_pad((string)$newNumber, 3, '0', STR_PAD_LEFT);

}




function set_lid(
    PDO $pdo,
    string $firstname,
    string $middlename,
    string $lastname,
    string $email,
    string $mobiel
): void {
    // Haal het nieuwe relatienummer op
    $newRelationNumber = getRelationNumber($pdo);

    // De SQL-query voor het toevoegen van een nieuw lid
    $query = "INSERT INTO lid 
            (Voornaam, Tussenvoegsel, Achternaam, email, mobiel, Isactief, relatienummer) 
            VALUES 
            (:Voornaam, :Tussenvoegsel, :Achternaam, :email, :mobiel, 1, :relatienummer);";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Voornaam", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":Tussenvoegsel", $middlename, PDO::PARAM_STR);
    $stmt->bindParam(":Achternaam", $lastname, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":mobiel", $mobiel, PDO::PARAM_STR);
    $stmt->bindParam(":relatienummer", $newRelationNumber, PDO::PARAM_STR);
    $stmt->execute();
}

        // Get the last inserted ID
    //     $gebruikerId = $pdo->lastInsertId();

    //     // Insert the role
    //     $roleQuery = "INSERT INTO rol (GebruikerId, Naam, IsActief) VALUES (:GebruikerId, 'Lid', 1);";
    //     $roleStmt = $pdo->prepare($roleQuery);
    //     $roleStmt->bindParam(":GebruikerId", $gebruikerId, PDO::PARAM_INT);
    //     $roleStmt->execute();
    //     $pdo->commit();
    // } catch (Exception $x) {
    //     $pdo->rollBack();
    //     die('Unable to create member ' . $x->getMessage());
    // }

