<?php
include(__DIR__ . '/../../config.inc.php');
$jsonFilePath = $CONFIG['CONF']['cacheDir'].'/calendar.json';

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    if (file_exists($jsonFilePath)) {
        $jsonData = file_get_contents($jsonFilePath);
        $events = json_decode($jsonData, true);

        if ($events === null) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao ler os eventos.']);
            exit;
        }

        $updatedEvents = array_filter($events, function ($event) use ($eventId) {
            return $event['id'] !== $eventId;
        });

        $updatedEvents = array_values($updatedEvents);

        if (file_put_contents($jsonFilePath, json_encode($updatedEvents, JSON_PRETTY_PRINT))) {
            echo json_encode(['success' => 'Evento excluído com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar os eventos atualizados.']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Arquivo de eventos não encontrado.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID do evento não fornecido.']);
}
?>
