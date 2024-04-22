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

    $nom = $userPost->nom;
    $matricule = $userPost->matricule;
    $taux = $userPost->taux;
    $nbHeures = $userPost->nbHeures;

    $result = mysqli_query($db_conn, "INSERT INTO enseignants (nom, matricule, taux, nbHeures ) VALUES('$nom','$matricule','$taux','$nbHeures')");

    if ($result) {
      echo json_encode(["newUser" => true]);
      return;
    } else {
      echo json_encode(["Error" => "Data not inserted"]);
      return;
    }

  default:
    # code...
    break;
}
