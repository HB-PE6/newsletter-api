<?php

// Requête pour récupérer tous les emails
$stmt = $pdo->query("SELECT * FROM newsletter");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($data);

// Affichage des emails au format JSON
echo json_encode($data);
