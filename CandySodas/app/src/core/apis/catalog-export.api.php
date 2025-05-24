<?php
include('../../config.inc.php');
global $CONFIG;

$catalogJsonPath = $CONFIG['CONF']['cacheDir'] . '/catalog.json';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=relatorio_produtos.csv');

if (!file_exists($catalogJsonPath)) {
    http_response_code(404);
    echo 'Arquivo catalog.json não encontrado';
    exit;
}

$jsonData = file_get_contents($catalogJsonPath);
$dataArray = json_decode($jsonData, true);

if (!is_array($dataArray) || empty($dataArray)) {
    http_response_code(204);
    echo 'Sem dados para exportar';
    exit;
}

$output = fopen('php://output', 'w');
fwrite($output, "\xEF\xBB\xBF"); // Add BOM

// UTF-8 encode the headers
$headers = array_keys($dataArray[0]);
$utf8Headers = array_map('utf8_encode', $headers);
fputcsv($output, $utf8Headers);

foreach ($dataArray as $item) {
    $utf8Values = [];
    foreach ($item as $value) {
        if (is_string($value)) {
            $utf8Values[] = utf8_decode($value);
        } else {
            $utf8Values[] = $value; // If not a string, just add the value
        }
    }
    fputcsv($output, $utf8Values);
}

fclose($output);
exit;
