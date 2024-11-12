<?php
// Database configuration
$host = 'localhost';  // Database host
$db = 'sdb';  // Your database name
$user = 'root';  // Database username (default is 'root' for XAMPP)
$pass = '';  // Database password (default is empty for XAMPP)
$charset = 'utf8mb4';

// Set DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Set PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create a PDO instance (connection to the database)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Handle errors
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
