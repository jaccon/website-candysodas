<?php

class Uploads {

    static public function handleFileUploadAvatar($fileKey, $baseUploadDir, $allowedExtensions = ['png', 'jpg', 'jpeg']) {
          if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
              $fileTmpPath = $_FILES[$fileKey]['tmp_name'];
              $fileExtension = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
      
              if (in_array($fileExtension, $allowedExtensions)) {
                  $currentDateDir = date('Ymd'); // Diretório com a data atual
                  $dateDirPath = $baseUploadDir . '/' . $currentDateDir;
      
                  // Garantir que o diretório existe
                  if (!is_dir($dateDirPath)) {
                      mkdir($dateDirPath, 0777, true);
                  }
      
                  $uuid = uniqid('', true);
                  $newFileName = $uuid . '.' . $fileExtension;
                  $destPath = $dateDirPath . '/' . $newFileName;
      
                  if (move_uploaded_file($fileTmpPath, $destPath)) {
                      return str_replace($baseUploadDir . '/', '', $destPath); // Retorna o caminho relativo
                  }
              }
          }
          return null;
    }

    static public function handleMetadataFiles() {
        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';
    
        if (!file_exists($filePath)) {
            return ['error' => 'O arquivo metadata.json não foi encontrado.'];
        }
    
        $jsonData = file_get_contents($filePath);
        $files = json_decode($jsonData, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => 'Erro ao processar o arquivo JSON.'];
        }
    
        if (empty($files)) {
            return ['warning' => 'Nenhum arquivo encontrado.'];
        }
    
        $filteredFiles = array_filter($files, function ($file) {
            return isset($file['metadataType']) && $file['metadataType'] === 'files';
        });
    
        if (empty($filteredFiles)) {
            return ['warning' => 'Nenhum arquivo com metadataType "files" foi encontrado.'];
        }
    
        return ['files' => array_values($filteredFiles)];
    }
    

}

?>