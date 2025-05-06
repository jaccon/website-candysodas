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
    $userId = null;

    
    foreach ($users as $user) {
        
        $userLanguage = Auth::getUserData($user['email'], 'language');

        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $email;
            $_SESSION['language'] = $userLanguage;
            $authenticated = true;
            $userId = $user['id']; 
            break;
        }
    }

    if (!$authenticated) {
        header('Location: '.$CONFIG['CONF']['adminCMS'].'/index.html');
        exit();
    }

    if ($userId) {
        Auth::logUserAction($userId, 'login');
    }

    if (isset($_GET['r']) && $_GET['r'] === 'site') {
        header('Location: '.$CONFIG['CONF']['siteUrl'].'/index.html?login=true');
    } else {
        header('Location: '.$CONFIG['CONF']['adminCMS'].'/home.html');
    }
    exit();
}

header('Location: '.$CONFIG['CONF']['adminCMS'].'/index.html');
exit();
?>
