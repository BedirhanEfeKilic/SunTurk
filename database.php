<?php

$host = 'localhost';
$db   = 'sunturk';
$dbUser = 'bit_academy';
$dbPass = 'bit_academy';
$charset = 'utf8mb4';

$dbConnectionString = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dbConnectionString, $dbUser, $dbPass, $options);
} catch (Exception $error) {
    echo $error->getMessage();
}