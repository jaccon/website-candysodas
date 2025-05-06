<?php 
global $CONFIG;

$jsonFilePath = $CONFIG['CONF']['cacheDir'].'/users.json';
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


$projectsFile = '../../cached/users.json';
$projectsData = file_exists($projectsFile) ? json_decode(file_get_contents($projectsFile), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $itemId = $_POST['id'];
    $itemIndex = array_search($itemId, array_column($projectsData, 'id'));

    if( $itemId === Auth::getUserData($_SESSION['user'], "id")) {
      echo "<script>alert('Você não pode remover um usuário que está logado'); window.location.href = 'users.html';</script>";
      exit();
    }

    if ($itemIndex !== false) {
        unset($projectsData[$itemIndex]);
        $projectsData = array_values($projectsData);
        file_put_contents($projectsFile, json_encode($projectsData, JSON_PRETTY_PRINT));
        echo "<script>window.location.href = 'users.html';</script>";
        exit;
    } else {
        exit;
    }
}


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
                      <th class="p-0 pb-3 min-w-175px text-start">  <?= USERS_USERNAME; ?> </th>
                      <th class="p-0 pb-3 min-w-100px text-end"> <?= USERS_USERGROUP; ?> </th>
                      <th class="p-0 pb-3 text-end pe-7"> <?= USERS_CREATEDAT; ?> </th>
                      <th class="p-0 pb-3 min-w-175px text-end pe-12"> <?= USERS_STATUS; ?> </th>
                      <th class="p-0 pb-3 w-125px text-end pe-7"> <?= USERS_ACTIONS; ?> </th>
                  </tr>
                </thead>

                <tbody>
                      <?php if (!empty($paginatedData['data'])): ?>
                          <?php foreach ($paginatedData['data'] as $item): ?>
                          <tr>
                              <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-3">                                                   
                                      <img src="assets/media/avatars/user.svg" class="" alt=""/>                                                    
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                      <a href="users-update.html?id=<?= $item['id']; ?>" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                        <?= htmlspecialchars($item['name']); ?>
                                      </a>
                                      <span class="text-gray-500 fw-semibold d-block fs-7">
                                        <?= htmlspecialchars($item['email']); ?>
                                      </span>
                                    </div>
                                </div>
                              </td>
                              <td class="text-end pe-0">
                                <span class="text-gray-600 fw-bold fs-6">
                                  <?= $item['usergroup']; ?>
                                </span>                                
                              </td>
                              <td class="text-end pe-0">
                                  <?= Admin::formatDateTime($item['createdAt']); ?>
                              </td>
                              <td class="text-end pe-12">
                                <?= Admin::statusBaghets($item['status']); ?>
                              </td>
                              <td class="text-end pe-0">

                                <?php if (Auth::getUserData($_SESSION['user'], "usergroup") === "admin") { ?>
                                  &nbsp;
                                  <a href="users-update.html?id=<?= $item['id']; ?>" alt="Edit data" title="Edit data"> 
                                    <i class="ki-duotone ki-pencil">
                                      <span class="path1"></span>
                                      <span class="path2"></span>
                                    </i>
                                  </a> 
                                  &nbsp;
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
                                <?php } ?>
                              </td>
                          </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center"> Nenhum registro encontrado </td>
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
            confirmButtonText: 'Sim, excluir!',
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.createElement("form");
                form.method = "POST";
                form.action = window.location.href;
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "id";
                input.value = id;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>