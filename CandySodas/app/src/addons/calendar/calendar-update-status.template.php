<?php
include(__DIR__ . '/../../config.inc.php');
$jsonFilePath = $CONFIG['CONF']['cacheDir'].'/calendar.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura o corpo da requisição
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['id']) && isset($data['status'])) {
        $eventId = $data['id'];
        $status = $data['status'];

        if (file_exists($jsonFilePath)) {
            $jsonData = file_get_contents($jsonFilePath);
            $events = json_decode($jsonData, true);

            if ($events === null) {
                http_response_code(500);
                echo json_encode(['error' => 'Erro ao ler os eventos.']);
                exit;
            }

            // Procurar o evento e atualizar o status
            $eventUpdated = false;
            foreach ($events as &$event) {
                if ($event['id'] === $eventId) {
                    $event['status'] = $status; // Atualiza o status do evento
                    $eventUpdated = true;
                    break;
                }
            }

            if ($eventUpdated) {
                // Salvar o arquivo com os eventos atualizados
                if (file_put_contents($jsonFilePath, json_encode($events, JSON_PRETTY_PRINT))) {
                    echo json_encode(['success' => 'Status atualizado com sucesso.']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Erro ao salvar os eventos atualizados.']);
                }
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Evento não encontrado.']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Arquivo de eventos não encontrado.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID ou Status do evento não fornecido.']);
    }
} else {
    // Método não permitido
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido.']);
}
?>
