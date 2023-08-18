<?php
require_once __DIR__ . "/src/MessageGateway.php";
require_once __DIR__ . "/src/MessageController.php";

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/",$_SERVER["REQUEST_URI"]);

// checks if host is localhost
$pathIndex = str_contains($_SERVER['HTTP_HOST'],"localhost") ? 2 : 1;

if ($parts[$pathIndex] != "message") {
  http_response_code(404);
  exit;
}

$gateway = new MessageGateway;
$controller = new MessageController($gateway);

$controller->processRequest($_SERVER['REQUEST_METHOD'], $_POST);