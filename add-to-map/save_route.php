<?php
include_once "../config/conf.php";
// Get the coordinates from the AJAX request
$startLat = $_POST['start_lat'];
$startLng = $_POST['start_long'];
$endLat = $_POST['end_lat'];
$endLng = $_POST['end_long'];


// Connect to the MySQL database using PDO
$host = DB_SERVER;
$port = DB_PORT;
$dbname = DB_NAME;
$username = DB_USERNAME;
$password = DB_PASSWORD;

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Insert the data into the routes table
$sql = "INSERT INTO routes (start_lat, start_long, end_lat, end_long) VALUES (:start_lat, :start_long, :end_lat, :end_long)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['start_lat' => $startLat, 'start_long' => $startLng, 'end_lat' => $endLat, 'end_long' => $endLng]);