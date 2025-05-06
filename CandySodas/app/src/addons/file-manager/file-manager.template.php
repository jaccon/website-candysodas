<?php 
include(__DIR__ . '/../../config.inc.php'); 
global $CONFIG;
session_start();
Auth::loginSession();
Auth::hasAdmin();
Configurations::checkFeatureStatus('fmStatus');
$addToMenu = "true";
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
               <?php include($_SERVER['DOCUMENT_ROOT'] . '/panel/components/header/header.inc.php'); ?>
            </div>

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
                                       File Manager
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
                                          Add-Ons                                            
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                          File Manager                    
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                       
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           <div 
                              class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10" 
                              style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('../../assets/media/illustrations/sketchy-1/4.png')">
                              <div class="card-header pt-10">
                                 <div class="d-flex align-items-center">
                                    <div class="symbol symbol-circle me-5">
                                       <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                                          <i class="ki-duotone ki-abstract-47 fs-2x text-primary"><span class="path1"></span><span class="path2"></span></i>                
                                       </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                       <h2 class="mb-1">Storage Status </h2>
                                       <div class="text-muted fw-bold">
                                          <span class="mx-3"> Uploaded Static Content Usage: </span> <?= Cms::getDirectorySize($CONFIG['CONF']['uploadDir']); ?>
                                          <span class="mx-3">|</span> 
                                          Database Usage: <?= Cms::getDirectorySize($CONFIG['CONF']['cacheDir']); ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-body pb-0">
                              </div>
                           </div>
                          
                           <div class="card card-flush">
                              <div class="card-header pt-8">
                                 <div class="card-title">
                                    Manage your files and folders
                                 </div>
                                 <div class="card-toolbar">
                                    <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">

                                       <?php
                                          if($_REQUEST['dir'] === '') {
                                       ?>
                                       <button 
                                          type="button" 
                                          class="btn btn-flex btn-light-primary me-3" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#kt_modal_newfolder">
                                          <i class="ki-duotone ki-add-folder fs-2">
                                             <span class="path1"></span>
                                             <span class="path2"></span>
                                          </i>      
                                          New Folder
                                       </button>
                                       <?php } ?>

                                       <button 
                                          type="button" 
                                          class="btn btn-flex btn-primary" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#kt_modal_upload">
                                          <i class="ki-duotone ki-folder-up fs-2">
                                             <span class="path1"></span>
                                             <span class="path2"></span>
                                          </i>        
                                          Upload Files
                                       </button>
                                    </div>
                                 </div>
                              </div>
                             
                              <div class="card-body">
                                 <div id="loader" style="display: none; text-align: center; padding: 20px;">
                                    <div class="spinner-border text-primary" role="status">
                                          <span class="visually-hidden">Carregando...</span>
                                    </div>
                                 </div>
                                <div id="static-folders"></div>
                              </div>

                              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                              <script>
                                  $(document).ready(function() {
                                    function loadFolder(dir = '') {
                                       let url = '/panel/file-manager/file-manager-folder-list.html';
                                       if (dir) {
                                             url += '?dir=' + encodeURIComponent(dir);
                                       }

                                       console.log("Loading:", url);

                                       $('#loader').show();
                                       $('#static-folders').hide();

                                       $('#static-folders').load(url, function(response, status, xhr) {
                                             $('#loader').hide(); // Esconde o loader após o carregamento
                                             $('#static-folders').show(); // Exibe o conteúdo carregado

                                             if (status === "error") {
                                                console.error("Erro ao carregar o arquivo:", xhr.status, xhr.statusText);
                                             } else {
                                                console.log("Conteúdo carregado com sucesso!");
                                                let newUrl = window.location.pathname + (dir ? '?dir=' + encodeURIComponent(dir) : '');
                                                window.history.pushState({ path: newUrl }, '', newUrl);
                                             }
                                       });
                                    }

                                    let initialDir = new URLSearchParams(window.location.search).get('dir') || '';
                                    loadFolder(initialDir);

                                    $(document).on('click', 'a.folder-link', function(event) {
                                       event.preventDefault(); 
                                       let dir = $(this).attr('data-dir'); 

                                       if (dir !== undefined) {
                                             loadFolder(dir); 
                                       } else {
                                             console.error("Erro: Diretório não encontrado no link.");
                                       }
                                    });

                                    window.onpopstate = function(event) {
                                       let currentDir = new URLSearchParams(window.location.search).get('dir') || '';
                                       loadFolder(currentDir);
                                    };
                                 });

                                  </script>

                           </div>
                           
                           <table class="d-none">
                              <tr id="kt_file_manager_new_folder_row" data-kt-filemanager-template="upload">
                                 <td></td>
                                 <td id="kt_file_manager_add_folder_form" class="fv-row">
                                    <div class="d-flex align-items-center">
                                       <span id="kt_file_manager_folder_icon"><i class="ki-duotone ki-folder fs-2x text-primary me-4"><span class="path1"></span><span class="path2"></span></i></span>
                                       <input type="text" name="new_folder_name" placeholder="Enter the folder name" class="form-control mw-250px me-3" />
                                       <button class="btn btn-icon btn-light-primary me-3" id="kt_file_manager_add_folder">
                                       <span class="indicator-label">
                                        <i class="ki-duotone ki-check fs-1"></i>                    
                                       </span>
                                       <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                                       </button>
                                       <button class="btn btn-icon btn-light-danger" id="kt_file_manager_cancel_folder">
                                       <span class="indicator-label">
                                       <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>                    </span>
                                       <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                                       </button>
                                    </div>
                                 </td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                           </table>
                          
                           <div class="d-none" data-kt-filemanager-template="rename">
                              <div class="fv-row">
                                 <div class="d-flex align-items-center">
                                    <span id="kt_file_manager_rename_folder_icon"></span>
                                    <input type="text" id="kt_file_manager_rename_input" name="rename_folder_name" placeholder="Enter the new folder name" class="form-control mw-250px me-3" value="" />
                                    <button class="btn btn-icon btn-light-primary me-3" id="kt_file_manager_rename_folder">
                                    <i class="ki-duotone ki-check fs-1"></i>            </button>
                                    <button class="btn btn-icon btn-light-danger" id="kt_file_manager_rename_folder_cancel">
                                    <span class="indicator-label">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>                </span>
                                    <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle"></span></span>
                                    </button>
                                 </div>
                              </div>
                           </div>
                          
                           <div class="d-none" data-kt-filemanager-template="action">
                              <div class="d-flex justify-content-end">
                                 <div class="ms-2" data-kt-filemanger-table="copy_link">
                                    <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-fasten fs-5 m-0"><span class="path1"></span><span class="path2"></span></i>            </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px" data-kt-menu="true">
                                       <div class="card card-flush">
                                          <div class="card-body p-5">
                                             <div class="d-flex" data-kt-filemanger-table="copy_link_generator">
                                                <div class="me-5" data-kt-indicator="on">
                                                   <span class="indicator-progress">
                                                   <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                   </span>
                                                </div>
                                                <div class="fs-6 text-gray-900">Generating Share Link...</div>
                                             </div>
                                             <div class="d-flex flex-column text-start d-none" data-kt-filemanger-table="copy_link_result">
                                                <div class="d-flex mb-3">
                                                   <i class="ki-duotone ki-check fs-2 text-success me-3"></i>                    
                                                   <div class="fs-6 text-gray-900">Share Link Generated</div>
                                                </div>
                                                <input type="text" class="form-control form-control-sm" value="https://path/to/file/or/folder/" />
                                                <div class="text-muted fw-normal mt-2 fs-8 px-3">Read only. <a href="settings/.html" class="ms-2">Change permissions</a></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          
                           <div class="d-none" data-kt-filemanager-template="checkbox">
                              <div class="form-check form-check-sm form-check-custom form-check-solid"><input class="form-check-input" type="checkbox" value="1" /></div>
                           </div>
                          
                           <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/modals/uploads/upload.inc.php'); ?>
                           <?php include($_SERVER['DOCUMENT_ROOT'].'/panel/components/modals/uploads/newFolder.inc.php'); ?>
                        </div>
                     </div>
                     
                     <?php include($_SERVER['DOCUMENT_ROOT'] .'/panel/components/footer/footer.inc.php'); ?>

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
