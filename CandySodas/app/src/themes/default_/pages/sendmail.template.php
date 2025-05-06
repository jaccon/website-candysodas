<?php
// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega todos os dados enviados no formulário
    $fields = $_POST;

    // Verifica se o campo 'email' foi enviado
    if (empty($fields['email'])) {
        die("E-mail não fornecido!");
    }

    // SMTP configurações
    $smtp_host = 'email-smtp.us-east-1.amazonaws.com';
    $smtp_port = 465; // Porta 465 para conexão direta SSL/TLS
    $smtp_user = 'AKIAS55DMGJ6HD6TW2ED';  // Sua chave de acesso
    $smtp_pass = 'BN1SHrd0N1rPjQpEDGU76z0Zynol/gS3KDbrVfXzPBGv';  // Sua chave secreta
    $from = 'io@pagefai.com';  // E-mail de envio
    $to = 'marketing@dealershop.com.br';  // E-mail de destino, vindo do campo do formulário
    $subject = 'E-mail website DealerShop';  // Assunto do e-mail

    // Construir o corpo da mensagem HTML com os campos dinamicamente
    $html_message = '
    <html>
    <head>
        <title>E-mail website DealerShop</title>
    </head>
    <body>
        <h1>E-mail Formulário website DealerShop powered by Pagefai</h1>';

    // Iterar sobre todos os campos e adicionar ao corpo do e-mail
    foreach ($fields as $key => $value) {
        $html_message .= "<p><strong>" . htmlspecialchars(ucfirst($key)) . ":</strong> " . nl2br(htmlspecialchars($value)) . "</p>";
    }

    $html_message .= '
    </body>
    </html>
    ';

    // Criar a conexão com o servidor SMTP
    $socket = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 60);  // Aumentei o tempo de espera para 60 segundos

    if (!$socket) {
        die("Erro na conexão: $errstr ($errno)");
    }

    // Habilitar a criptografia SSL/TLS
    if (stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT) === false) {
        die('Falha ao habilitar a criptografia SSL/TLS.');
    }

    // Ler a saudação do servidor
    $response = fgets($socket, 515);
    echo "Saudação do servidor: $response";

    // Enviar o comando HELO
    fputs($socket, "EHLO " . $smtp_host . "\r\n");
    $response = fgets($socket, 515);
    echo "Resposta do EHLO: $response";

    // Enviar autenticação AUTH LOGIN
    fputs($socket, "AUTH LOGIN\r\n");
    $response = fgets($socket, 515);
    echo "Resposta AUTH LOGIN: $response";

    // Enviar nome de usuário (codificado em base64)
    fputs($socket, base64_encode($smtp_user) . "\r\n");
    $response = fgets($socket, 515);
    echo "Resposta do usuário: $response";

    // Enviar senha (codificada em base64)
    fputs($socket, base64_encode($smtp_pass) . "\r\n");
    $response = fgets($socket, 515);
    echo "Resposta da senha: $response";

    // Definir o remetente
    fputs($socket, "MAIL FROM:<$from>\r\n");
    $response = fgets($socket, 515);
    echo "Resposta MAIL FROM: $response";

    // Definir o destinatário
    fputs($socket, "RCPT TO:<$to>\r\n");
    $response = fgets($socket, 515);
    echo "Resposta RCPT TO: $response";

    // Iniciar o envio dos dados do e-mail
    fputs($socket, "DATA\r\n");
    $response = fgets($socket, 515);
    echo "Resposta DATA: $response";

    // Construir o cabeçalho do e-mail com suporte para HTML
    $headers = "From: $from\r\n";
    $headers .= "To: $to\r\n";
    $headers .= "Subject: $subject\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";  // Alterado para 'text/html'
    $headers .= "\r\n";

    // Enviar os dados do e-mail (conteúdo HTML)
    fputs($socket, $headers . $html_message . "\r\n.\r\n");
    $response = fgets($socket, 515);
    echo "Resposta após enviar o e-mail: $response";

    // Fechar a conexão
    fputs($socket, "QUIT\r\n");
    fclose($socket);

    echo "E-mail HTML enviado com sucesso!";
} else {
    // Caso a requisição não seja POST
    echo "Por favor, envie um POST para enviar o e-mail.";
}
?>
