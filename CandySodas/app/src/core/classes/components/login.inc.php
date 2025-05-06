<?php
session_start();
ob_start(); // Inicia o buffer de saída

function login($email, $password) {
    global $CONFIG;

    $file = $CONFIG['CONF']['cacheDir'] . "/users.json";

    if (!file_exists($file)) {
        return false;
    }

    $data = file_get_contents($file);
    $users = json_decode($data, true);

    if ($users === null) {
        return false;
    }

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'email' => $user['email'],
                'name' => $user['name'] ?? null
            ];
            return true;
        }
    }

    return false;
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!login($email, $password)) {
        $error_message = "Email ou senha incorretos.";
    } else {
        // header("Location: {$CONFIG['CONF']['siteUrl']}/home.html?login=true");
        // exit();
    }
}
?>

<div class="container form-wrapper">
    <div class="form-container">
        <form action="<?= $CONFIG['CONF']['adminCMS']; ?>/login.html?r=site" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email de login" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">ENTRAR</button>
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= $error_message; ?>
                </div>
            <?php endif; ?>
        </form>
        <p> 
            <br/>
            <a href="<?= $siteUrl; ?>/register.html" class="mt-4"> Criar nova conta </a>
        </p>
    </div>
</div>

<style>
    .form-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .form-container {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 37px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.714;
        background-color: #fff;
        color: #000;
    }
</style>
