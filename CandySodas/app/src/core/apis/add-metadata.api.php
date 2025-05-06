<?php
include('../../config.inc.php');
global $CONFIG;

session_start();
Auth::loginSession();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

$uploadDirBase = __DIR__ . '/../../uploads/';
$jsonFilePath = '../../cached/metadata.json';

// Verifica se os campos obrigatórios estão presentes
if (!isset($_POST['content']) || empty($_POST['content']) || !isset($_POST['pubId']) || !isset($_POST['title'])) {
    echo json_encode(['success' => false, 'message' => 'Error to try to save a new metadata.']);
    exit;
}

$title = $_POST['title'];
$pubId = $_POST['pubId'];
$content = $_POST['content'];
$metadataType = $_POST['metadataType'];
$component = $_POST['component'];
$status = $_POST['status'];
$metaOrigin = $_POST['metaOrigin'];
$description = $_POST['description'];
$userId = Auth::getUserData($_SESSION['user'], "id");
$uuid = $_POST['id'];
$files = $_FILES['files'];

if (!is_array($files['name'])) {
    $files = [$files];
}

$todayDirectory = date('Y-m-d');
$uploadDir = $uploadDirBase . $todayDirectory . '/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$uploadedFilesData = [];

foreach ($files['name'] as $key => $filename) {
    if ($files['error'][$key] === UPLOAD_ERR_OK) {
        $fileTmpPath = $files['tmp_name'][$key];
        $fileName = basename($files['name'][$key]);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFilename = $uuid . ($fileExtension ? '.' . $fileExtension : '');
        
        $targetFilePath = $uploadDir . $newFilename;
        
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $uploadedFilesData[] = [
                'fileName' => $fileName,
                'directory' => $uploadDirBase . $todayDirectory . '/' . $newFilename,
                'originalDirectory' => $todayDirectory,
                'uploadPath' => $newFilename,
            ];
        }
    }
}

if (!file_exists($jsonFilePath)) {
    file_put_contents($jsonFilePath, json_encode([], JSON_PRETTY_PRINT));
}

$jsonData = file_get_contents($jsonFilePath);
$comments = json_decode($jsonData, true);

if (!is_array($comments)) {
    $comments = [];
}

$newEntry = [
    'id' => $uuid,
    'title' => $title,
    'content' => $content,
    'description' => $description,
    'metadataType' => $metadataType,
    'component' => $component,
    'metaOrigin' => $metaOrigin,
    'status' => $status,
    'pubId' => $pubId,
    'userId' => $userId,
    'createdAt' => date('Y-m-d H:i:s'),
    'uploadFiles' => $uploadedFilesData,
];

$comments[] = $newEntry;

if (file_put_contents($jsonFilePath, json_encode($comments, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Comentário adicionado com sucesso!', 'data' => $newEntry]);
} else {
    echo json_encode(['success' => false, 'message' => 'Falha ao salvar o comentário no JSON.']);
}
?>
