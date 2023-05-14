<?php
include_once "../config/conf.php";
// Connect to the MySQL database using PDO
$host = DB_SERVER;
$port = DB_PORT;
$dbname = DB_NAME;
$username = DB_USERNAME;
$password = DB_PASSWORD;

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    // Add error handling for connection errors
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Failed to connect to the database']);
    exit;
}

// Get search parameters from GET request
$searchRadius = $_GET['searchRadius'] ?? null;
$searchLat = $_GET['searchLat'] ?? null;
$searchLong = $_GET['searchLong'] ?? null;

// Prepare SQL statement
$sql = "SELECT * FROM routes WHERE ( 3959 * acos( cos( radians(:searchLat) ) * cos( radians( start_lat ) ) * cos( radians( start_long ) - radians(:searchLong) ) + sin( radians(:searchLat) ) * sin( radians( start_lat ) ) ) ) < :searchRadius LIMIT 100";
$stmt = $pdo->prepare($sql);

// Bind search parameters to prepared statement
$stmt->bindParam(':searchRadius', $searchRadius, PDO::PARAM_INT);
$stmt->bindParam(':searchLat', $searchLat, PDO::PARAM_STR);
$stmt->bindParam(':searchLong', $searchLong, PDO::PARAM_STR);

// Execute SQL statement
if (!$stmt->execute()) {
    // Add error handling for SQL errors
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Failed to retrieve routes']);
    exit;
}

// Fetch the routes as an associative array
$routes = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $routes[] = $row;
}

// Return the routes as JSON
header('Content-Type: application/json');
echo json_encode($routes);