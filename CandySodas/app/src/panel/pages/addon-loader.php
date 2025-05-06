<?php
require_once '../../config.inc.php';

$addon = $_GET['addon'] ?? '';
$addon = preg_replace('/[^a-zA-Z0-9_-]/', '', $addon); // sanitiza

$templatePath = __DIR__ . "/../../addons/{$addon}/{$addon}.template.php";

if (file_exists($templatePath)) {
    include_once "../../themes/default/header.php"; // ou o cabeçalho do painel
    include_once $templatePath;
    include_once "../../themes/default/footer.php"; // ou o rodapé do painel
} else {
    http_response_code(404);
    echo "<h1>404 - Addon template '{$addon}' não encontrado.</h1>";
}
