<?php
include(__DIR__ . '/../../config.inc.php');

global $CONFIG;
session_start();
Auth::loginSession();

$message = '';
$success = false;

$projectId = $_GET['id'] ?? null;
$projectData = null;

if ($projectId) {
    $projectData = helperProjects::getProjectById($projectId);
}

if (!$projectData) {
    echo "Projeto não encontrado ou erro ao carregar os dados.";
    exit;
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
                                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bolder fs-2x my-0">
                                       <?= PVIEW_TXT0; ?> / <?= $projectData['title'] ?? ''; ?>
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
                                          <?= PVIEW_TXT1; ?>                                             
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                          <?= PVIEW_TXT2; ?>    
                                       </li>
                                    </ul>
                                 </div>

                              </div>

                           </div>
                        </div>
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>

                          <!-- Resume -->
                          <div class="card mb-5 mb-xl-10">
                              <div class="card-body pt-9 pb-0">
                                 <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                       <div class="me-7 mb-4">
                                          <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                             <img src="assets/media/avatars/user.svg" alt="Project Customer">
                                          </div>
                                       </div>
                                       
                                       <div class="flex-grow-1">
                                          <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                             <div class="d-flex flex-column">
                                                   <div class="d-flex align-items-center mb-2">
                                                      <span class="text-gray-900 fs-2 fw-bold me-1">
                                                         <?= $projectData['title'] ?? ''; ?>
                                                      </span>
                                                   </div>
                                                                   
                                                   <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                      <span class="d-flex align-items-center text-gray-500 me-5 mb-2">
                                                         <i class="ki-duotone ki-profile-circle fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>      
                                                         <?= Auth::getUserById($projectData['customerId']); ?>
                                                      </span>

                                                      <span class="d-flex align-items-center text-gray-500 mb-2">
                                                         <i class="ki-duotone ki-sms fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>               
                                                         <?= Auth::getUserDataById($projectData['customerId'],'email'); ?>
                                                      </span>
                                                   </div>
                                             </div>
                                            
                                             <div class="d-flex my-4">

                                                   <div class="me-0">
                                                      <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                         <i class="ki-solid ki-dots-horizontal fs-2x"></i>                            </button>
                                                      
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                                               <!--begin::Heading-->
                                                               <div class="menu-item px-3">
                                                                  <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                                        <?= PVIEW_TXT3; ?>
                                                                  </div>
                                                               </div>
                                                            
                                                               <div class="menu-item px-3">
                                                                  <a href="#" class="menu-link px-3">
                                                                        <?= PVIEW_MENU_1; ?>
                                                                  </a>
                                                               </div>
                                                               
                                                               <div class="menu-item px-3">
                                                                  <a href="#" class="menu-link flex-stack px-3">
                                                                        <?= PVIEW_MENU_2; ?>
                                                                  </a>
                                                               </div>
                                                            
                                                               <div class="menu-item px-3">
                                                                  <a href="#" class="menu-link px-3">
                                                                        <?= PVIEW_MENU_3; ?>
                                                                  </a>
                                                               </div>
                                                               
                                                               <div class="menu-item px-3 my-1">
                                                                  <a href="#" class="menu-link px-3">
                                                                        <?= PVIEW_MENU_4; ?>
                                                                  </a>
                                                               </div>
                                                            </div>

                                                   </div>
                                             </div>
                                          </div>
                                          <div class="d-flex flex-wrap flex-stack">
                                             <div class="d-flex flex-column flex-grow-1 pe-8">
                                                   <div class="d-flex flex-wrap">
                                                      <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                         <div class="d-flex align-items-center">
                                                               <div class="fs-2 fw-bold counted"> <?= helperProjects::getSpacesQtd($projectId); ?> </div>
                                                         </div>
                                                         <div class="fw-semibold fs-6 text-gray-500">
                                                            <?= PVIEW_RESUME_1; ?> 
                                                         </div>
                                                      </div>

                                                      <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                         <div class="d-flex align-items-center">
                                                               <div class="fs-2 fw-bold counted"> <?= helperProjects::getTasksQtd($projectId); ?> </div>
                                                         </div>
                                                         <div class="fw-semibold fs-6 text-gray-500">
                                                            <?= PVIEW_RESUME_2; ?>
                                                         </div>
                                                      </div>
                                                    
                                                      <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                         <div class="d-flex align-items-center">
                                                               <div class="fs-2 fw-bold counted"> 
                                                                  <?= helperProjects::getDeliveryMessage($projectData['projectDeadline']); ?>
                                                               </div>
                                                         </div>
                                                        
                                                         <div class="fw-semibold fs-6 text-gray-500">
                                                            <?= PVIEW_RESUME_3; ?>
                                                         </div>
                                                      </div>

                                                   </div>
                                             </div>
                                             
                                             <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                                   <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                      <span class="fw-semibold fs-6 text-gray-500"> <?= PVIEW_RESUME_4; ?> </span>
                                                      <span class="fw-bold fs-6">
                                                         <?= helperProjects::getProjectProgress($projectId); ?> %
                                                      </span>
                                                   </div>

                                                   <div class="h-5px mx-3 w-100 bg-light mb-3">
                                                      <div class="bg-success rounded h-5px" role="progressbar" style="width: <?= helperProjects::getProjectProgress($projectId); ?>%;" aria-valuenow="<?= helperProjects::getProjectProgress($projectId); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                   </div>

                                             </div>
                                             <!--end::Progress-->
                                          </div>
                                          <!--end::Stats-->
                                       </div>
                                       <!--end::Info-->
                                 </div>
                              </div>
                           </div>
                          <!-- Resume -->


                          <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">

                              <div class="card-header cursor-pointer">
                                 <div class="card-title m-0">
                                       <h3 class="fw-bold m-0"> 
                                          <?= PVIEW_PROJECT_1; ?> </h3>
                                 </div>
                                 <?php if(Auth::getUsergroupByEmail($_SESSION['user']) === 'admin') { ?>
                                    <a href="projects-update.html?id=<?= $projectData['id'] ?? ''; ?>" class="btn btn-sm btn-primary align-self-center">
                                       <?= PVIEW_PROJECT_BTN1; ?>
                                    </a>
                                 <?php } ?>
                              </div>
                           
                              <div class="card-body p-9">
                                 <div class="row mb-7">
                                       <label class="col-lg-4 fw-semibold text-muted"> 
                                          <?= PVIEW_PROJECT_RESUME_1; ?> </label>
                                       
                                       <div class="col-lg-8">                    
                                          <span class="fw-bold fs-6 text-gray-800">
                                             <?= $projectData['title'] ?? ''; ?>
                                          </span>                
                                       </div>

                                 </div>
                              
                                 <div class="row mb-7">
                                       <label class="col-lg-4 fw-semibold text-muted"> 
                                          <?= PVIEW_PROJECT_RESUME_2; ?> </label>
                                       <div class="col-lg-8 fv-row">
                                          <span class="fw-semibold text-gray-800 fs-6">
                                             <?= $projectData['description'] ?? ''; ?>
                                          </span>                         
                                       </div>
                                 </div>
                              
                                 <div class="row mb-7">
                                       <label class="col-lg-4 fw-semibold text-muted">
                                          <?= PVIEW_PROJECT_RESUME_3; ?> </label>
                                       
                                       <div class="col-lg-8 d-flex align-items-center">
                                          <span class="fw-bold fs-6 text-gray-800 me-2">
                                             <?= Auth::getUserById($projectData['customerId']); ?>
                                          </span>                      
                                       </div>
                                 </div>
                              
                                 <div class="row mb-7">
                                       <label class="col-lg-4 fw-semibold text-muted"> 
                                          <?= PVIEW_PROJECT_RESUME_4; ?> </label>
                                       
                                       <div class="col-lg-8">
                                          <span class="fw-semibold text-gray-800 fs-6">
                                             <?= date('d/m/Y', $projectData['projectDeadline'] ?? time()); ?>  
                                          </span>               

                                       </div>
                                 </div>
                              
                                 <div class="row mb-7">
                                       <label class="col-lg-4 fw-semibold text-muted">
                                          <?= PVIEW_PROJECT_RESUME_5; ?>
                                       </label>
                                    
                                       <div class="col-lg-8">
                                          <span class="fw-bold fs-6 text-gray-800">
                                             <?= helperProjects::formatCurrentyToBRL($projectData['totalProjectCost'] ?? ''); ?>
                                          </span> 
                                       </div>
                                 </div>
                              
                                 <div class="row mb-7">
                                       <label class="col-lg-4 fw-semibold text-muted">
                                          <?= PVIEW_PROJECT_RESUME_6; ?>
                                       </label>
                                    
                                       <div class="col-lg-8">
                                          <span class="fw-bold fs-6 text-gray-800">
                                             <?= helperProjects::formatCurrentyToBRL($projectData['totalLaborCost'] ?? ''); ?> 
                                          </span>  
                                       </div>
                                 </div>
                              
                                 <div class="row mb-10">
                                       <label class="col-lg-4 fw-semibold text-muted"> 
                                          <?= PVIEW_PROJECT_RESUME_7; ?> </label>
                                    
                                       <div class="col-lg-8">
                                          <span class="fw-semibold fs-6 text-gray-800">
                                             <?= helperProjects::getPaymentMethod($projectData['paymentMethod'] ?? ''); ?> 
                                          </span> 
                                       </div>
                                 </div>

                                 <div class="row mb-10">
                                       <label class="col-lg-4 fw-semibold text-muted"> 
                                          <?= PVIEW_PROJECT_RESUME_8; ?> </label>
                                    
                                       <div class="col-lg-8">
                                          <span class="fw-semibold fs-6 text-gray-800">
                                             <?= $projectData['installments'] ?? ''; ?> 
                                          </span> 
                                       </div>
                                 </div>

                                 <div class="row mb-10">
                                       <label class="col-lg-4 fw-semibold text-muted"> 
                                          <?= PVIEW_PROJECT_RESUME_9; ?> </label>
                                    
                                       <div class="col-lg-8">
                                          <span class="fw-semibold fs-6 text-gray-800">
                                             <?= $projectData['profit'] ?? ''; ?>
                                          </span> 
                                       </div>
                                 </div>
                                 <!-- <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                    <i class="ki-duotone ki-information fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                 <div class="d-flex flex-stack flex-grow-1 ">
                                       <div class=" fw-semibold">
                                          <h4 class="text-gray-900 fw-bold">We need your attention!</h4>
                     
                                          <div class="fs-6 text-gray-700 ">Your payment was declined. To start using tools, please <a class="fw-bold" href="billing.html">Add Payment Method</a>.</div>
                                                      </div>
                                       </div>
                                 </div> -->
                              </div>
                           
                        </div>

                        <!-- Spaces -->
                        <div class="card mb-5 mb-xl-10">
                                 <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                    <div class="card-title m-0">
                                       <h3 class="fw-bold m-0"> 
                                          <?= PVIEW_SPACE_1; ?> </h3>
                                    </div>

                                    <?php if(Auth::getUsergroupByEmail($_SESSION['user']) === 'admin') { ?>
                                       <button type="button" class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                                          <?= PVIEW_SPACE_BTN_1; ?>
                                       </button>
                                    <?php } ?>
                                    
                                 </div>

                                 <div class="row p-5">
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr class="fw-bold fs-6 text-gray-800">
                                             <th> <?= PVIEW_SPACE_TB_1; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_2; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_3; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_4; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_5; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_6; ?> </th>
                                          </tr>
                                       </thead>
                                       <?php 
                                          $data = helperSpaces::getSpaceList($projectId);
                                          if (is_array($data) && !empty($data)): 
                                             foreach ($data as $item): 
                                       ?>
                                       <tbody>
                                          <tr>
                                             <td><?= $item['name']; ?></td>
                                             <td><?= helperProjects::getPriorityProject($item['priority']); ?></td>
                                             <td><?=Admin::formatDate($item['spaceDeadline']); ?></td>
                                             <td>
                                                <?= helperSpaces::getCountTasksBySpaceId($item['uuid']); ?>
                                             </td>
                                             <td><?= Admin::formatDateTime($item['created_at']); ?></td>
                                             <td> 
                                                <?php  if( Auth::getUsergroupByEmail($_SESSION['user']) === 'admin' ) { ?>
                                                   <button 
                                                      type="button" 
                                                      class="btn btn-sm btn-light-secondary" 
                                                      data-bs-toggle="modal"
                                                      data-space-id="<?= $item['uuid']; ?>"
                                                      data-space-title="<?= $item['name']; ?>"
                                                      data-bs-target="#kt_modal_4">
                                                      <?= PVIEW_SPACE_TXT3; ?>                                  
                                                   </button>
                                                   

                                                   <a href="space-edit.html?id=<?= $item['uuid']; ?>&projectId=<?= $projectId; ?>" 
                                                      class="btn btn-sm btn-light-primary"  
                                                      rel="noopener noreferrer">
                                                      <?= EDIT; ?> 
                                                   </a>

                                                   <span class="btn btn-sm btn-light-danger" data-remove-space="<?= $item['uuid']; ?>"> 
                                                      <?= REMOVE; ?> </span>
                                                <?php } ?>
                                             </td>
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

                                 </div>
                        </div>
                        <?php include('../components/custom/modal-project-components/modal-project-slot-add.inc.php'); // modal add space ?>
                        <?php include('../components/custom/modal-project-components/modal-tasks-filtered.inc.php'); // modal filtered tasks ?>

                        <div class="card mb-5 mb-xl-10">
                                 <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                    <div class="card-title m-0">
                                       <h3 class="fw-bold m-0"> <?= PVIEW_TASK_1; ?> </h3>
                                    </div>

                                    <?php if(Auth::getUsergroupByEmail($_SESSION['user']) === 'admin') { ?>
                                       <button type="button" class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#kt_modal_3">
                                          <?= PVIEW_TASK_BTN1; ?>
                                       </button>
                                    <?php } ?>
                                 </div>

                                 <div class="row p-5">
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr class="fw-bold fs-6 text-gray-800">
                                             <th> <?= PVIEW_TASK_TB_1; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_2; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_3; ?> </th>
                                             <th> <?= PVIEW_SPACE_TB_5; ?> </th>
                                             <th> <?= PVIEW_TASK_TB_3; ?> </th>
                                             <th> Status </th>
                                             <th> <?= PVIEW_SPACE_TB_6; ?> </th>
                                          </tr>
                                       </thead>
                                       <?php 
                                          $data = helperSpaces::getSpaceTasks($projectId);
                                          if (is_array($data) && !empty($data)): 
                                             foreach ($data as $item): 
                                       ?>
                                       <tbody>
                                          <tr>
                                             <td>
                                                <?= $item['name']; ?> <br/>
                                                <span class="text-muted"> 
                                                   <?= helperSpaces::getSpaceName($item['spaceId']); ?>
                                                <span> 
                                             </td>
                                             <td><?= helperProjects::getPriorityProject($item['priority']); ?></td>
                                             <td><?=Admin::formatDate($item['spaceDeadline']); ?></td>
                                             <td><?= Admin::formatDateTime($item['created_at']); ?></td>
                                             <td>
                                                <?= helperSupplier::getSupplierById($item['supplierId']); ?>
                                             </td>
                                             <td><?= helperProjects::getStatusProject($item['status']); ?></td>
                                             <td> 
                                                
                                                <a href="space-task-update.html?id=<?= $item['id']; ?>&projectId=<?= $projectId; ?>"
                                                   class="btn btn-sm btn-light-secondary"  
                                                   rel="noopener noreferrer">
                                                   <?= PVIEW_TASK; ?>
                                                </a>

                                                <?php 
                                                   if( Auth::getUsergroupByEmail($_SESSION['user']) === 'admin' ) {
                                                ?>
                                                   <a href="space-task-edit.html?id=<?= $item['id']; ?>&projectId=<?= $projectId; ?>" 
                                                      class="btn btn-sm btn-light-primary"  
                                                      rel="noopener noreferrer">
                                                      <?= EDIT; ?> 
                                                   </a>
                                                   <span class="btn btn-sm btn-light-danger" data-remove-task="<?= $item['id']; ?>"> <?= REMOVE; ?> </span>
                                                <?php } ?>
                                             </td>
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

                                 </div>
                        </div>
                        <?php include('../components/custom/modal-project-components/modal-project-task-add.inc.php'); ?>
                        <!-- Space Task -->
                        
                     </div>
                     
                     <?php include('../components/footer/footer.inc.php'); ?>
                     
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
         document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.btn[data-remove-space]').forEach(button => {
               button.addEventListener('click', function() {
                     const uuid = this.getAttribute('data-remove-space');
                     
                     fetch("/api/space-delete", {
                        method: "POST",
                        headers: {
                           "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                           uuid: uuid
                        })
                     })
                     .then(response => {
                        if (response.ok) {
                           return response.json();
                        } else {
                           throw new Error("Erro ao remover o espaço.");
                        }
                     })
                     .then(data => {
                        if (data.success) {
                           alert("Space removed successfully!");
                           location.reload(); 
                           this.closest('tr').remove();
                        } else {
                           alert("Erro: " + data.message);
                        }
                     })
                     .catch(error => {
                        console.error("Erro:", error);
                        alert("There was an error while removing the space.");
                     });
               });
            });

            document.querySelectorAll('.btn[data-remove-task]').forEach(button => {
               button.addEventListener('click', function() {
                     const id = this.getAttribute('data-remove-task');
                     
                     fetch("/api/space-task-delete", {
                        method: "POST",
                        headers: {
                           "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                           id: id
                        })
                     })
                     .then(response => {
                        if (response.ok) {
                           return response.json();
                        } else {
                           throw new Error("Erro ao remover o espaço.");
                        }
                     })
                     .then(data => {
                        if (data.success) {
                           alert("Space removed successfully!");
                           location.reload(); 
                           this.closest('tr').remove();
                        } else {
                           alert("Erro: " + data.message);
                        }
                     })
                     .catch(error => {
                        console.error("Erro:", error);
                        alert("There was an error while removing the space.");
                     });
               });
            });

            // space cookie
            const modal = document.getElementById('kt_modal_4');
            modal.addEventListener('show.bs.modal', function (event) {
               const button = event.relatedTarget;
               const spaceId = button.getAttribute('data-space-id');
               if (spaceId) {
                     localStorage.setItem('space_id', spaceId);
               }
            });

            

         });
      </script>

<script>
    $(document).ready(function() {
        $('#kt_modal_4').on('shown.bs.modal', function(event) {
            let spaceId = $(event.relatedTarget).data('space-id');
            let spaceName = $(event.relatedTarget).data('space-title');
            $('#space-id-display').text(spaceName);
            $('#loadTasks').load('modal-filtered-results.html?id=' + spaceId);
        });
    });
</script>

   </body>
</html>