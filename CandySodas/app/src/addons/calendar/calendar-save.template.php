<?php
include(__DIR__ . '/../../config.inc.php'); 
date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    if (!isset($data['title'], $data['datetime'], $data['message'], $data['eventType'])) {
        echo json_encode(['success' => false, 'message' => 'Campos obrigatórios ausentes']);
        exit;
    }

    $datetime = $data['datetime'];
    $date = null;
    $time = null;

    if (!empty($datetime)) {
        try {
            $dt = new DateTime($datetime);
            $date = $dt->format('Y-m-d');
            $time = $dt->format('H:i');
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Data e hora inválidas']);
            exit;
        }
    }

    $calendarFile = $CONFIG['CONF']['cacheDir'] . '/calendar.json';
    $events = file_exists($calendarFile) ? json_decode(file_get_contents($calendarFile), true) : [];

    $uuid = Cms::generateUUID();
    $userId = Auth::getUserData($_SESSION['user'], "id");

    $events[] = [
        'id' => $uuid,
        'title' => $data['title'],
        'date' => $date,
        'time' => $time,
        'datetime' => $datetime,
        'message' => $data['message'],
        'userId' => $userId,
        'createdAt' => $data['createdAt'],
        'eventType' => $data['eventType'],
        'status' => 'onhold'
    ];

    if (file_put_contents($calendarFile, json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
        echo json_encode(['success' => true, 'message' => 'Evento adicionado com sucesso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar o evento']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
}
?>
