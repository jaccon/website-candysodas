<?php
  class helperProjects {

      static public function getDeliveryMessage($deadline) {
        $currentDate = time();
        
        if (!is_numeric($deadline)) {
            $deadline = strtotime($deadline);
        }

        $daysLeft = ($deadline - $currentDate) / (60 * 60 * 24);
        
        if (floor($daysLeft) === 0 && date('Y-m-d', $currentDate) === date('Y-m-d', $deadline)) {
            return 'Entrega hoje';
        }
        return floor($daysLeft) . ' dias';
      }

      static public function getDeliveryLateDays($deadline) {
            $currentDate = time();
            if (!is_numeric($deadline)) {
                $deadline = strtotime($deadline);
            }
            $daysLeft = ($deadline - $currentDate) / (60 * 60 * 24);
            if ($daysLeft < 0) {
                return true;
            }
            if (floor($daysLeft) === 0 && date('Y-m-d', $currentDate) === date('Y-m-d', $deadline)) {
                return 'Entrega hoje';
            }
            return floor($daysLeft) . ' dias';
        }
    

      static public function convertTimestampToDate($timestamp) {
        return date('d/m/Y', $timestamp);
      }

      static public function paginate($data, $page = 1, $perPage = 10) {
        $totalItems = count($data);
        $totalPages = ceil($totalItems / $perPage);
        $start = ($page - 1) * $perPage;
        return [
            'data' => array_slice($data, $start, $perPage),
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $totalItems,
                'per_page' => $perPage,
            ],
        ];
      }

      static public function formatCurrentyToBRL($amount) {
        $amount = trim($amount);
        $amount = is_numeric($amount) ? (float) $amount : null;
    
        if ($amount === null) {
            return "Valor inválido";
        }
        return "R$ " . number_format($amount, 2, ',', '.');
      }

      static public function getProjectById($projectId) {
        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/projects.json';
    
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

      static public function updateProjectById($projectId, $updatedData) {
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

      static public function getSpacesQtd($projectId) {
        global $CONFIG;
        $spacesFile = $CONFIG['CONF']['cacheDir'] . '/spaces.json';
    
        if (!file_exists($spacesFile)) {
            return 0; 
        }
    
        $spaces = json_decode(file_get_contents($spacesFile), true);
        if (!is_array($spaces)) {
            return 0; 
        }
    
        $count = 0;
        foreach ($spaces as $space) {
            if (isset($space['projectId']) && $space['projectId'] === $projectId) {
                $count++;
            }
        }
        return $count;
      }

      static public function getTasksQtd($projectId) {
        global $CONFIG;
        $tasksFile = $CONFIG['CONF']['cacheDir'] . '/space-tasks.json';
    
        if (!file_exists($tasksFile)) {
            return 0; 
        }
    
        $tasks = json_decode(file_get_contents($tasksFile), true);
        if (!is_array($tasks)) {
            return 0; 
        }
    
        $count = 0;
        foreach ($tasks as $task) {
            if (isset($task['projectId']) && $task['projectId'] === $projectId) {
                $count++;
            }
        }
        return $count;
      }

      static public function getProjectProgress($projectId) {
        global $CONFIG;
        $tasksFile = $CONFIG['CONF']['cacheDir'] . '/space-tasks.json';
    
        if (!file_exists($tasksFile)) {
            return 0;
        }
    
        $tasks = json_decode(file_get_contents($tasksFile), true);
        if (!is_array($tasks)) {
            return 0;
        }
    
        $totalTasks = 0;
        $completedTasks = 0;
    
        foreach ($tasks as $task) {
            if (isset($task['projectId'], $task['status']) && $task['projectId'] === $projectId) {
                $totalTasks++;
                if (strtolower(trim($task['status'])) === 'done') {
                    $completedTasks++;
                }
            }
        }
    
        if ($totalTasks === 0) {
            return 0;
        }
    
        return round(($completedTasks / $totalTasks) * 100, 2);
      }

      static public function getPaymentMethod($methodId) {
        $paymentMethods = [
            "1" => "Dinheiro",
            "2" => "PIX",
            "3" => "Cartão de Crédito",
            "4" => "Cartão de Débito",
            "5" => "Transferência Bancária",
            "6" => "Link de Pagamento"
        ];
    
        return $paymentMethods[$methodId] ?? "Método de pagamento desconhecido";
      }

      static public function getStatusProject($methodId) {
        global $CONFIG;

        $paymentMethods = [
            "working" => PRJ_STATUS_01,
            "Cancelled" => PRJ_STATUS_02,
            "Late" => PRJ_STATUS_03,
            "Waiting Aproove" => PRJ_STATUS_04,
            "onhold" => PRJ_STATUS_05,
            "done" => PRJ_STATUS_06
        ];
    
        return $paymentMethods[$methodId] ?? "status desconhecido";
      }

      static public function getPriorityProject($methodId) {
        global $CONFIG;

        $paymentMethods = [
            "high" => PVIEW_FORM_PRIORITY_1,
            "medium" => PVIEW_FORM_PRIORITY_2,
            "low" => PVIEW_FORM_PRIORITY_3,
            "urgent" => PVIEW_FORM_PRIORITY_4,
            "critical" => PVIEW_FORM_PRIORITY_5
        ];
    
        return $paymentMethods[$methodId] ?? "status desconhecido";
      }

  }
?>