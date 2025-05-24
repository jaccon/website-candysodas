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

// Cabeçalhos do CSV com base nas chaves do primeiro item
fputcsv($output, array_keys($dataArray[0]));

foreach ($dataArray as $item) {
    fputcsv($output, array_values($item));
}

fclose($output);
exit;
