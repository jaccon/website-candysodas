<?php
  class helperSpaces {
  
    static public function getSpaceList($projectId) {
      global $CONFIG;
  
      $filePath = $CONFIG['CONF']['cacheDir'] . '/spaces.json';
  
      if (!file_exists($filePath)) {
          return null; 
      }
  
      $jsonData = file_get_contents($filePath);
  
      $spaces = json_decode($jsonData, true);
  
      if (!is_array($spaces)) {
          return null; 
      }
  
      $filteredSpaces = [];
  
      foreach ($spaces as $space) {
          if ($space['projectId'] === $projectId) {
              $filteredSpaces[] = $space;
          }
      }
  
      usort($filteredSpaces, function($a, $b) {
          $dateA = strtotime($a['created_at']);
          $dateB = strtotime($b['created_at']);
          return $dateB - $dateA; 
      });
  
      return !empty($filteredSpaces) ? $filteredSpaces : null;
    }

    static public function getSpaceById($spaceId, $field = null) {
        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/spaces.json';
    
        if (!file_exists($filePath)) {
            return null; 
        }
    
        $jsonData = file_get_contents($filePath);
    
        $spaces = json_decode($jsonData, true);
    
        if (!is_array($spaces)) {
            return null; 
        }
    
        // Procurar o espaço correspondente ao spaceId
        foreach ($spaces as $space) {
            if (isset($space['uuid']) && $space['uuid'] === $spaceId) {
                // Retornar o valor do campo específico, se fornecido
                if ($field !== null) {
                    return $space[$field] ?? null;
                }
                // Retornar o espaço completo, se nenhum campo for especificado
                return $space;
            }
        }
    
        return null; // Retornar null se nenhum espaço for encontrado
    }

    static public function getTaskById($taskId, $field = null) {
        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/space-tasks.json';
    
        if (!file_exists($filePath)) {
            return null; 
        }
    
        $jsonData = file_get_contents($filePath);
        $spaces = json_decode($jsonData, true);
    
        if (!is_array($spaces)) {
            return null; 
        }
    
        foreach ($spaces as $space) {
            if (isset($space['id']) && $space['id'] === $taskId) {
                if ($field !== null) {
                    return $space[$field] ?? null;
                }
                return $space;
            }
        }
    
        return null;
    }

    static public function getSpaceTasks($projectId) {
      global $CONFIG;
  
      $filePath = $CONFIG['CONF']['cacheDir'] . '/space-tasks.json';
  
      if (!file_exists($filePath)) {
          return null; 
      }
  
      $jsonData = file_get_contents($filePath);
  
      $tasks = json_decode($jsonData, true);
  
      if (!is_array($tasks)) {
          return null; 
      }
  
      $filteredSpaces = [];
  
      foreach ($tasks as $task) {
          if ($task['projectId'] === $projectId) {
              $filteredSpaces[] = $task;
          }
      }
  
      usort($filteredSpaces, function($a, $b) {
          $dateA = strtotime($a['created_at']);
          $dateB = strtotime($b['created_at']);
          return $dateB - $dateA; 
      });
  
      return !empty($filteredSpaces) ? $filteredSpaces : null;
    }

    static public function getSpaceTasksById($spaceId) {
      global $CONFIG;
  
      $filePath = $CONFIG['CONF']['cacheDir'] . '/space-tasks.json';
  
      if (!file_exists($filePath)) {
          return null; 
      }
  
      $jsonData = file_get_contents($filePath);
  
      $tasks = json_decode($jsonData, true);
  
      if (!is_array($tasks)) {
          return null; 
      }
  
      $filteredSpaces = [];
  
      foreach ($tasks as $task) {
          if ($task['spaceId'] === $spaceId) {
              $filteredSpaces[] = $task;
          }
      }
  
      usort($filteredSpaces, function($a, $b) {
          $dateA = strtotime($a['created_at']);
          $dateB = strtotime($b['created_at']);
          return $dateB - $dateA; 
      });
  
      return !empty($filteredSpaces) ? $filteredSpaces : null;
    }

    static public function getSpaceName($spaceId) {
      global $CONFIG;
  
      $filePath = $CONFIG['CONF']['cacheDir'] . '/spaces.json';
  
      if (!file_exists($filePath)) {
          return null; 
      }
  
      $jsonData = file_get_contents($filePath);
  
      $spaces = json_decode($jsonData, true);
  
      if (!is_array($spaces)) {
          return null; 
      }
  
      foreach ($spaces as $space) {
          if ($space['uuid'] === $spaceId) {
              return $space['name'];
          }
      }
  
      return null;
    }

    static public function getCountTasksBySpaceId($spaceId) {
        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/space-tasks.json';
    
        if (!file_exists($filePath)) {
            return 0;
        }
    
        $jsonData = file_get_contents($filePath);
    
        $tasks = json_decode($jsonData, true);
    
        if (!is_array($tasks)) {
            return 0;
        }
    
        $taskCount = 0;
    
        foreach ($tasks as $task) {
            if (isset($task['spaceId']) && $task['spaceId'] === $spaceId) {
                $taskCount++;
            }
        }
    
        return $taskCount;
    }
    
  

  }

?>