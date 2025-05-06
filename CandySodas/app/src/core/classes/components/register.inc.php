<?php
function registerUser() {
    $filePath = '../cached/users.json';
    
    if (!file_exists($filePath)) {
        file_put_contents($filePath, json_encode([]));
    }

    $users = json_decode(file_get_contents($filePath), true);
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $password = $_POST['password'] ?? '';
    $uuid = $_POST['uuid'] ?? '';

    if (empty($name) || empty($email) || empty($mobile) || empty($password)) {
        return [
            'success' => false,
            'message' => "Por favor, preencha todos os campos."
        ];
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return [
                'success' => false,
                'message' => "Este e-mail já está cadastrado. Tente outro."
            ];
        }
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $newUser = [
        "id" => $uuid,
        "email" => $email,
        "password" => $hashedPassword,
        "name" => $name,
        "mobile" => $mobile,
        "createdAt" => date('Y-m-d H:i:s'),
        "usergroup" => "customer",
        // Outros campos...
    ];

    $users[] = $newUser;
    file_put_contents($filePath, json_encode($users, JSON_PRETTY_PRINT));

    return [
        'success' => true,
        'message' => "Usuário registrado com sucesso!"
    ];
}

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = registerUser();
    $message = $result['message'];
    $success = $result['success'];
}
?>

<div class="container form-wrapper">
    <div class="form-container">
        <form action="<?= $CONFIG['CONF']['siteUrl']; ?>/register.html?r=site" method="POST">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome completo" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email de login" required>
            </div>
            <div class="form-group">
                <label for="mobile">Celular</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Digite seu número de celular ou Whatsapp" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                <input type="hidden" id="uuid" name="uuid" value="">
            </div>
            <button type="submit" class="btn btn-primary btn-block">CRIAR CONTA</button>
        </form>

        <?php if (!empty($message)): ?>
            <div class="alert <?= $success ? 'alert-success' : 'alert-danger' ?> mt-3" role="alert">
                <?= $message; ?>
            </div>

            <?php if ($success): ?>
                <script>
                    setTimeout(function() {
                        window.location.href = '<?= $siteUrl;?>/login.html'; // Redireciona para login.html
                    }, 1000);
                </script>
            <?php endif; ?>
        <?php endif; ?>
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

    p.registerUserMessage {
      background: #e3e3e3;
      font-size: 15px;
      color: #999;
      padding: 20px;
      margin: 20px 0 10px;
    }
</style>

<script>
    async function fetchUuid() {
        try {
            const response = await fetch('https://www.uuidgenerator.net/api/version1');
            if (!response.ok) {
                throw new Error('Erro ao buscar UUID');
            }
            const uuid = await response.text();
            document.getElementById('uuid').value = uuid;
        } catch (error) {
            console.error(error);
            alert('Erro ao obter UUID');
        }
    }
    window.onload = fetchUuid;
</script>
