<?php
include('../../config.inc.php');
global $CONFIG;

session_start();
Auth::loginSession();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

// Diretório base para uploads
$uploadDirBase = __DIR__ . '/../../uploads/';
$jsonFilePath = '../../cached/metadata.json';

// Verificar se o arquivo e descrição foram enviados
if (!isset($_FILES['uploadFile']) || !isset($_POST['description']) || empty($_POST['description'])) {
    echo json_encode(['success' => false, 'message' => 'Arquivo e descrição são obrigatórios.']);
    exit;
}

$description = $_POST['description'];
$userId = Auth::getUserData($_SESSION['user'], "id");
$uuid = $_POST['uuid'] ?? uniqid();
$file = $_FILES['uploadFile'];
$metaTaxonomy = $_POST['metaTaxonomy'];

// Verifica se o diretório foi passado como parâmetro
$dir = isset($_POST['dir']) ? $_POST['dir'] : null;
$todayDirectory = date('Y-m-d');  // Diretório com a data de hoje

// Se o parâmetro 'dir' estiver presente, usa ele como o diretório de upload
if ($dir) {
    $uploadDir = $uploadDirBase . $dir . '/';
} else {
    // Caso contrário, cria o diretório com a data de hoje
    $uploadDir = $uploadDirBase . $todayDirectory . '/';
}

// Verifica se houve erro no upload do arquivo
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Erro ao enviar o arquivo.']);
    exit;
}

$originalName = basename($file['name']);
$fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
$newFilename = $uuid . ($fileExtension ? '.' . $fileExtension : '');

// Cria o diretório de destino se ele não existir
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Caminho para onde o arquivo será movido
$tempPath = $file['tmp_name'];
$targetFilePath = $uploadDir . $newFilename;

// Move o arquivo para o diretório final
if (!move_uploaded_file($tempPath, $targetFilePath)) {
    echo json_encode(['success' => false, 'message' => 'Falha ao mover o arquivo para o diretório de upload.']);
    exit;
}

// Atualiza o arquivo JSON
if (!file_exists($jsonFilePath)) {
    file_put_contents($jsonFilePath, json_encode([], JSON_PRETTY_PRINT));
}

$jsonData = file_get_contents($jsonFilePath);
$spaces = json_decode($jsonData, true);

if (!is_array($spaces)) {
    $spaces = [];
}

$newEntry = [
    'id' => $uuid,
    'description' => $description,
    'createdAt' => date('Y-m-d H:i:s'),
    'metadataType' => 'files',
    'filename' => $newFilename,
    'originalFileName' => $originalName,
    'directoryName' => $dir ? $dir : $todayDirectory, // Usa o 'dir' se estiver presente, senão usa a data de hoje
    'userId' => $userId,
    'metaTaxonomy' => $metaTaxonomy,
];

$spaces[] = $newEntry;

// Atualiza o arquivo JSON com as informações do novo arquivo
if (file_put_contents($jsonFilePath, json_encode($spaces, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Arquivo enviado e JSON atualizado com sucesso.', 'data' => $newEntry]);
} else {
    echo json_encode(['success' => false, 'message' => 'Falha ao atualizar o arquivo JSON.']);
}
?>
