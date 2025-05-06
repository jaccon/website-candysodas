<?php
header('Content-Type: application/json');
include('../../config.inc.php');

$jsonFilePath = $CONFIG['CONF']['cacheDir'] . '/forms-submit-data.json';

if (isset($_POST['id'])) {
    $leadId = Security::inputSanitizer($_POST['id']);

    if (file_exists($jsonFilePath)) {
        $allData = json_decode(file_get_contents($jsonFilePath), true);

        if (is_array($allData)) {
            // Filtrando os dados para remover o lead com o ID correspondente
            $filteredData = array_filter($allData, function($item) use ($leadId) {
                return $item['id'] !== $leadId;  // Acessando diretamente o campo 'id'
            });

            // Reindexando o array para garantir índices contínuos
            $filteredData = array_values($filteredData);

            if (file_put_contents($jsonFilePath, json_encode($filteredData, JSON_PRETTY_PRINT))) {
                Auth::logUserAction($leadId,'remove lead success');
                echo json_encode(['success' => true, 'message' => 'Lead removido com sucesso.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao salvar os dados.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Dados não encontrados ou inválidos no arquivo.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Arquivo de dados não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID do lead não fornecido.']);
}

exit;
