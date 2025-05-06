<?php
  class helperSpacesUpdate {
  
    static public function updateSpaceById($id, $updatedData) {
        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/spaces.json';
        if (!file_exists($filePath)) return ['success' => false, 'message' => 'Arquivo spaces.json não encontrado.'];
    
        $spaces = json_decode(file_get_contents($filePath), true);
        if (!is_array($spaces)) return ['success' => false, 'message' => 'Erro ao ler o arquivo spaces.json.'];
    
        $spaceIndex = array_search($id, array_column($spaces, 'uuid'));
        if ($spaceIndex === false) return ['success' => false, 'message' => 'Dado não encontrado.'];
    
        $spaces[$spaceIndex] = array_merge($spaces[$spaceIndex], $updatedData);
    
        if (file_put_contents($filePath, json_encode($spaces, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) === false) {
            return ['success' => false, 'message' => 'Erro ao salvar o arquivo spaces.json.'];
        }
    
        Auth::logUserAction($id, 'update space');
        return ['success' => true, 'message' => 'Dado atualizado com sucesso.'];
    }

    static public function updateTaskById($id, $updatedData) {
        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/space-tasks.json';
        if (!file_exists($filePath)) return ['success' => false, 'message' => 'Arquivo space-tasks.json não encontrado.'];
    
        $spaces = json_decode(file_get_contents($filePath), true);
        if (!is_array($spaces)) return ['success' => false, 'message' => 'Erro ao ler o arquivo space-tasks.json.'];
    
        $spaceIndex = array_search($id, array_column($spaces, 'id'));
        if ($spaceIndex === false) return ['success' => false, 'message' => 'Dado não encontrado.'];
    
        $spaces[$spaceIndex] = array_merge($spaces[$spaceIndex], $updatedData);
    
        if (file_put_contents($filePath, json_encode($spaces, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) === false) {
            return ['success' => false, 'message' => 'Erro ao salvar o arquivo spaces.json.'];
        }
    
        Auth::logUserAction($id, 'update task');
        return ['success' => true, 'message' => 'Dado atualizado com sucesso.'];
    }
    
    

  }

?>