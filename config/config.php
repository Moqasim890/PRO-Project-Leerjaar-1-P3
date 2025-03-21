<<<<<<< Updated upstream
<?php
/**
 * De inloggegevens van de gebruiker van de database
 */

// Naam van de mysql-server waar de service mysql opstaat
$dbHost = 'p3.host';

// Naam van de database
$dbName = 'gymsignup';

// Naam van de gebruiker die de queries uitvoerd
$dbUser = 'root';

// Wachtwoord van gebruiker rra-2408b
$dbPass = 'ServBay.dev';


try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
=======
<?php
/**
 * De inloggegevens van de gebruiker van de database
 */

// Naam van de mysql-server waar de service mysql opstaat
$dbHost = 'p3.host';

// Naam van de database
$dbName = 'gymsignup';

// Naam van de gebruiker die de queries uitvoerd
$dbUser = 'root';

// Wachtwoord van gebruiker rra-2408b
$dbPass = 'ServBay.dev';


try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
>>>>>>> Stashed changes
}