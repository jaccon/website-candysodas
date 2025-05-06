<?php
include('../../config.inc.php');
include('../featureflags/featureflags.inc.php');

if (ENABLE_CREATE_ACCOUNT === 0):
    http_response_code(400);
    echo json_encode(['error' => 'create account disabled']);
    exit;
endif;

global $CONFIG;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

function readUsers() {
    $filePath = '../../cached/users.json';
    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        return json_decode($json, true);
    }
    return [];
}

function saveUsers($users) {
    $filePath = '../../cached/users.json';
    $json = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $json);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset($inputData['email']) && isset($inputData['name']) && isset($inputData['password']) && isset($inputData['phone']) && isset($inputData['uuid'])) {
        $email = $inputData['email'];
        $name = $inputData['name'];
        $password = $inputData['password'];
        $phone = $inputData['phone'];
        $uuid = $inputData['uuid'];
        
        if (isset($inputData['confirm_password']) && $inputData['confirm_password'] !== $password) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'As senhas não correspondem.']);
            exit;
        }

        $users = readUsers();

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                http_response_code(400); // Bad Request
                echo json_encode(['error' => 'Email já cadastrado.']);
                exit;
            }
        }

        $newUser = [
            'email' => $email,
            'name' => $name,
            'password' => password_hash($password, PASSWORD_BCRYPT), // Senha criptografada
            'phone' => $phone,
            'id' => $uuid,
            'createdAt' => date('Y-m-d H:i:s')  // Data de criação
        ];

        $users[] = $newUser;

        saveUsers($users);

        http_response_code(200); // OK
        echo json_encode(['message' => 'Usuário cadastrado com sucesso.']);
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Email, nome, senha, telefone e UUID são necessários.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Método não permitido.']);
}
?>
