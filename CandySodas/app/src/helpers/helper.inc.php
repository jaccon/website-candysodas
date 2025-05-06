<?php
/**
 * Auto include de arquivos de ajuda (helpers) com base no padrão "*.helper.php".
 */
global $CONFIG;

$helpersDir = $CONFIG['CONF']['siteDir'] . '/helpers';

if (is_dir($helpersDir)) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($helpersDir, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && fnmatch('*.helper.php', $file->getFilename())) {
            include_once $file->getPathname();
        }
    }
} else {
    error_log("Diretório de helpers não encontrado: {$helpersDir}");
}
