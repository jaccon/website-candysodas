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
        'spaceDeadline' => Security::inputSanitizer($_POST['spaceDeadline']),
        'priority' => Security::inputSanitizer($_POST['priority']),
        'status' => Security::inputSanitizer($_POST['status']),
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    $updateResult = helperSpacesUpdate::updateSpaceById($spaceId, $dataToUpdate);
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
                                       Edit Space
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
                                          Edit Space            
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
                                    <h3 class="fw-bold m-0"> Space Details </h3>
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
                                          <span class="required"> <?= PVIEW_FORM_NAME; ?> </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="<?= MYACCOUNT_08; ?>" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="name" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="<?= PVIEW_FORM_NAME_LABEL; ?>" 
                                              value="<?= helperSpaces::getSpaceById($spaceId,'name'); ?>" />
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
                                                    placeholder="<?= MYACCOUNT_09; // Form ?>" 
                                                    value="<?= helperSpaces::getSpaceById($spaceId,'description'); ?>" />
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       
                                       

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> <?= PVIEW_SPACE_TB_3; ?> </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Phone number must be active" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="date" 
                                              name="spaceDeadline" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="<?= PVIEW_SPACE_TB_3; ?>" 
                                              value="<?= helperSpaces::getSpaceById($spaceId,'spaceDeadline'); ?>" />
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> <?= PVIEW_SPACE_TB_2; ?>  </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Phone number must be active" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                          <select 
                                            name="priority" 
                                            data-placeholder="<?= PVIEW_SPACE_TB_2; ?>..." 
                                            class="form-select form-select-solid form-select-lg"
                                            >
                                              <?php $priority = helperSpaces::getSpaceById($spaceId,'priority'); ?>
                                              <option value="high" <?= CMS::isSelected('high', $priority); ?>> <?= PVIEW_FORM_PRIORITY_1; ?> </option>
                                              <option value="medium" <?= CMS::isSelected('medium', $priority); ?>> <?= PVIEW_FORM_PRIORITY_2; ?> </option>
                                              <option value="low" <?= CMS::isSelected('low', $priority); ?>> <?= PVIEW_FORM_PRIORITY_3; ?> </option>
                                              <option value="urgent" <?= CMS::isSelected('urgent', $priority); ?>> <?= PVIEW_FORM_PRIORITY_4; ?> </option>
                                              <option value="critical" <?= CMS::isSelected('critical', $priority); ?>> <?= PVIEW_FORM_PRIORITY_5; ?> </option>
                                          </select>

                                          <div class="form-text">
                                              <?= PVIEW_FORM_PRIORITY_TXT; ?>
                                          </div>

                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Status </label>
                                          
                                          <div class="col-lg-8 fv-row">
                                            <select 
                                                name="status" 
                                                data-placeholder="Select status..." 
                                                class="form-select form-select-solid form-select-lg"
                                            >
                                              <?php $status = helperSpaces::getSpaceById($spaceId,'status'); ?>
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
                                       
                                    </div>
                                    
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                       <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"> <?= BUTTON_SUBMIT_01; ?> </button>
                                    </div>
                                    
                                 </form>
                              </div>
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
                  location.reload(); // Recarrega a página
            });
         }
      </script>

   </body>
</html>