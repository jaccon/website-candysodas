<?php 
include(__DIR__ . '/../../config.inc.php'); 
global $CONFIG;
session_start();
Auth::loginSession();

$customerId = Auth::getUserData($_SESSION['user'], "id");
$usergroup = Auth::getUserData($_SESSION['user'], "usergroup");
$name = Auth::getUserData($_SESSION['user'], "name");
$login = Auth::getUserData($_SESSION['user'], "email");
$document = Auth::getUserData($_SESSION['user'], "document");
$phone = Auth::getUserData($_SESSION['user'], "phone");
$language = Auth::getUserData($_SESSION['user'], "language");
$avatar = Auth::getUserData($_SESSION['user'], "avatar");
$id = Auth::getUserData($_SESSION['user'], "id");
$currentLanguage = Auth::getUserData($_SESSION['user'], "language");
$thumbnail = Auth::getAvatar($avatar);

$spaceId = Security::inputSanitizer($_GET['id']) ?? null;
$projectId = Security::inputSanitizer($_GET['projectId']) ?? null;
$saveSuccess = false;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $spaceId) {

    $dataToUpdate = [
        'name' => Security::inputSanitizer($_POST['name']),
        'description' => Security::inputSanitizer($_POST['description']),
        'spaceId' => Security::inputSanitizer($_POST['spaceId']),
        'supplierId' => Security::inputSanitizer($_POST['supplierId']),
        'spaceDeadline' => Security::inputSanitizer($_POST['spaceDeadline']),
        'priority' => Security::inputSanitizer($_POST['priority']),
        'status' => Security::inputSanitizer($_POST['status']),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    $updateResult = helperSpacesUpdate::updateTaskById($spaceId, $dataToUpdate);

    if ($updateResult['success']) {
        $message = $updateResult['message'];
        $saveSuccess = true;
    } else {
        $message = $updateResult['message'];
    }
}
?>


<!DOCTYPE html>
<html lang="en" >
   <head>
      <title> <?= PAGE_TITLE; ?>  </title>
      <meta charset="utf-8"/>
      <meta name="description" content="SGIX Content Management System, fast, secure"/>
      <meta name="keywords" content="SGIX CMS, SGIX Content Management System, Secure, Flexible"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <meta property="og:locale" content="en_US" />
      <meta property="og:type" content="article" />
      <meta property="og:title" content="SGIX CMS | Powerful CMS" />
      <meta property="og:url" content="https://www.sgix.com.br"/>
      <meta property="og:site_name" content="SGIX CMS | Powerful CMS" />
      <link rel="canonical" href="projects.html"/>
      <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
      <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
   </head>
   <body  
      id="kt_body" 
      data-kt-app-header-stacked="true" 
      data-kt-app-header-primary-enabled="true" 
      data-kt-app-header-secondary-enabled="true" 
      data-kt-app-toolbar-enabled="true"  
      class="app-default" 
      >
      
      <script src="assets/js/sgix.js"></script>

      <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
         <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">

            <div id="kt_app_header" class="app-header">
               <?php include('../components/header/header.inc.php'); ?>
            </div>
            
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
               <div class="app-container  container-xxl d-flex flex-row flex-column-fluid ">
                  <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                     <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_toolbar" class="app-toolbar  pt-lg-9 pt-6 ">
                           <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack flex-wrap ">
                              <div class="d-flex flex-stack flex-wrap gap-4 w-100">
                                 <div class="page-title d-flex flex-column gap-3 me-3">
                                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bolder fs-2x my-0">
                                       Edit Task
                                    </h1>
                                    
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                       <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                          <a href="../index.html" class="text-gray-500 text-hover-primary">
                                          <i class="ki-duotone ki-home fs-3 text-gray-500 me-n1"></i>                                     
                                          </a>
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                          Projects                                             
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                          Edit Task            
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>
                           
                           <div class="card mb-5 mb-xl-10">
                              
                              <div class="card-header border-0 cursor-pointer">
                                 <div class="card-title m-0">
                                    <h3 class="fw-bold m-0"> Task Details </h3>
                                 </div>

                                 <?php if(Auth::getUsergroupByEmail($_SESSION['user']) === 'admin') { ?>
                                    <a href="projects-view.html?id=<?= $projectId ?? ''; ?>" class="btn btn-sm btn-primary align-self-center">
                                       Ver projeto
                                    </a>
                                 <?php } ?>

                              </div>
                              
                              <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?id=<?= $spaceId; ?>&projectId=<?= $projectId; ?>&success=true">
                                    
                                    <div class="card-body border-top p-9">
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> Name </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="<?= MYACCOUNT_08; ?>" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="name" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="Task Name" 
                                              value="<?= helperSpaces::getTaskById($spaceId,'name'); ?>" />
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= PRJ_ADD_05; ?> </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <input 
                                                    type="text" 
                                                    name="description" 
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Descrição da tarefa" 
                                                    value="<?= helperSpaces::getTaskById($spaceId,'description'); ?>" />
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       
                                       

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> Space </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Espaço relacionado a tarefa" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">

                                            <?php 
                                              $customers = helperSpaces::getSpaceList($projectId); 
                                              $space = helperSpaces::getTaskById($spaceId,'spaceId');
                                            ?>

                                            <select 
                                              name="spaceId" 
                                              id="spaceId" 
                                              data-placeholder="Choose a space..." 
                                              class="form-select form-select-solid form-select-lg"
                                              >
                                              <option value=""> 
                                                  Escolha o espaço 
                                              </option>
                                              <?php foreach ($customers as $customer): ?>
                                                  <option value="<?= htmlspecialchars($customer['uuid']); ?>" <?= CMS::isSelected($customer['uuid'], $space); ?>>  
                                                      <?= htmlspecialchars($customer['name']); ?>
                                                  </option>
                                              <?php endforeach; ?>
                                              </select>
                                              
                                              <div class="form-text">
                                                  Choose a Space to related task
                                              </div>

                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> Space Deadline  </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Phone number must be active" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                            <input 
                                            type="date" 
                                            name="spaceDeadline" 
                                            class="form-control form-control-lg form-control-solid" 
                                            placeholder="Space deadline to delivery"
                                            value="<?= helperSpaces::getTaskById($spaceId,'spaceDeadline'); ?>" 
                                          </div>
                                       </div>

                                      </div>

                                      <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Status </label>
                                          
                                          <div class="col-lg-8 fv-row">
                                            <?php $status = helperSpaces::getTaskById($spaceId,'status'); ?>
                                            <select 
                                                name="status" 
                                                data-placeholder="Select status..." 
                                                class="form-select form-select-solid form-select-lg"
                                            >
                                              <option value="working" <?= CMS::isSelected('working', $status); ?>> <?= PRJ_STATUS_01; ?> </option>
                                              <option value="cancelled" <?= CMS::isSelected('cancelled', $status); ?>> <?= PRJ_STATUS_02; ?> </option>
                                              <option value="done" <?= CMS::isSelected('done', $status); ?>> <?= PRJ_STATUS_06; ?> </option>
                                              <option value="onhold" <?= CMS::isSelected('onhold', $status); ?>> <?= PRJ_STATUS_04; ?> </option>
                                            </select>
                                            <div class="form-text">
                                                The space status in project
                                            </div>

                                          </div>
                                          
                                      </div>

                                      <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Priority </label>
                                          
                                          <div class="col-lg-8 fv-row">
                                            <?php $priority = helperSpaces::getTaskById($spaceId,'priority'); ?>
                                            <select 
                                              name="priority" 
                                              data-placeholder="Select payment method..." 
                                              class="form-select form-select-solid form-select-lg"
                                              >
                                              <option value="high" <?= CMS::isSelected('high', $priority); ?>> High </option>
                                              <option value="medium" <?= CMS::isSelected('medium', $priority); ?>> Medium </option>
                                              <option value="low" <?= CMS::isSelected('low', $priority); ?>> Low </option>
                                              <option value="urgent" <?= CMS::isSelected('urgent', $priority); ?>> Urgent </option>
                                              <option value="critical" <?= CMS::isSelected('critical', $priority); ?>> Critical </option>
                                            </select>

                                          <div class="form-text">
                                              The space priority in project
                                          </div>

                                          </div>
                                          
                                      </div>

                                      <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Supplier </label>
                                          
                                          <div class="col-lg-8 fv-row">

                                            <?php $customers = helperCustomers::getEnabledSupplier($customersFile); ?>
                                            <?php $supplierId = helperSpaces::getTaskById($spaceId,'supplierId'); ?>
                                            <select 
                                              name="supplierId" 
                                              data-placeholder="Choose a project supplier..." 
                                              class="form-select form-select-solid form-select-lg"
                                            >
                                            <option value=""> 
                                                Escolha o fornecedor
                                            </option>
                                            <?php foreach ($customers as $customer): ?>
                                                <option value="<?= htmlspecialchars($customer['id']); ?>" <?= CMS::isSelected($customer['id'], $supplierId); ?>> 
                                                    <?= htmlspecialchars($customer['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                            </select>
                                            
                                            <div class="form-text">
                                            Choose the customer
                                            </div>

                                          </div>
                                          
                                      </div>
                                       
                                    </div>
                                    
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                       <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"> <?= BUTTON_SUBMIT_01; ?> </button>
                                    </div>
                                    
                                 </form>
                              </div>

                              <div class="card mb-5 mb-xl-10">
                                
                                <div class="card-header border-0 cursor-pointer">
                                  <div class="card-title m-0">
                                      <h3 class="fw-bold m-0"> Arquivos </h3>
                                  </div>
                                </div>
                                
                                <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    id="uploadFile">
                                    
                                    <div class="card-body border-top p-9">
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> Name </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="<?= MYACCOUNT_08; ?>" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="file" 
                                              name="uploadFile" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="Task Name"
                                              accept=".jpg,.jpeg,.png,.pdf"
                                              id="fileInput"
                                              />
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= PRJ_ADD_05; ?> </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <input 
                                                    type="text" 
                                                    name="description" 
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Descrição do arquivo" 
                                                    />
                                                   <input 
                                                      type="hidden" 
                                                      name="metaTaxonomy"
                                                      value="<?= $projectId; ?>|<?= $spaceId; ?>"
                                                    />
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                      </div>

                                      <div class="card-footer d-flex justify-content-end py-6 px-9">
                                         <span id="submitFileButton" class="btn btn-primary"> Upload </span>
                                      </div>

                                      <div class="row mb-6 p-9">
                                          <div class="col-lg-12 fv-row">
                                          <div class="card ">
                                             
                                             <div id="kt_referred_users_tab_content" class="tab-content">
                                                      <div id="kt_referrals_1" class="card-body p-0 tab-pane fade active show" role="tabpanel" aria-labelledby="kt_referrals_tab_1">
                                                         <div class="table-responsive">
                                                            <?php 
                                                               $filesResult = Uploads::handleMetadataFiles();

                                                               if (isset($filesResult['error'])) {
                                                                  echo '<div class="alert alert-danger">' . htmlspecialchars($filesResult['error']) . '</div>';
                                                               } elseif (isset($filesResult['warning'])) {
                                                                  echo '<div class="alert alert-warning">' . htmlspecialchars($filesResult['warning']) . '</div>';
                                                               } else {
                                                                  $files = $filesResult['files'];

                                                                  if (!empty($files)) { ?>
                                                                     <table class="table table-row-bordered align-middle gy-6">
                                                                           <thead class="border-bottom border-gray-200 fs-6 fw-bold bg-lighten">
                                                                              <tr>
                                                                                 <th class="min-w-125px ps-9"> Filename </th>
                                                                                 <th class="min-w-125px px-0"> CreatedAt </th>
                                                                                 <th class="min-w-125px"> File Size </th>
                                                                                 <th class="min-w-125px ps-0"> Actions </th>
                                                                              </tr>
                                                                           </thead>
                                                                           <tbody class="fs-6 fw-semibold text-gray-600">
                                                                              <?php foreach ($files as $file): ?>
                                                                                 <tr>
                                                                                       <td class="ps-9"> 
                                                                                          <?= htmlspecialchars($file['originalFileName']) ?> <br/>
                                                                                          <small class="text-gray-600"> <?= htmlspecialchars($file['description']) ?> </small>
                                                                                       </td>
                                                                                       <td class="ps-0"> <?= htmlspecialchars($file['createdAt']) ?> </td>
                                                                                       <td> ??? </td>
                                                                                       <td> 
                                                                                       
                                                                                          <a 
                                                                                             href="<?= ($CONFIG['CONF']['uploadUrl']."/".$file['directoryName']."/".$file['filename']) ?>"
                                                                                             target="_blank"
                                                                                             class="btn btn-light-primary me-2 mb-2 btn-sm" 
                                                                                          > Download </a> 

                                                                                          <span 
                                                                                             class="btn btn-light-danger me-2 mb-2 btn-sm" 
                                                                                             id="btRemove" 
                                                                                             data-task-remove="<?= htmlspecialchars($file['id']) ?>">
                                                                                             Remove </span> 
                                                                                       </td>
                                                                                 </tr>
                                                                              <?php endforeach; ?>
                                                                           </tbody>
                                                                     </table>
                                                                     <?php 
                                                                        } else {
                                                                           echo '<div class="alert alert-warning">Nenhum arquivo com metadataType "files" foi encontrado.</div>';
                                                                        }
                                                                     } ?>
                                                         </div>
                                                      </div>
                                                     
                                                      <div id="kt_referrals_2" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="kt_referrals_tab_2">
                                                         <div class="table-responsive">
                                                            <table class="table table-row-bordered align-middle gy-6">
                                                                  <thead class="border-bottom border-gray-200 fs-6 fw-bold bg-lighten">
                                                                     <tr>
                                                                        <th class="min-w-125px ps-9">Order ID</th>
                                                                        <th class="min-w-125px px-0">User</th>
                                                                        <th class="min-w-125px">Date</th>
                                                                        <th class="min-w-125px">Bonus</th>
                                                                        <th class="min-w-125px ps-0">Profit</th>
                                                                     </tr>
                                                                  </thead>
                                                                 
                                                            </table>
                                                         </div>
                                                      </div>
                                             </div>
                                          </div>
                                          </div>
                                       </div>

                                    </div>
                                    
                                 </form>
                                 
                              </div>
                           
                     </div>
                     
                     <?php include('../components/footer/footer.inc.php'); ?>
                     <?php include('../components/modals/password-update/password-update.inc.php'); ?>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <?php include('../components/customize/container.inc.php'); ?>
      <?php include('../components/customize/button.inc.php'); ?>
      <?php include('../components/floatButtons/float.inc.php'); ?>
      
      <script>
         var hostUrl = "/assets/";        
      </script>
      <script src="assets/plugins/global/plugins.bundle.js"></script>
      <script src="assets/js/scripts.bundle.js"></script>
      <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
      <script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
      <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
      <script src="assets/js/widgets.bundle.js"></script>
      <script src="assets/js/custom/apps/chat/chat.js"></script>
      <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
      <script src="assets/js/custom/utilities/modals/create-app.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/type.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/budget.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/settings.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/team.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/targets.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/files.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/complete.js"></script>
      <script src="assets/js/custom/utilities/modals/create-project/main.js"></script>
      <script src="assets/js/custom/utilities/modals/new-address.js"></script>
      <script src="assets/js/custom/utilities/modals/users-search.js"></script>

      <script>
         const urlParams = new URLSearchParams(window.location.search);
         if (urlParams.has('success')) {
            Swal.fire({
                  title: 'Success!',
                  text: 'Your data has been saved successfully.',
                  icon: 'success',
                  confirmButtonText: 'OK'
            }).then(() => {
                  const url = new URL(window.location);
                  url.searchParams.delete('success');
                  window.history.replaceState({}, document.title, url);
                  location.reload(); 
            });
         }

        //  Upload
        document.getElementById("submitFileButton").addEventListener("click", function () {
            const form = document.getElementById("uploadFile");
            const fileInput = document.querySelector('input[name="uploadFile"]');
            const file = fileInput.files[0];

            if (!file) {
               Swal.fire({
                     title: 'Erro!',
                     text: 'Por favor, selecione um arquivo.',
                     icon: 'error',
                     confirmButtonText: 'OK'
               });
               return;
            }

            const maxSizeInMB = <?= $CONFIG['CONF']['uploadMaxFileSize']; // upload max file size ?>;
            const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

            if (file.size > maxSizeInBytes) {
               Swal.fire({
                     title: 'Erro!',
                     text: `O arquivo não pode ser maior que ${maxSizeInMB}MB.`,
                     icon: 'error',
                     confirmButtonText: 'OK'
               });
               return;
            }

            const formData = new FormData(form);
            formData.append("uuid", crypto.randomUUID());

            const apiUrl = "/api/upload-files";

            Swal.fire({
               title: 'Enviando arquivo...',
               text: 'Por favor, aguarde.',
               allowOutsideClick: false,
               showConfirmButton: false,
               didOpen: () => {
                     Swal.showLoading();
               }
            });

            fetch(apiUrl, {
               method: "POST",
               body: formData,
            })
               .then(response => response.json())
               .then(data => {
                     if (data.success) {
                        Swal.fire({
                           title: 'Sucesso!',
                           text: 'Arquivo enviado com sucesso.',
                           icon: 'success',
                           confirmButtonText: 'OK'
                        }).then((result) => {
                           if (result.isConfirmed) {
                                 location.reload(); // Recarrega a página após confirmar o SweetAlert
                           }
                        });
                        form.reset();
                     } else {
                        Swal.fire({
                           title: 'Erro!',
                           text: `Erro ao enviar o arquivo: ${data.message}`,
                           icon: 'error',
                           confirmButtonText: 'OK'
                        });
                     }
               })
               .catch(error => {
                     console.error("Erro ao enviar o arquivo:", error);
                     Swal.fire({
                        title: 'Erro!',
                        text: 'Ocorreu um erro ao enviar o arquivo. Tente novamente.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                     });
               });
         });

         // File Remove
         document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#btRemove").forEach(button => {
               button.addEventListener("click", function () {
                     const fileId = this.getAttribute("data-task-remove");

                     if (!fileId) {
                        Swal.fire({
                           title: "Erro!",
                           text: "O ID do arquivo não foi encontrado.",
                           icon: "error",
                           confirmButtonText: "OK"
                        });
                        return;
                     }

                     Swal.fire({
                        title: "Tem certeza?",
                        text: "Você não poderá recuperar este arquivo!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sim, remover!",
                        cancelButtonText: "Cancelar"
                     }).then((result) => {
                        if (result.isConfirmed) {
                           fetch(`/api/file-remove`, {
                                 method: "DELETE",
                                 headers: {
                                    "Content-Type": "application/json"
                                 },
                                 body: JSON.stringify({ id: fileId })
                           })
                                 .then(response => response.json())
                                 .then(data => {
                                    if (data.success) {
                                       Swal.fire({
                                             title: "Removido!",
                                             text: "O arquivo foi removido com sucesso.",
                                             icon: "success",
                                             confirmButtonText: "OK"
                                       }).then(() => {
                                             location.reload(); // Recarrega a página após sucesso
                                       });
                                    } else {
                                       Swal.fire({
                                             title: "Erro!",
                                             text: `Não foi possível remover o arquivo: ${data.message}`,
                                             icon: "error",
                                             confirmButtonText: "OK"
                                       });
                                    }
                                 })
                                 .catch(error => {
                                    console.error("Erro ao remover o arquivo:", error);
                                    Swal.fire({
                                       title: "Erro!",
                                       text: "Ocorreu um erro ao tentar remover o arquivo.",
                                       icon: "error",
                                       confirmButtonText: "OK"
                                    });
                                 });
                        }
                     });
               });
            });
         });

      </script>

   </body>
</html>