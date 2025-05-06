<?php
include('../../config.inc.php');
global $CONFIG;

session_start();

function getUsersFromJson($filePath) {
    if (!file_exists($filePath)) {
        return [];
    }
    $jsonData = file_get_contents($filePath);
    return json_decode($jsonData, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $users = getUsersFromJson('../../cached/users.json');
    $authenticated = false;

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $email; 
            $authenticated = true;
            break;
        }
    }

    if (!$authenticated) {
        header('Location: '.$CONFIG['CONF']['adminCMS'].'/index.html');
        exit();
    }

    // Verifica o parâmetro de query "r"
    if (isset($_GET['r']) && $_GET['r'] === 'site') {
        header('Location: '.$CONFIG['CONF']['siteUrl'].'/index.html?login=true');
    } else {
        header('Location: '.$CONFIG['CONF']['adminCMS'].'/home.html');
    }
    exit();
}

header('Location: '.$CONFIG['CONF']['adminCMS'].'/index.html');
exit();
