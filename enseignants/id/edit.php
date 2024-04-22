<?php

error_reporting(E_ALL);

ini_set("display_errors", 1);
header("Access-Control-Allow-Origin:* ");
header("Access-Control-Allow-Headers:* ");
header("Access-Control-Allow-Methods:* ");

$db_conn = mysqli_connect("localhost", "root", "", "projet-vue");

if (!$db_conn) {
  die("Error: Could not connect" . mysqli_connect_error());
}

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case 'POST':
    $userPost = json_decode(file_get_contents('php://input'));
    $id = $_GET['id'];

    if (!is_numeric($id) || $id <= 0) {
      http_response_code(400);
      echo json_encode(['invalidID' => true]);
      exit;
    }

    $nom = $userPost->nom;
    $matricule = $userPost->matricule;
    $taux = $userPost->taux;
    $nbHeures = $userPost->nbHeures;

    $row = mysqli_query($db_conn, "UPDATE enseignants SET nom='$nom', matricule='$matricule', taux='$taux', nbHeures='$nbHeures' WHERE id=$id");

    if ($row) {
      echo json_encode(["updated" => true]);
    } else {
      http_response_code(500);
      echo json_encode(['updateError' => true]);
    }


  default:
    # code...
    break;
}
