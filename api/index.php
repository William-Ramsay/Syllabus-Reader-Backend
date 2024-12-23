<?php
//!remove
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../controllers/courseController.php';
require '../includes/api-responses.php';
require '../includes/dbConnection.php';
require '../vendor/autoload.php';

//load env variables
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

//get basic SERVER variables
$uri = parse_url($_SERVER['REQUEST_URI']);
define('__BASE__', '/syllabus/api');
$endpoint = str_replace(__BASE__, "", $uri["path"]);
$method = $_SERVER['REQUEST_METHOD'];
$api_key = $_SERVER['HTTP_X_API_KEY'] ?? 0;
$queryString = $_SERVER['QUERY_STRING'];
parse_str($queryString, $params);


//! ADD MORE SECURITY IN FINAL BUILD
//CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT, PATCH");
header("Access-Control-Allow-Headers: Content-Type, X-API-Key, Authorization, Content-Length");
//preflight
if ($method === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT, PATCH");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length., X-API-Key");
    exit;
}

//!
print 'Endpoint: ' . $endpoint;


$pdo = connectdb();
$stmt = $pdo->prepare("CALL UserTasks(?,?)");

$stmt->execute(['1', 'CS101']);
$result = $stmt->fetchAll();

if (preg_match('#\/courses$#', $endpoint)) {
    $c = new courseController();
    if (preg_match('#\/courses\/\d+$#', $endpoint)) {
        $result = $c->getCourse();
    } else
        $result = $c->getAllCourses();
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMP</title>
</head>

<body>
    <pre>
    <?php print_r($result) ?>
</pre>
</body>

</html>