<?php

declare(strict_types=1);

function is_input_empty(
    string $firstname,
    string $lastname
): bool {
    if (
        empty($firstname) || empty($lastname)
        )
     {
        return true;
    } else {
        return false;
    }
}


function create_lid(
    object $pdo,
    string $firstname,
    string $middlename,
    string $lastname,
    string $email,
    string $mobiel
) {
    set_lid(
        $pdo,
        $firstname,
        $middlename,
        $lastname,
        $email,
        $mobiel
    );
}

