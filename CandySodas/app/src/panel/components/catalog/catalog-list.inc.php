<?php 
global $CONFIG;

$jsonFilePath = $CONFIG['CONF']['cacheDir'].'/catalog.json';
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

$projectsFile = '../../cached/categories.json';
$projectsData = file_exists($projectsFile) ? json_decode(file_get_contents($projectsFile), true) : [];

function getPageUrl($page, $perPage) {
    $params = $_GET;
    $params['page'] = $page;
    $params['perPage'] = $perPage;
    return '?' . http_build_query($params);
}

$itemsPerPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$paginatedData = helperProjects::paginate($datas, $page, $itemsPerPage);

?>

<div class="col-xl-12">
    <div class="card card-flush h-md-100">
      <div class="card-body pt-6">
          <div class="table-responsive">

            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                <thead>
                  <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                      <th class="p-0 pb-3 text-start"> <?= TABLE_TITLE; ?> </th>
                      <th class="p-0 pb-3 text-end"> <?= TABLE_CREATED; ?> </th>
                      <th class="p-0 pb-3 text-end"> Product Type </th>
                      <th class="p-0 pb-3 text-end"> Status </th>
                      <th class="p-0 pb-3 text-end pe-7"> <?= TABLE_ACTION; ?> </th>
                  </tr>
                </thead>

                <tbody>
                      <?php if (!empty($paginatedData['data'])): ?>
                          <?php foreach ($paginatedData['data'] as $item): ?>
                          <tr>
                              <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                      <a href="catalog-product-update.html?id=<?= $item['id']; ?>" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                        <?= htmlspecialchars($item['title']); ?> <br/>
                                        <span class="text-gray-400 fw-semibold d-block fs-7">
                                          SKU: <?= htmlspecialchars($item['sku']); ?>
                                      </a>
                                    </div>
                                </div>
                              </td>
                              <td class="text-end pe-0">
                                <span class="text-gray-600 fw-bold fs-6">
                                  <?= Admin::formatDateTime($item['createdAt']); ?>
                                  
                                </span>                                
                              </td>
                              
                              <td class="text-end pe-2">
                                <?= ($item['productType']);?>
                              </td>

                              <td class="text-end pe-2">
                                 <?= Admin::statusBaghets($item['status']); ?>
                              </td>

                              <td class="text-end pe-0">

                                <a href="catalog-product-update?id=<?= $item['id']; ?>" alt="Edit data" title="Edit data"> 
                                    <i class="ki-duotone ki-pencil">
                                      <span class="path1"></span>
                                      <span class="path2"></span>
                                    </i>
                                  </a> 

                                  <button 
                                    title="Delete data" 
                                    class="delete-button" 
                                    data-id="<?= $item['id']; ?>" 
                                    onclick="confirmDelete('<?= $item['id']; ?>')">
                                      <i class="ki-duotone ki-cross-circle">
                                          <span class="path1"></span>
                                          <span class="path2"></span>
                                      </i>
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

                  <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="d-flex align-items-center">
                            <div class="text-muted me-4">
                                Total Records: <span class="fw-bold"><?= count($datas) ?></span>
                                <span class="mx-2">|</span>
                                Showing: <span class="fw-bold"><?= ($paginatedData['pagination']['current_page'] - 1) * $itemsPerPage + 1 ?>-<?= min($paginatedData['pagination']['current_page'] * $itemsPerPage, count($datas)) ?></span>
                            </div>
                            <select class="form-select form-select-sm w-auto" id="perPageSelect" onchange="changeItemsPerPage(this.value)">
                                <option value="10" <?= $itemsPerPage === 10 ? 'selected' : '' ?>>10 per page</option>
                                <option value="100" <?= $itemsPerPage === 100 ? 'selected' : '' ?>>100 per page</option>
                                <option value="500" <?= $itemsPerPage === 500 ? 'selected' : '' ?>>500 per page</option>
                                <option value="1000" <?= $itemsPerPage === 1000 ? 'selected' : '' ?>>1000 per page</option>
                            </select>
                        </div>

                        <ul class="pagination pagination-circle pagination-outline">
                            <li class="page-item previous <?= $paginatedData['pagination']['current_page'] === 1 ? 'disabled' : '' ?> m-1">
                                <a href="<?= getPageUrl($paginatedData['pagination']['current_page'] - 1, $itemsPerPage) ?>" 
                                    class="page-link"><i class="previous"></i></a>
                            </li>
                            <?php for ($i = 1; $i <= $paginatedData['pagination']['total_pages']; $i++): ?>
                                <li class="page-item m-1 <?= $i === $paginatedData['pagination']['current_page'] ? 'active' : '' ?>">
                                    <a href="<?= getPageUrl($i, $itemsPerPage) ?>" class="page-link"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item next <?= $paginatedData['pagination']['current_page'] === $paginatedData['pagination']['total_pages'] ? 'disabled' : '' ?> m-1">
                                <a href="<?= getPageUrl($paginatedData['pagination']['current_page'] + 1, $itemsPerPage) ?>" 
                                    class="page-link"><i class="next"></i></a>
                            </li>
                        </ul>
                    </div>

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

            fetch('/api/category-remove', {
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

// Add to your existing <script> section
function changeItemsPerPage(value) {
    const url = new URL(window.location.href);
    url.searchParams.set('perPage', value);
    url.searchParams.set('page', 1); // Reset to first page when changing items per page
    window.location.href = url.toString();
}

</script>