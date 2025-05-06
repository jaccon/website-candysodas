<?php
include('../../config.inc.php');
global $CONFIG;

session_start();
Auth::loginSession();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

$uploadDirBase = __DIR__ . '/../../uploads/';
$jsonFilePath = '../../cached/task-comments.json';

// Verifica se os campos obrigatórios estão presentes
if (!isset($_FILES['files']) || !isset($_POST['comment']) || empty($_POST['comment']) || !isset($_POST['projectId']) || !isset($_POST['taskId'])) {
    echo json_encode(['success' => false, 'message' => 'Arquivo, comentário, projectId e taskId são obrigatórios.']);
    exit;
}

$comment = $_POST['comment'];
$projectId = $_POST['projectId'];
$taskId = $_POST['taskId'];
$userId = Auth::getUserData($_SESSION['user'], "id");
$uuid = $_POST['uuid'] ?? uniqid();
$files = $_FILES['files'];

if (!is_array($files['name'])) {
    $files = [$files];
}

// Cria o diretório para os uploads do dia
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
    'comment' => $comment,
    'taskId' => $taskId,
    'projectId' => $projectId,
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
