<?php
include('../../config.inc.php');
global $CONFIG;

$jsonFile = $CONFIG['CONF']['cacheDir'].'/forms-submit-data.json';

if (!file_exists($jsonFile)) {
    http_response_code(404);
    echo 'Arquivo JSON não encontrado.';
    exit;
}

$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

if ($data === null) {
    http_response_code(500);
    echo 'Erro ao decodificar o JSON.';
    exit;
}

// Verifica se o 'id' foi passado na URL via GET e filtra os dados pelo formId
$formId = $_GET['id'] ?? null;

if ($formId !== null) {
    // Filtra os dados de acordo com o formId
    $data = array_filter($data, function($entry) use ($formId) {
        return isset($entry['formId']) && $entry['formId'] == $formId; // Filtra os dados pelo 'formId'
    });
}

// Gera o nome do arquivo CSV com base na data
$csvFileName = 'report_' . date('Y-m-d_H-i-s') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $csvFileName . '"');

$output = fopen('php://output', 'w');

// Escreve o cabeçalho no CSV
fwrite($output, "\xEF\xBB\xBF");
fputcsv($output, ['Name', 'Phone', 'Email', 'Message', 'Submitted At']);

// Itera sobre os dados filtrados e escreve cada linha no CSV
foreach ($data as $entry) {
    // Acessa diretamente os campos do JSON
    $row = [
        mb_convert_encoding($entry['name'] ?? '', 'UTF-8', 'UTF-8'),  // Nome
        mb_convert_encoding($entry['phone'] ?? '', 'UTF-8', 'UTF-8'), // Telefone
        mb_convert_encoding($entry['email'] ?? '', 'UTF-8', 'UTF-8'), // E-mail
        mb_convert_encoding($entry['message'] ?? '', 'UTF-8', 'UTF-8'),// Mensagem
        mb_convert_encoding($entry['createdAt'] ?? '', 'UTF-8', 'UTF-8') // Data de envio
    ];

    // Escreve a linha no arquivo CSV
    fputcsv($output, $row);
}

// Fecha o arquivo
fclose($output);
exit;
?>
