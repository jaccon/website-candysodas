<?php
  class helperUsers {

  static public function updateUsersById($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/projects.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo projects.json não encontrado.'];
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

  static public function getUsersById($projectId) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/users.json';

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

  static public function saveUsersData($data) {
    global $CONFIG;
    
    $filePath = $CONFIG['CONF']['cacheDir'].'/users.json';
  
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

  static public function updateUserById($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/users.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo users.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo users.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'User não encontrado.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo user.json.'];
    }

    Auth::logUserAction($projectId, 'update users');
    return ['success' => true, 'message' => 'User atualizado com sucesso.'];

  }

}

?>