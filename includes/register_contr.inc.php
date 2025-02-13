<?php

declare(strict_types=1);

function is_input_empty(
    string $firstname,
    string $lastname,
    string $username,
    string $pwd,
): bool {
    if (
        empty($firstname) || empty($lastname) || empty($username)
        || empty($pwd))
     {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $username)
{
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}


function create_user(
    object $pdo,
    string $firstname,
    string $middlename,
    string $lastname,
    string $username,
    string $pwd,
) {
    set_user(
        $pdo,
        $firstname,
        $middlename,
        $lastname,
        $username,
        $pwd,
    );
}

