<?php
header('Content-Type: application/json');
include('../../config.inc.php');

$jsonFilePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

if (isset($_POST['id'])) {
    $metaId = Security::inputSanitizer($_POST['id']);

    if (file_exists($jsonFilePath)) {
        $allData = json_decode(file_get_contents($jsonFilePath), true);

        if (is_array($allData)) {
            // Filtra os metadados removendo o item com o ID correspondente
            $filteredData = array_filter($allData, fn($item) => $item['id'] !== $metaId);
            $filteredData = array_values($filteredData);

            // Atualiza o arquivo JSON com os novos dados
            if (file_put_contents($jsonFilePath, json_encode($filteredData, JSON_PRETTY_PRINT))) {
                Auth::logUserAction($metaId, 'metadata removido com sucesso');
                echo json_encode(['success' => true, 'message' => 'Metadata removido com sucesso.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao salvar os dados.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Dados inválidos no arquivo.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Arquivo de metadados não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID do metadata não fornecido.']);
}

exit;
