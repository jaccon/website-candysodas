<?php 
global $CONFIG;

$jsonFilePath = $CONFIG['CONF']['cacheDir'].'/projects.json';
$datas = [];

$userId = Auth::getUserData($_SESSION['user'], "id");

if (file_exists($jsonFilePath)) {
    $alldatas = json_decode(file_get_contents($jsonFilePath), true);

    if (is_array($alldatas)) {
        foreach ($alldatas as $data) {
            if ($usergroup === 'admin' || 
                $data['customerId'] === $userId || 
                Auth::getPermissionsUsers($data['permissionUsers'], $customerId) === true) {
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

$projectsFile = '../../cached/projects.json';
$projectsData = file_exists($projectsFile) ? json_decode(file_get_contents($projectsFile), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $itemId = $_POST['id'];
    $itemIndex = array_search($itemId, array_column($projectsData, 'id'));

    if ($itemIndex !== false) {
        unset($projectsData[$itemIndex]);
        $projectsData = array_values($projectsData);
        file_put_contents($projectsFile, json_encode($projectsData, JSON_PRETTY_PRINT));

        echo "<script>alert('Registro excluído com sucesso!'); window.location.href = 'projects.html';</script>";
        exit;
    } else {
        echo "<script>alert('Registro não encontrado!'); window.location.href = 'projects.html';</script>";
        exit;
    }
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$paginatedData = helperProjects::paginate($datas, $page, 10);

?>
<div class="col-xl-12">
    <div class="card card-flush h-md-100">
      <div class="card-header pt-7">
          <h3 class="card-title align-items-start flex-column">			
            <span class="card-label fw-bold text-gray-800">
              <?= PVIEW_STATUS; ?>
            </span>
          </h3>
      </div>
      <div class="card-body pt-6">
          <div class="table-responsive">
            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
              <thead>
                  <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                      <th class="p-0 pb-3 min-w-175px text-start"> <?= PRJ_TABLE_1; ?> </th>
                      <th class="p-0 pb-3 min-w-100px text-end"> <?= PRJ_TABLE_2; ?> </th>
                      <th class="p-0 pb-3 min-w-100px text-end"> <?= PRJ_TABLE_3; ?> </th>
                      <th class="p-0 pb-3 min-w-100px text-end"> <?= PRJ_TABLE_4; ?> </th>
                      <th class="p-0 pb-3 min-w-175px text-end pe-12"> <?= PRJ_TABLE_5; ?> </th>
                      <th class="p-0 pb-3 w-125px text-end pe-7"> <?= PRJ_TABLE_6; ?></th>
                  </tr>
                </thead>
               
                <tbody>
                      <?php if (!empty($paginatedData['data'])): ?>
                          <?php foreach ($paginatedData['data'] as $item): ?>
                          <tr>
                              <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-3">                                                   
                                      <img src="assets/media/stock/600x600/img-49.jpg" class="" alt=""/>                                                    
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                      <a href="projects-view.html?id=<?= $item['id']; ?>" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                        <?= htmlspecialchars($item['title']); ?>
                                      </a>
                                      <span class="text-gray-500 fw-semibold d-block fs-7">
                                        <?= htmlspecialchars($item['description']); ?>
                                      </span>
                                    </div>
                                </div>
                              </td>
                              <td class="text-end pe-0">
                                <span class="text-gray-600 fw-bold fs-6">
                                  <?= helperProjects::formatCurrentyToBRL($item['totalProjectCost']); ?>
                                </span>                                
                              </td>
                              <td class="text-end pe-0">
                                <?php
                                    $deadline = $item['projectDeadline'];
                                    echo helperProjects::getDeliveryMessage($deadline);
                                ?>
                              </td>
                              <td class="text-end pe-12">
                                <?= Admin::convertTimestampToDate($item['projectDeadline']); ?>
                              </td>
                              <td class="text-end pe-12">
                                  <?= Admin::statusBaghets($item['status']); ?>
                              </td>
                              <td class="text-end pe-0">
                                <?= Admin::convertIsoDate($item['createdAt']); ?>
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
          </div>
      </div>
    </div>
</div>