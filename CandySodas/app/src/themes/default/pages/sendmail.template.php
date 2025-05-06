<?php
include('../../../config.inc.php');
global $CONFIG;

$enableLog = true;

function logMsg($msg) {
    global $enableLog;
    if ($enableLog) {
        $logFile = __DIR__ . '/sendmail.log';
        file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] $msg\n", FILE_APPEND);
        error_log("[sendmail] $msg");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = $_POST;

    if (empty($fields['email'])) {
        logMsg("E-mail não fornecido!");
        die("E-mail não fornecido!");
    }

    $formId = Security::inputSanitizer($_POST['id']);
    $subject = Forms::isForm($formId, 'subject');
    $replyToEmail = Forms::isForm($formId, 'replyTo');
    $replyToName = Forms::isForm($formId, 'replyToName');
    $to = Security::inputSanitizer($_POST['email']);
    $message = Forms::isForm($formId, 'message');

    logMsg("Campos recebidos: " . print_r($fields, true));

    if (!isset($fields['name'])) {
        logMsg("Atenção: O campo 'name' não foi enviado no formulário!");
    }

    foreach ($fields as $key => $value) {
        $message = str_replace(
            ["{{ " . trim($key) . " }}", "{{" . trim($key) . "}}"],
            htmlspecialchars(trim($value)),
            $message
        );
    }

    logMsg("Mensagem final após substituição: " . $message);

    $smtp_host = $CONFIG['CONF']['SMTP_HOST']; 
    $smtp_port = $CONFIG['CONF']['SMTP_PORT']; 
    $smtp_user = $CONFIG['CONF']['SMTP_USER']; 
    $smtp_pass = $CONFIG['CONF']['SMTP_PASS']; 
    $from = $CONFIG['CONF']['FROM_EMAIL'];

    $html_message = "
    <html>
    <head>
        <title>$subject</title>
    </head>
    <body>
        <p>$message</p>";

    foreach ($fields as $key => $value) {
        $html_message .= "<p><strong>" . htmlspecialchars(ucfirst($key)) . ":</strong> " . nl2br(htmlspecialchars($value)) . "</p>";
    }

    $html_message .= "
    </body>
    </html>";

    $html_replyTo = "<html><head><title>Dados do contato</title></head><body><h3>Dados do contato:</h3>";
    foreach ($fields as $key => $value) {
        $html_replyTo .= "<p><strong>" . htmlspecialchars(ucfirst($key)) . ":</strong> " . nl2br(htmlspecialchars($value)) . "</p>";
    }
    $html_replyTo .= "</body></html>";

    function sendEmail($to, $subject, $message, $from, $smtp_host, $smtp_port, $smtp_user, $smtp_pass) {
        global $enableLog;
        $socket = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 60);

        if (!$socket) {
            logMsg("Erro na conexão: $errstr ($errno)");
            die("Erro na conexão: $errstr ($errno)");
        }

        if (stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT) === false) {
            logMsg("Falha ao habilitar a criptografia SSL/TLS.");
            die('Falha ao habilitar a criptografia SSL/TLS.');
        }

        fgets($socket, 515);
        fputs($socket, "EHLO " . $smtp_host . "\r\n");
        fgets($socket, 515);
        fputs($socket, "AUTH LOGIN\r\n");
        fgets($socket, 515);
        fputs($socket, base64_encode($smtp_user) . "\r\n");
        fgets($socket, 515);
        fputs($socket, base64_encode($smtp_pass) . "\r\n");
        fgets($socket, 515);

        fputs($socket, "MAIL FROM:<$from>\r\n");
        fgets($socket, 515);
        fputs($socket, "RCPT TO:<$to>\r\n");
        fgets($socket, 515);

        fputs($socket, "DATA\r\n");
        fgets($socket, 515);

        $headers = "From: $from\r\n";
        $headers .= "To: $to\r\n";
        $headers .= "Subject: $subject\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "\r\n";

        fputs($socket, $headers . $message . "\r\n.\r\n");
        $response = fgets($socket, 515);

        logMsg("Resposta do servidor: " . trim($response));

        fputs($socket, "QUIT\r\n");
        fclose($socket);

        return strpos($response, '250') !== false;
    }

    logMsg("Enviando e-mail principal...");
    $emailEnviado = sendEmail($to, $subject, $html_message, $from, $smtp_host, $smtp_port, $smtp_user, $smtp_pass);

    logMsg("Enviando cópia para o replyTo...");
    $copiaEnviada = sendEmail($replyToEmail, "New Lead - Form: " . $subject , $html_replyTo, $from, $smtp_host, $smtp_port, $smtp_user, $smtp_pass);

    if ($emailEnviado && $copiaEnviada) {
        Forms::saveLead($fields, $fields['email']);
        logMsg("E-mail enviado e salvo com sucesso!");
        echo "E-mail enviado e salvo com sucesso!";
    } else {
        logMsg("Falha ao enviar o e-mail.");
        echo "Falha ao enviar o e-mail.";
    }
} else {
    logMsg("Método de requisição inválido.");
    echo "Por favor, envie um POST para enviar o e-mail.";
}
?>
