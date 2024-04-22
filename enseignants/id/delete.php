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
  case 'GET':
    $userPost = json_decode(file_get_contents('php://input'));
    $id = $_GET['id'];

    if (!is_numeric($id) || $id <= 0) {
      http_response_code(400);
      echo json_encode(['invalidID' => true]);
      exit;
    }

    $row = mysqli_query($db_conn, "SELECT * FROM enseignants WHERE id=$id");
    $result = mysqli_query($db_conn, "DELETE FROM enseignants WHERE id=$id");

    if ($result) {
      $equipement = mysqli_fetch_assoc($row);
      echo json_encode($equipement);
    } else {
      http_response_code(500);
      echo json_encode(['updateError' => true]);
    }


  default:
    # code...
    break;
}
