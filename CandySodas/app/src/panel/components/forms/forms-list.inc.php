<?php 
global $CONFIG;

$jsonFilePath = $CONFIG['CONF']['cacheDir'].'/forms.json';
$datas = [];

if (file_exists($jsonFilePath)) {
    $alldatas = json_decode(file_get_contents($jsonFilePath), true);

    if (is_array($alldatas)) {
        foreach ($alldatas as $data) {
            if ($usergroup === 'admin' || $data['customerId'] === $customerId) {
                $datas[] = $data;
            }
        }

        if (!empty($datas)) {
            usort($datas, function ($a, $b) {
                return strtotime($b['createdAt']) - strtotime($a['createdAt']);
            });
        }
    }
}

$projectsFile = '../../cached/forms.json';
$projectsData = file_exists($projectsFile) ? json_decode(file_get_contents($projectsFile), true) : [];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$paginatedData = helperProjects::paginate($datas, $page, 10);
?>

<div class="col-xl-12">
    <div class="card card-flush h-md-100">
      <div class="card-body pt-6">
          <div class="table-responsive">

            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                <thead>
                  <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                      <th class="p-0 pb-3 text-start"> Campaign </th>
                      <th class="p-0 pb-3 text-end"> Created At </th>
                      <th class="p-0 pb-3 text-end"> Reply To </th>
                      <th class="p-0 pb-3 text-end"> Status </th>
                      <th class="p-0 pb-3 text-end"> Leads total </th>
                      <th class="p-0 pb-3 text-end pe-7"> Export </th>
                  </tr>
                </thead>

                <tbody>
                      <?php if (!empty($paginatedData['data'])): ?>
                          <?php foreach ($paginatedData['data'] as $item): ?>
                          <tr>
                              <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                      <a href="forms-update.html?id=<?= $item['id']; ?>" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                        <?= htmlspecialchars($item['campaign']); ?> 
                                      </a>
                                      <span class="text-gray-500 fw-semibold d-block fs-7">
                                        <small> <?= $item['id']; ?> </small>
                                      </span>
                                    </div>
                                </div>
                              </td>
                              <td class="text-end pe-0">
                                <span class="text-gray-600 fw-bold fs-6">
                                  <?= Admin::formatDateTime($item['createdAt']); ?>
                                  
                                </span>                                
                              </td>

                              <td class="text-end pe-0">
                                <?= $item['replyTo']; ?>
                              </td>

                              <td class="text-end pe-0">
                                <?= $item['status']; ?>
                              </td>

                              <td class="text-end pe-2">
                                <?= helperForms::countLeadsByFormId($item['id']);?>
                              </td>

                              <td class="text-end pe-0">

                                <a 
                                  href="forms-leads.html?id=<?= $item['id']; ?>" 
                                  alt="View details" 
                                  title="View details" 
                                  class="btn btn-primary btn-sm"> 
                                   View Leads
                                </a>

                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $item['id']; ?>')">
                                    Remove
                                </button>

                              </td>
                          </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center"> <?= PRJ_STR_01; ?></td>
                            </tr>
                        <?php endif; ?>
                      
                    </tbody>
                  
                  </table>

                  <ul class="pagination pagination-circle pagination-outline">
                      <li class="page-item previous <?= $paginatedData['pagination']['current_page'] === 1 ? 'disabled' : '' ?> m-1">
                          <a href="<?= $paginatedData['pagination']['current_page'] > 1 ? '?page=' . ($paginatedData['pagination']['current_page'] - 1) : '#' ?>" 
                            class="page-link"><i class="previous"></i></a>
                      </li>
                        <?php for ($i = 1; $i <= $paginatedData['pagination']['total_pages']; $i++): ?>
                            <li class="page-item m-1 <?= $i === $paginatedData['pagination']['current_page'] ? 'active' : '' ?>">
                                <a href="?page=<?= $i ?>" class="page-link"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                      <li class="page-item next <?= $paginatedData['pagination']['current_page'] === $paginatedData['pagination']['total_pages'] ? 'disabled' : '' ?> m-1">
                          <a href="<?= $paginatedData['pagination']['current_page'] < $paginatedData['pagination']['total_pages'] ? '?page=' . ($paginatedData['pagination']['current_page'] + 1) : '#' ?>" 
                            class="page-link"><i class="next"></i></a>
                      </li>
                  </ul>

          </div>
      </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
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
            formData.append('id', id);

            fetch('/api/form-remove', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Removido!',
                        data.message,  
                        'success'
                    ).then(() => {
                        location.reload();  
                    });
                } else {
                    Swal.fire(
                        'Erro!',
                        data.message,  
                        'error'
                    );
                }
            })
            .catch(error => {
                Swal.fire(
                    'Erro!',
                    'Ocorreu um erro ao tentar remover o lead.',
                    'error'
                );
            });
        }
    });
}

</script>