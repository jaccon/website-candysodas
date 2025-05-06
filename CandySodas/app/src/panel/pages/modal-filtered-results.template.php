<?php 
include(__DIR__ . '/../../config.inc.php');
global $CONFIG;
session_start();
Auth::loginSession();
$spaceId = $_REQUEST['id'];
?>
<div class="table-responsive">
    <table class="table table-striped gy-7 gs-7">
      <thead>
          <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
              <th> Tarefa </th>
              <th> Espaço </th>
              <th> Prioridade</th>
              <th> Previsão da entrega </th>
              <th> Data criação </th>
              <th> Fornecedor </th>
              <th> Status </th>
          </tr>
      </thead>
      <?php 
        $data = helperSpaces::getSpaceTasksById($spaceId);
        if (is_array($data) && !empty($data)): 
            foreach ($data as $item): 
      ?>
      <tbody>
        <tr>
            <td>
              <?= $item['name']; ?> <br/>
              <span class="text-muted"> 
                <?= $item['description']; ?>
              <span> 
            </td>
            <td>
              <?= helperSpaces::getSpaceName($item['spaceId']); ?>
            </td>
            <td><?= helperProjects::getPriorityProject($item['priority']); ?></td>
            <td><?=Admin::formatDate($item['spaceDeadline']); ?></td>
          
            <td><?= Admin::formatDateTime($item['created_at']); ?></td>
            <td>
              <?= helperSupplier::getSupplierById($item['supplierId']); ?>
            </td>
            <td><?= helperProjects::getStatusProject($item['status']); ?></td>
        </tr>
        <?php 
            endforeach; 
        else: 
        ?>
            <tr>
                  <td colspan="7" class="text-center">No data available.</td>
            </tr>
        <?php endif; ?>
      </tbody>
  </table>
</div>