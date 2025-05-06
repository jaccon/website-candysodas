<?php

header('Content-Type: application/json');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

include('../../config.inc.php');
global $CONFIG;

$jsonFilePath = '../../cached/spaces.json';
$directoryPath = dirname($jsonFilePath);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed. Use POST.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON payload.']);
    exit;
}

$requiredFields = ['name', 'description', 'spaceDeadline', 'priority', 'uuid', 'projectId', 'status'];
$errors = [];

foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        $errors[] = "The field '$field' is required.";
    }
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

if (!is_dir($directoryPath)) {
    if (!mkdir($directoryPath, 0755, true) && !is_dir($directoryPath)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to create the directory for spaces.json.']);
        exit;
    }
}

if (!file_exists($jsonFilePath)) {
    file_put_contents($jsonFilePath, json_encode([], JSON_PRETTY_PRINT));
}

$existingData = json_decode(file_get_contents($jsonFilePath), true);
if (!is_array($existingData)) {
    $existingData = [];
}

$newSpace = [
    'name' => $data['name'],
    'description' => $data['description'],
    'spaceDeadline' => $data['spaceDeadline'],
    'priority' => $data['priority'],
    'uuid' => $data['uuid'],
    'status' => $data['status'],
    'projectId' => $data['projectId'],
    'created_at' => date('Y-m-d H:i:s'),
];
$existingData[] = $newSpace;

if (file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Space saved successfully.', 'data' => $newSpace]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to save space.']);
}
