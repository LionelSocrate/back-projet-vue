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
    $allUsers = mysqli_query($db_conn, 'SELECT * FROM enseignants');
    $users = [];

    if (mysqli_num_rows($allUsers) > 0) {
      while ($row = mysqli_fetch_assoc($allUsers)) {
        $users[] = $row;
      }

      echo json_encode(["users" => $users]);
      return;
    } else {
      echo json_encode(["noUsersFound" => true]);
      return;
    }

  default:
    # code...
    break;
}
