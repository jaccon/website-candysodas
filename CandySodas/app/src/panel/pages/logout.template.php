<?php
include('../../config.inc.php');
session_start(); 

$userId = Auth::getUserData($_SESSION['user'], "id");
Auth::logUserAction($userId, 'logout');

$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
header('Location: '.$CONFIG['CONF']['adminCMS'].'/index.html');
exit();
?>
