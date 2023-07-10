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
  echo "Erreur lors de la connexion à la base de données";
  exit;
}

// Requête pour récupérer tous les emails
$stmt = $pdo->query("SELECT * FROM newsletter");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($data);

// Affichage des emails au format JSON
echo json_encode($data);
