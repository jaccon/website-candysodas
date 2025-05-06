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
      <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>


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

                                    <?php 
                                       $customers = helperSpaces::getSpaceList($projectId); 
                                       $space = helperSpaces::getTaskById($spaceId,'spaceId');
                                       $spaceName = helperSpaces::getSpaceName($space);
                                    ?>

                                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bolder fs-2x my-0">
                                        <?= PVIEW_TASK; ?> / <?= $spaceName; ?>
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
                                          <?= PVIEW_TASK; ?>            
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
                                    <h3 class="fw-bold m-0"> <?= PVIEW_SPACE_TXT4; ?> / <?= $spaceName; ?> </h3>
                                 </div>

                                 <a href="projects-view.html?id=<?= $projectId ?? ''; ?>" class="btn btn-sm btn-primary align-self-center">
                                    <?= PVIEW_TXT2; ?>
                                 </a>

                              </div>
                              
                              <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?id=<?= $spaceId; ?>&projectId=<?= $projectId; ?>&success=true">
                                    
                                    <div class="card-body border-top p-9">
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> <?= PVIEW_FORM_NAME; ?> </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="<?= MYACCOUNT_08; ?>" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <span class="fw-bold fs-6 text-gray-800">
                                                <?= helperSpaces::getTaskById($spaceId,'name'); ?>
                                             </span>
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= PRJ_ADD_05; ?> </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <span class="fw-bold fs-6 text-gray-800">
                                                      <?= helperSpaces::getTaskById($spaceId,'description'); ?>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> <?= PRJ_TABLE_3; ?>  </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Phone number must be active" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <?= Admin::formatDate(helperSpaces::getTaskById($spaceId,'spaceDeadline')); ?>
                                          </div>
                                      </div>

                                       

                                      <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> 
                                             <?= PVIEW_SPACE_TB_2; ?> </label>
                                          
                                          <div class="col-lg-8 fv-row">
                                            <?= $priority = helperSpaces::getTaskById($spaceId,'priority'); ?>
                                          </div>
                                          
                                      </div>

                                      <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> 
                                             <?= PVIEW_TASK_TB_3; ?> </label>
                                          
                                          <div class="col-lg-8 fv-row">
                                            <?php $customers = helperCustomers::getEnabledSupplier($customersFile); ?>
                                            <?php 
                                             $supplierId = helperSpaces::getTaskById($spaceId,'supplierId'); 
                                             echo helperSupplier::getSupplierNameById($supplierId);
                                            ?>
                                          </div>
                                          
                                      </div>

                                      <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> 
                                             <?= PRJ_TABLE_5; ?> </label>
                                          
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

                                      <?php 
                                        $deadline = helperSpaces::getTaskById($spaceId,'spaceDeadline');
                                        if(helperProjects::getDeliveryLateDays( $deadline) === true) {
                                      ?>
                                       <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">
                                             <i class="ki-duotone ki-information fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                             <div class="d-flex flex-stack flex-grow-1 ">
                                                <div class=" fw-semibold">
                                                   <h4 class="text-gray-900 fw-bold"> Aviso Importante </h4>
                                                <div class="fs-6 text-gray-700 "> 
                                                   Atenção, prazo de entrega desta tarefa finalizou em
                                                   <?= Admin::formatDate(helperSpaces::getTaskById($spaceId,'spaceDeadline')); ?>
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                          <?php } ?>
                                          
                                       </div>

                                    
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                       <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"> 
                                          <?= BUTTON_SUBMIT_01; ?> </button>
                                    </div>
                                    
                                 </form>
                              </div>

                              <div class="card mb-5 mb-xl-10">
                                
                                <div class="card-header border-0 cursor-pointer">
                                  <div class="card-title m-0">
                                      <h3 class="fw-bold m-0"> Comentários </h3>
                                  </div>

                                  <button type="button" class="btn btn-sm btn-danger align-self-center" data-bs-toggle="modal" data-bs-target="#kt_modal_3">
                                       Adicionar Comentário
                                    </button>
                                  
                                </div>

                                 <div class="card-body border-top p-9"> 
                                    <!-- xxx -->
                                    <?php
                                       $jsonFile = $CONFIG['CONF']['cacheDir'].'/task-comments.json';
                                       $jsonData = file_get_contents($jsonFile);
                                       $data = json_decode($jsonData, true);

                                       usort($data, function($a, $b) {
                                          return strtotime($b['createdAt']) - strtotime($a['createdAt']);
                                      });

                                       if (!empty($data)) {
                                          foreach ($data as $item) {
                                    ?>
                                          <div class="timeline-content mb-10 mt-n1  bg-light-primary item-comment">
                                                <div class="pe-3 mb-5">
                                                   <div class="fs-5 fw-semibold mb-2 comment"> <?php echo htmlspecialchars($item['comment']); ?> </div>
                                                   <div class="d-flex align-items-center mt-1 fs-6">
                                                      <div class="text-muted me-2 fs-7">
                                                         <?= Admin::formatDateTime($item['createdAt']); ?> por 
                                                         <?= Auth::getUserDataById(htmlspecialchars($item['userId']),"name"); ?> 
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="overflow-auto pb-5">
                                                   <?php if (!empty($item['uploadFiles']) && is_array($item['uploadFiles'])): ?>
                                                      <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-7">
                                                         <?php
                                                            foreach ($item['uploadFiles'] as $file) {
                                                         ?>
                                                                  <div class="overlay me-10">
                                                                     <div class="overlay-wrapper">
                                                                        <img 
                                                                           alt="img" 
                                                                           class="rounded w-80px"
                                                                           width="20"
                                                                           src="<?php echo $CONFIG['CONF']['uploadUrl']."/".$file['originalDirectory']."/".$file['uploadPath']; ?>">
                                                                     </div>
                                                                     <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                                        <a href="<?php echo $CONFIG['CONF']['uploadUrl']."/".$file['originalDirectory']."/".$file['uploadPath']; ?>" 
                                                                           class="btn btn-sm btn-primary btn-shadow" target="_blank">
                                                                           Ver
                                                                        </a>
                                                                     </div>
                                                                  </div>
                                                         <?php } ?>
                                                      </div>
                                                   <?php endif; ?>
                                                </div>
                                          </div>
                                    <?php
                                       }
                                    }
                                    ?>
                                 <!-- xxx -->
                                 </div>
                                   
                                
                                
                                 
                              </div>

                              <?php include('../components/custom/modal-project-components/moda-task-comment.inc.php'); ?>
                           
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