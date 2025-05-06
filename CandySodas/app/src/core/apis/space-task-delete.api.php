<?php
include('../../config.inc.php');
global $CONFIG;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (isset($data['id'])) {
    $uuidToRemove = $data['id'];
    
    $jsonFilePath = './../../cached/space-tasks.json';

    if (!file_exists($jsonFilePath)) {
        echo json_encode(['success' => false, 'message' => 'File not found.']);
        exit;
    }

    $jsonData = file_get_contents($jsonFilePath);
    $spaces = json_decode($jsonData, true);

    if (!is_array($spaces)) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON structure.']);
        exit;
    }

    $updatedSpaces = array_filter($spaces, function($space) use ($uuidToRemove) {
        return $space['id'] !== $uuidToRemove;
    });

    $updatedSpaces = array_values($updatedSpaces);

    if (count($updatedSpaces) !== count($spaces)) {
        if (file_put_contents($jsonFilePath, json_encode($updatedSpaces, JSON_PRETTY_PRINT))) {
            echo json_encode(['success' => true, 'message' => 'Space removed successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save updated data.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'UUID not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'UUID is required.']);
}
?>
