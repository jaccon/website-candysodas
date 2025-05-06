<?php 

header('Content-Type: application/json');
include('../../config.inc.php');

global $CONFIG;
session_start();
Auth::loginSession();

$currentPasswordHash = Auth::getUserData($_SESSION['user'], "password");
$userId = Auth::getUserData($_SESSION['user'], "id");

$requestData = json_decode(file_get_contents('php://input'), true);
$formCurrentPassword = Security::inputSanitizer($requestData['currentPassword']) ?? null;
$newPassword = Security::inputSanitizer($requestData['password']) ?? null;
$confirmPassword = $requestData['passwordConfirm'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$formCurrentPassword || !$newPassword ) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Preencha todos os campos.']);
        exit();
    }

    if (!password_verify($formCurrentPassword, $currentPasswordHash)) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Senha atual incorreta.']);
        exit();
    }

    $dataToSave = [
        'id' => $userId,
        'password' => password_hash($newPassword, PASSWORD_BCRYPT),
        'updateAt' => date('Y-m-d H:i:s')
    ];

    if (helperUsers::updateUserById($userId, $dataToSave)) {
        echo json_encode(['success' => true, 'message' => 'Senha atualizada com sucesso!']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar usuário.']);
    }
    exit();
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
exit();
?>
