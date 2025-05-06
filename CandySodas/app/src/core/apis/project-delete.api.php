<?php
header('Content-Type: application/json');

include('../../config.inc.php');

session_start();

$userId = $customerId = Auth::getUserData($_SESSION['user'], "id");

if(!$userId) {
    echo json_encode([
        'success' => false,
        'message' => 'Você precisa estar logado para acessar esta API.'
    ]);
    http_response_code(403); 
    exit;
} 

if (!isset($_SESSION['user'])) {

    echo $_SESSION['user'];
    exit();
    
    echo json_encode([
        'success' => false,
        'message' => 'Você precisa estar logado para acessar esta API.'
    ]);
    http_response_code(403); // Forbidden
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se o ID foi fornecido
    if (isset($data['id']) && !empty($data['id'])) {
        $itemId = $data['id'];
        
        $projectsFile = '../../cached/projects.json';
        
        // Verifica se o arquivo de projetos existe
        if (file_exists($projectsFile)) {
            $projectsData = json_decode(file_get_contents($projectsFile), true);

            // Busca o índice do projeto com o ID fornecido
            $itemIndex = array_search($itemId, array_column($projectsData, 'id'));

            // Verifica se o projeto foi encontrado
            if ($itemIndex !== false) {
                // Remove o projeto do array
                unset($projectsData[$itemIndex]);
                
                // Reindexa o array e salva de volta no arquivo
                $projectsData = array_values($projectsData);
                
                // Grava os dados atualizados no arquivo
                if (file_put_contents($projectsFile, json_encode($projectsData, JSON_PRETTY_PRINT))) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Registro excluído com sucesso'
                    ]);
                    http_response_code(200); // OK
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Erro ao salvar o arquivo'
                    ]);
                    http_response_code(500); // Internal Server Error
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Registro não encontrado'
                ]);
                http_response_code(404); // Not Found
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Arquivo de projetos não encontrado'
            ]);
            http_response_code(500); // Internal Server Error
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'ID inválido'
        ]);
        http_response_code(400); // Bad Request
    }
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'Método não permitido'
]);
http_response_code(405); // Method Not Allowed
exit;
?>
