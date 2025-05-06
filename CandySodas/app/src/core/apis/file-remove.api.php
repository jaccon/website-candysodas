<?php
include('../../config.inc.php');
global $CONFIG;

$filePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido. Use DELETE.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['name'], $input['type']) || empty($input['name'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Nome ou tipo não fornecido.']);
    exit;
}

$name = $input['name'];
$type = $input['type'];
$dir = isset($input['dir']) ? $input['dir'] : '';

$physicalPath = $CONFIG['CONF']['uploadDir'] . '/' . ($dir ? $dir . '/' : '') . $name;

if (!file_exists($physicalPath)) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Arquivo ou diretório não encontrado.']);
    exit;
}

function deleteDirectory($dirPath) {
    if (!is_dir($dirPath)) {
        return false;
    }
    $files = array_diff(scandir($dirPath), ['.', '..']);
    foreach ($files as $file) {
        $filePath = $dirPath . '/' . $file;
        if (is_dir($filePath)) {
            deleteDirectory($filePath); // Remove subdiretórios recursivamente
        } else {
            unlink($filePath); // Remove arquivos
        }
    }
    return rmdir($dirPath); // Remove o diretório vazio
}

if ($type === 'file') {
    if (!unlink($physicalPath)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Falha ao excluir o arquivo físico.']);
        exit;
    }
} elseif ($type === 'directory') {
    if (!deleteDirectory($physicalPath)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Falha ao excluir o diretório. Verifique permissões.']);
        exit;
    }
}

if (file_exists($filePath)) {
    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);

    if ($type === 'file') {
        $data = array_filter($data, function ($file) use ($name) {
            return $file['filename'] !== $name;
        });
    } elseif ($type === 'directory') {
        $data = array_filter($data, function ($file) use ($name) {
            return $file['directoryName'] !== $name;
        });
    }

    file_put_contents($filePath, json_encode(array_values($data), JSON_PRETTY_PRINT));
}

echo json_encode(['success' => true, 'message' => 'Removido com sucesso.']);
exit;
?>
