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
                                       Login History    
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
                                          Login History                                           
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                          <?= MYACCOUNT_03; ?>            
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>
                           
                           <div class="card mb-5 mb-xl-10">
                              <div id="kt_account_settings_profile_details" class="collapse show"> 
                              <div class="card-body">
                          <div class="tab-content">
                              <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="kt_activity_today_tab">

                              <?php 
                                 $data = Auth::getUserLoginHistory($userId); 
                              ?>

                              <?php if (empty($data)): ?>
                                 <div class="text-muted">No actions found </div>
                              <?php else: ?>
                                 <?php foreach ($data as $action): ?>
                                    <div class="timeline timeline-border-dashed">
                                                <div class="timeline-item">
                                                   <div class="timeline-line"></div>
                                                   <div class="timeline-icon me-4">
                                                         <i class="ki-duotone ki-flag fs-2 text-gray-500">
                                                            <span class="path1"></span><span class="path2"></span>
                                                         </i>
                                                   </div>
                                                   <div class="timeline-content mb-10 mt-n2">
                                                         <div class="overflow-auto pe-3">
                                                            <div class="fs-5 fw-semibold mb-2">
                                                               <?= $action['action'] // Capitalizar a ação ?>
                                                            </div>
                                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                               <div class="text-muted me-2 fs-7">
                                                                     <?= date('d/m/Y H:i', strtotime($action['created'])) ?> - IP: <?= htmlspecialchars($action['ip_address']) ?>
                                                               </div>
                                                            </div>
                                                         </div>
                                                   </div>
                                                </div>
                                    </div>
                                 <?php endforeach; ?>
                              <?php endif; ?>
                              


<div class="timeline-item">
    <div class="timeline-line">
      
    </div>
</div>
</div>
           </div>
            
      </div>
    </div>
    <!-- END -->
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