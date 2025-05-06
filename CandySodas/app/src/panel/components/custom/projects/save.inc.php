<?php 

function saveProjectData($data) {
  global $CONFIG;
  
  $filePath = $CONFIG['CONF']['cacheDir'].'/projects.json';

  try {
      if (file_exists($filePath)) {
          $jsonData = file_get_contents($filePath);
          $projects = json_decode($jsonData, true);
      } else {
          $projects = [];
      }

      $projects[] = $data;

      file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
      return true;
  } catch (Exception $e) {
      echo "Erro ao salvar dados: " . $e->getMessage();
      return false;
  }
}