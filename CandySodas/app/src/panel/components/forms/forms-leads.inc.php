<?php 
global $CONFIG;

$jsonFilePath = $CONFIG['CONF']['cacheDir'] . '/forms-submit-data.json';
$formId = $_GET['id'] ?? null;
$datas = [];

if (file_exists($jsonFilePath)) {
    $alldatas = json_decode(file_get_contents($jsonFilePath), true);

    if (is_array($alldatas)) {
        foreach ($alldatas as $data) {
            if (($formId === null || $data['formId'] === $formId)) {
                $datas[] = $data;
            }
        }

        if (!empty($datas)) {
            usort($datas, fn($a, $b) => strtotime($b['createdAt']) - strtotime($a['createdAt']));
        }
    }
}

$page = $_GET['page'] ?? 1;
$paginatedData = helperProjects::paginate($datas, $page, 10);

?>

<div class="col-xl-12">
    <div class="card card-flush h-md-100">
        <div class="card-body pt-6">
            <div class="table-responsive">
                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="p-0 pb-3 min-w-175px text-start">Lead Name</th>
                            <th class="p-0 pb-3 min-w-175px text-start">E-mail</th>
                            <th class="p-0 pb-3 min-w-175px text-start">Phone</th>
                            <th class="p-0 pb-3 min-w-175px text-start">Message</th>
                            <th class="p-0 pb-3 min-w-100px text-end">Created At</th>
                            <th class="p-0 pb-3 w-125px text-end pe-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($paginatedData['data'])): ?>
                            <?php foreach ($paginatedData['data'] as $item): ?>
                                <tr id="row-<?= $item['formId']; ?>">
                                    <td>
                                        <?= htmlspecialchars($item['name'] ?? 'N/A'); ?><br/>
                                        <span class='text-gray-500'> <?= htmlspecialchars($item['id'] ?? 'N/A'); ?> </span>
                                    </td>
                                    <td><?= htmlspecialchars($item['email'] ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($item['phone'] ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($item['message'] ?? 'N/A'); ?></td>
                                    <td class="text-end pe-0"><?= Admin::convertIsoDate($item['createdAt']); ?></td>
                                    <td class="text-end pe-0">
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $item['id']; ?>')">Remove Lead</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center">Nenhum registro encontrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <ul class="pagination pagination-circle pagination-outline">
                    <li class="page-item previous <?= $paginatedData['pagination']['current_page'] === 1 ? 'disabled' : '' ?> m-1">
                        <a href="<?= $paginatedData['pagination']['current_page'] > 1 ? '?page=' . ($paginatedData['pagination']['current_page'] - 1) : '#' ?>" class="page-link"><i class="previous"></i></a>
                    </li>
                    <?php for ($i = 1; $i <= $paginatedData['pagination']['total_pages']; $i++): ?>
                        <li class="page-item m-1 <?= $i === $paginatedData['pagination']['current_page'] ? 'active' : '' ?>">
                            <a href="?page=<?= $i ?>" class="page-link"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item next <?= $paginatedData['pagination']['current_page'] === $paginatedData['pagination']['total_pages'] ? 'disabled' : '' ?> m-1">
                        <a href="<?= $paginatedData['pagination']['current_page'] < $paginatedData['pagination']['total_pages'] ? '?page=' . ($paginatedData['pagination']['current_page'] + 1) : '#' ?>" class="page-link"><i class="next"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(formId) {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter essa ação!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formData = new FormData();
            formData.append('id', formId);  // Alterando 'formId' para 'id'

            fetch('/api/leads-remove', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Removido!', data.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Erro!', data.message, 'error');
                }
            })
            .catch(() => Swal.fire('Erro!', 'Ocorreu um erro ao tentar remover o lead.', 'error'));
        }
    });
}
</script>
