<?php
  class helperForms {

    static public function saveForm($data) {
      global $CONFIG;
      
      $filePath = $CONFIG['CONF']['cacheDir'].'/forms.json';
    
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

    static public function getFormById($projectId) {
      global $CONFIG;
  
      $filePath = $CONFIG['CONF']['cacheDir'] . '/forms.json';
  
      if (!file_exists($filePath)) {
          return null; 
      }
  
      $jsonData = file_get_contents($filePath);
  
      $projects = json_decode($jsonData, true);
  
      if (!is_array($projects)) {
          return null; 
      }
  
      foreach ($projects as $project) {
          if ($project['id'] === $projectId) {
              return $project;
          }
      }
  
      return null; 
    }

    static public function updateFormById($projectId, $updatedData) {
      global $CONFIG;
  
      $filePath = $CONFIG['CONF']['cacheDir'] . '/forms.json';
  
      if (!file_exists($filePath)) {
          return ['success' => false, 'message' => 'Arquivo forms.json não encontrado.'];
      }
  
      $jsonData = file_get_contents($filePath);
  
      $projects = json_decode($jsonData, true);
  
      if (!is_array($projects)) {
          return ['success' => false, 'message' => 'Erro ao ler o arquivo projects.json.'];
      }
  
      $projectIndex = array_search($projectId, array_column($projects, 'id'));
  
      if ($projectIndex === false) {
          return ['success' => false, 'message' => 'Projeto não encontrado.'];
      }
  
      $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);
  
      if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
          return ['success' => false, 'message' => 'Erro ao salvar o arquivo projects.json.'];
      }
  
      return ['success' => true, 'message' => 'Projeto atualizado com sucesso.'];
    }

    public static function countLeadsByFormId($formId) {
        global $CONFIG;
        $path = $CONFIG['CONF']['cacheDir'] . '/forms-submit-data.json';
    
        if (!file_exists($path)) return 0;
    
        $data = json_decode(file_get_contents($path), true);
    
        if (!is_array($data)) return 0;
    
        return array_reduce($data, function ($count, $lead) use ($formId) {
            return $count + (isset($lead['submittedData']['fields']['formId']) && $lead['submittedData']['fields']['formId'] === $formId);
        }, 0);
    }

  }
