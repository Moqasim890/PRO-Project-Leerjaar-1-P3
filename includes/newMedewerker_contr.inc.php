<?php

declare(strict_types=1);

function is_input_empty(
    string $firstname,
    string $lastname,
    int $number,
    string $employeerole
    

): bool {
    if (
        empty($firstname) || empty($lastname)
        || empty($number) || empty($employeerole)
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
    int $number,
    string $employeerole
) {
    set_lid(
        $pdo,
        $firstname,
        $middlename,
        $lastname,
        $number,
        $employeerole
    );
}

