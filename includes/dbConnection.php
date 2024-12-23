<?php
require '../vendor/autoload.php';

function connectdb()
{
    $name = getenv('DB_NAME');
    $host = '127.0.0.1';
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');

    $dsn = "mysql:host=127.0.0.1:3306;dbname=SyllabusReader";

    try {
        $pdo = new PDO(
            $dsn,
            $_ENV['DB_USER'],
            $_ENV['DB_PASS']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }

    return $pdo;
}
