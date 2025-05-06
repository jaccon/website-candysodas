<?php
include('../../config.inc.php');
global $CONFIG;

$id = Security::inputSanitizer($_GET['id']) ?? null;
if (!$id) exit("<p class='text-danger'>ID não especificado.</p>");

$jsonFile = $CONFIG['CONF']['cacheDir'] . '/metadata.json';
if (!file_exists($jsonFile)) exit("<p class='text-danger'>Arquivo de metadados não encontrado.</p>");

$data = json_decode(file_get_contents($jsonFile), true) ?? [];
if (empty($data)) exit("<p class='text-gray-500'>Nenhum dado disponível.</p>");

usort($data, fn($a, $b) => strtotime($b['createdAt']) - strtotime($a['createdAt']));
$filteredData = array_filter($data, fn($item) => isset($item['pubId']) && $item['pubId'] == $id);
if (empty($filteredData)) exit("<p class='text-gray-500'>Nenhum metadado encontrado para este ID.</p>");

foreach ($filteredData as $item):
    $title = htmlspecialchars($item['title'] ?? 'Sem título');
    $description = htmlspecialchars($item['description'] ?? '');
    $metadataType = htmlspecialchars($item['metadataType'] ?? 'Desconhecido');
    $metaId = htmlspecialchars($item['id']);
    $imageUrl = !empty($item['uploadFiles'][0]['originalDirectory']) && !empty($item['uploadFiles'][0]['uploadPath'])
        ? "{$CONFIG['CONF']['uploadUrl']}/{$item['uploadFiles'][0]['originalDirectory']}/{$item['uploadFiles'][0]['uploadPath']}"
        : "assets/media/no-image.png";
?>
    <div class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6 metadata-item" data-id="<?= $metaId; ?>">
        <div class="d-flex flex-stack mb-3">
            <div class="me-3">
                <img src="<?= htmlspecialchars($imageUrl); ?>" class="w-50px ms-n1 me-1" alt="Imagem">                  
                <?= $title; ?>
            </div>
            <div class="m-0">
                <a href="metadata-update.html?mId=<?= $item['id']; ?>&pubId=<?= $item['pubId']; ?>" class="btn btn-sm btn-light btn-active-light-primary edit-btn"> Edit </a>
                <button type="button" class="btn btn-sm btn-light btn-active-light-danger delete-btn" data-id="<?= $metaId; ?>">Delete</button>
            </div>
        </div>
        <div>
            <div class="col-md-12">
                <span class="text-gray-500 fw-bold"> Description: <?= $description; ?>  </span> <br/> 
                <span class="text-gray-500 fw-bold"> Metadata Type: <?= $metadataType; ?> | ID: <?= $item['id']; ?> <br/> Component:   <?= $item['component'] ?? 'null'; ?> </span> 
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $(document).on("click", ".delete-btn", function(event) {
        event.preventDefault();
        let metaId = $(this).data("id");
        Swal.fire({
            title: "Tem certeza?",
            text: "Essa ação não pode ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("/api/metadata-remove-item", { id: metaId }, function(response) {
                    Swal.fire({
                        title: "Deletado!",
                        text: "O metadado foi removido com sucesso.",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => location.reload(), 2000);
                }).fail(xhr => {
                    Swal.fire({
                        title: "Erro!",
                        text: "Falha ao excluir o metadado: " + xhr.responseText,
                        icon: "error"
                    });
                });
            }
        });
    });
});
</script>
