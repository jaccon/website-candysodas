<?php
include('../../config.inc.php');
global $CONFIG;

// Função para atualizar o arquivo JSON com o novo status
function update_order_status($order_id, $new_status) {
    $file_path = $CONFIG['CONF']['cacheDir'].'/orders.json';

    // Lê o conteúdo do arquivo JSON
    $orders = json_decode(file_get_contents($file_path), true);

    // Encontra a ordem e atualiza o status
    foreach ($orders as &$order) {
        if ($order['order'] === $order_id) {
            $order['status'] = $new_status;
            break;
        }
    }

    // Escreve o conteúdo de volta para o arquivo JSON
    file_put_contents($file_path, json_encode($orders, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $notification = json_decode($json, true);

    if ($notification['type'] === 'payment') {
        $payment_id = $notification['data']['id'];
        $access_token = 'SEU_ACCESS_TOKEN';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/v1/payments/$payment_id?access_token=$access_token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $payment_info = curl_exec($ch);
        curl_close($ch);

        $payment = json_decode($payment_info, true);

        $order_id = $payment['external_reference']; // Supondo que o campo `external_reference` é o ID da ordem

        // Atualiza o status da ordem conforme o status do pagamento
        switch ($payment['status']) {
            case 'approved':
                update_order_status($order_id, 'paid');
                break;
            case 'pending':
                update_order_status($order_id, 'pending payment');
                break;
            case 'in_process':
                update_order_status($order_id, 'in process');
                break;
            case 'rejected':
                update_order_status($order_id, 'payment rejected');
                break;
            case 'cancelled':
                update_order_status($order_id, 'payment cancelled');
                break;
            case 'refunded':
                update_order_status($order_id, 'payment refunded');
                break;
            case 'in_mediation':
                update_order_status($order_id, 'payment in mediation');
                break;
            default:
                update_order_status($order_id, 'unknown status');
                break;
        }
    }
}
?>
