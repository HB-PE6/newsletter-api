<?php

use Symfony\Component\Dotenv\Dotenv;

require_once 'vendor/autoload.php';

header('Content-type: application/json; charset=UTF-8');

$dotenv = new Dotenv();
$dotenv->loadEnv('.env');

[
  'DB_USER' => $user,
  'DB_PASSWORD' => $password,
  'DB_NAME' => $dbname,
  'DB_HOST' => $host,
  'DB_PORT' => $port,
  'DB_CHARSET' => $charset
] = $_ENV;

// Connexion à la BDD avec PDO
try {
  $pdo = new PDO(
    "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset",
    $user,
    $password
  );
  // var_dump($pdo);
} catch (PDOException $ex) {
  http_response_code(500);
  echo json_encode([
    'error' => true,
    'message' => $ex->getMessage()
  ]);
  exit;
}

if ($_SERVER['REQUEST_URI'] === '/emails' && $_SERVER['REQUEST_METHOD'] === 'GET') {
  require_once 'index.php';
  exit;
}

if ($_SERVER['REQUEST_URI'] === '/emails' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once 'newEmail.php';
  exit;
}
