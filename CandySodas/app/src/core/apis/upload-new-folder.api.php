<?php
include('../../config.inc.php');
global $CONFIG;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido. Use POST.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['folderName']) || empty(trim($input['folderName']))) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'O nome da pasta é obrigatório.']);
    exit;
}

$folderName = trim($input['folderName']);
$uploadDir = rtrim($CONFIG['CONF']['uploadDir'], '/') . '/';
$folderPath = $uploadDir . $folderName;

if (file_exists($folderPath)) {
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => 'A pasta já existe.']);
    exit;
}

if (!mkdir($folderPath, 0777, true)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao criar a pasta.']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Pasta criada com sucesso.']);
exit;

?>
