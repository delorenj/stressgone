<?php

$_POST = json_decode(file_get_contents("php://input"),true);

$servername = "localhost";
$dbname = getenv("database");
$username = getenv("username");
$password = getenv("password");

// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

$comment = $_POST["comment"];
$ip = $_POST["ip"];
$timestamp = date('Y-m-d H:i:s');
$sql = "INSERT INTO feedback VALUES (NULL, '" . $comment . "', '" . $ip . "', '" . $timestamp . "')";

if ($conn->query($sql) === TRUE) {
    $msg = "record inserted successfully";
} else {
    $msg = "Error: " . $sql . "<br>" . $conn->error;
}
echo json_encode([
    "comment" => $comment,
    "message" => $msg
]);
