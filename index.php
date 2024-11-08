<?php
$storage = 'data.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_SERVER['HTTP_NAME']) ? $_SERVER['HTTP_NAME'] : 'name'; //mini if else
    $message = file_get_contents('php://input');

    $data = json_encode([
        'date' => date('Y-m-d H:i:s'),
        'name' => $name,
        'message' => $message
    ], JSON_UNESCAPED_UNICODE) . PHP_EOL;

    file_put_contents($storage, $data, FILE_APPEND);

    exit();
}

$lines = file($storage, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
  $messages[] = json_decode($line, true);
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($messages, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
