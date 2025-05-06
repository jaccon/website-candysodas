<?php 
include(__DIR__ . '/../../config.inc.php');
date_default_timezone_set('America/Sao_Paulo');

// Recupera o ID do usuário autenticado
$userId = Auth::getUserData($_SESSION['user'], "id");

// Caminho para o arquivo de cache com os eventos
$jsonFilePath = $CONFIG['CONF']['cacheDir'].'/calendar.json';
$allEvents = [];
$datas = [];

// Verifica se o arquivo de eventos existe
if (file_exists($jsonFilePath)) {
    $allEvents = json_decode(file_get_contents($jsonFilePath), true);
    
    // Recupera o parâmetro "date" da URL (caso exista)
    $filterDate = isset($_GET['date']) ? $_GET['date'] : null;

    // Filtra os eventos baseados no ID do usuário
    $datas = array_filter($allEvents, function($event) use ($userId, $filterDate) {
        if (!isset($event['userId'], $event['datetime']) || $event['userId'] !== $userId) {
            return false;
        }

        $datetime = $event['datetime'];
        if (empty($datetime) || $datetime === 'T') return false;

        try {
            $timezone = new DateTimeZone('America/Sao_Paulo');
            $eventDate = new DateTime($datetime, $timezone);
            
            // Se houver um filtro de data, filtra os eventos pela data
            if ($filterDate) {
                // Compara a data do evento com a data fornecida no filtro (formato YYYY-MM-DD)
                $filterDateFormatted = DateTime::createFromFormat('Y-m-d', $filterDate);
                if ($eventDate->format('Y-m-d') !== $filterDateFormatted->format('Y-m-d')) {
                    return false;
                }
            } else {
                // Caso contrário, filtra apenas para eventos de hoje
                $today = new DateTime('now', $timezone);
                if ($eventDate->format('Y-m-d') !== $today->format('Y-m-d')) {
                    return false;
                }
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    });

    // Ordena os eventos por data e hora de forma decrescente
    usort($datas, function($a, $b) {
        $datetimeA = new DateTime($a['datetime']);
        $datetimeB = new DateTime($b['datetime']);
        return $datetimeB <=> $datetimeA;
    });
}
?>

<div class="col-lg-12 col-xl-12 col-xxl-12 mb-10 mb-xl-0">
  <div class="card-body pt-7 px-0">
    <div id="eventos-do-dia" class="mb-2 px-9">
      <?php if (empty($datas)): ?>
        <?= "Filtrando dia: ". (new DateTime($filterDate))->format('d/m/Y'); ?>
        <p class="text-gray-500"><br/> Nenhum evento agendado para o dia selecionado.</p>
      <?php else: ?>
        <?= "Filtrando dia: ". (new DateTime($filterDate))->format('d/m/Y'); ?>
        <?php foreach ($datas as $event): 
            try {
                $timezone = new DateTimeZone('America/Sao_Paulo');
                $datetime = new DateTime($event['datetime'], $timezone);
                $dateTimeFormatted = $datetime->format('d/m/Y H:i');
            } catch (Exception $e) {
                $dateTimeFormatted = 'Data inválida';
            }

            $title = htmlspecialchars($event['title'] ?? 'Sem título');
            $message = htmlspecialchars($event['message'] ?? '');
            $status = ucfirst($event['status'] ?? 'pendente');
        ?>
        <br/>
        <br/>
        <div class="d-flex align-items-center mb-6">
          <span class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
          <input 
            type="checkbox" 
            class="form-check-input me-3" 
            id="event-<?= $event['id'] ?>" 
            data-id="<?= $event['id'] ?>" 
            <?= $event['status'] === 'done' ? 'checked' : '' ?> />

          <div class="flex-grow-1 me-5">
            <div class="fw-semibold fs-6"><?= $dateTimeFormatted ?></div>
            <div class="text-gray-700 fw-semibold fs-5"><?= $title ?></div>
            <div class="text-gray-600 fs-5"><?= $message ?></div>
            <div class="text-gray-500 fw-semibold fs-7">Status: <?= $status ?></div>
          </div>

          <button 
            class="btn btn-sm btn-danger delete-btn" 
            data-id="<?= $event['id'] ?>">
            Excluir
          </button>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
