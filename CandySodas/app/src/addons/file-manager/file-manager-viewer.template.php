<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/config.inc.php'); 
global $CONFIG;
session_start();
Auth::loginSession();
Auth::hasAdmin();
Configurations::checkFeatureStatus('fmStatus');
$id = $_GET['id'];
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
      <link href="<?= $CONFIG['CONF']['adminCMS']; ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="<?= $CONFIG['CONF']['adminCMS']; ?>/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="<?= $CONFIG['CONF']['adminCMS']; ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="<?= $CONFIG['CONF']['adminCMS']; ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
      <link href="<?= $CONFIG['CONF']['adminCMS']; ?>/assets/css/custom.css" rel="stylesheet" type="text/css"/>
      <script>
         if (window.top != window.self) {
             window.top.location.replace(window.self.location.href);
         }
      </script>
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
               <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/header/header.inc.php'); ?>
            </div>

            <!-- File Manager -->
            <div 
              class="app-wrapper  flex-column flex-row-fluid " 
              id="kt_app_wrapper"
            >
               <div class="app-container  container-xxl d-flex flex-row flex-column-fluid ">
                  <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                     <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_toolbar" class="app-toolbar  pt-lg-9 pt-6 " 
                           >
                           <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack flex-wrap ">
                              <div class="d-flex flex-stack flex-wrap gap-4 w-100">
                                 <div class="page-title d-flex flex-column gap-3 me-3">
                                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bolder fs-2x my-0">
                                       File Manager Viewer
                                    </h1>
                                   
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                       <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                          <a href="../../index.html" class="text-gray-500 text-hover-primary">
                                          <i class="ki-duotone ki-home fs-3 text-gray-500 me-n1"></i>                                     
                                          </a>
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                      
                                       <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                                          <a href="file-manager.html"> File Manager </a>                                            
                                       </li>
                                      
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                      
                                       <li class="breadcrumb-item text-gray-500">
                                          File Viewer                    
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                       
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           <div class="card card-flush">
                              <div class="card-header pt-8">
                                 <div class="card-title">
                                    <div class="col-md-12"> <?= $_REQUEST['id']; ?>  </div> 
                                 </div>
                              </div>
                             
                              <div class="card-body">
                                <?= Cms::renderMediaById($id); ?>
                              </div>

                              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                           </div>
                           
                        </div>
                     </div>
                     
                     <?php include($_SERVER['DOCUMENT_ROOT'].'/panel/components/footer/footer.inc.php'); ?>

                  </div>
               </div>
            </div>
         </div>
      </div>
     
      <?php include($_SERVER['DOCUMENT_ROOT'].'/panel/components/customize/container.inc.php'); ?>
      <?php include($_SERVER['DOCUMENT_ROOT'].'/panel/components/customize/button.inc.php'); ?>
      <?php include($_SERVER['DOCUMENT_ROOT'].'/panel/components/floatButtons/float.inc.php'); ?>
      <?php include($_SERVER['DOCUMENT_ROOT'].'/panel/components/modals/projects/projects.inc.php'); ?>
      <?php include($_SERVER['DOCUMENT_ROOT'].'/panel/components/modals/invite/invite.inc.php'); ?>

      <script src="assets/plugins/global/plugins.bundle.js"></script>
      <script src="assets/js/scripts.bundle.js"></script>
      <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
      <script src="assets/js/custom/apps/file-manager/list.js"></script>
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
      <script src="assets/js/custom/utilities/modals/users-search.js"></script>

   </body>
</html>
