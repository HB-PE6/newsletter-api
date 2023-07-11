<?php

$body = file_get_contents("php://input");
$data = json_decode($body, true);
$email = $data['email'];

$stmt = $pdo->prepare("INSERT INTO newsletter (email) VALUES (:email)");

try {
  $result = $stmt->execute(['email' => $email]);
  echo json_encode([
    'result' => $result
  ]);
} catch (PDOException $ex) {
  echo json_encode([
    'message' => $ex->getMessage(),
    'code' => $pdo->errorCode()
  ]);
}
