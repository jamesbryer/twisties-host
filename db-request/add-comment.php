<?php
//start session to allow access to session variables
session_start();
include_once "../config/conf.php";
//if user is logged in, allow comment to be submitted
if (isset($_SESSION['user_id'])) {
    // Get the coordinates from the AJAX request
    $comment = $_POST['comment'];
    $route_id = $_POST['routeID'];
    $users_id = $_SESSION['user_id'];

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
    $sql = "INSERT INTO comments (comment, users_id, route_id) VALUES (:comment, :users_id, :route_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['comment' => $comment, 'users_id' => $users_id, 'route_id' => $route_id]);
} else {
    http_response_code(403);
    die("Access denied!");
}