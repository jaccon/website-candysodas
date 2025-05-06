<?php
include(__DIR__ . '/../../config.inc.php');

global $CONFIG;
session_start();
Auth::loginSession();
Configurations::checkFeatureStatus('omStatus');

$message = '';
$success = false;

$projectId = $_GET['id'] ?? null;
$projectData = null;

if ($projectId) {
    $projectData = helperForms::getFormById($projectId);
}

if (!$projectData) {
    echo "Formulário não encontrado ou erro ao carregar os dados.";
    exit;
}

$campaign = $projectData['campaign'] ?? '';
$replyTo = $projectData['replyTo'] ?? '';
$status = $projectData['status'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $projectDeadlineInput = $_POST['projectDeadline'];
    $projectDeadlineTimestamp = strtotime($projectDeadlineInput);

    $updatedData = [
        'campaign' => $_POST['campaign'],
        'replyTo' => $_POST['replyTo'],
        'replyToName' => $_POST['replyToName'],
        'message' => $_POST['message'],
        'subject' => $_POST['subject'],
        'status' => $_POST['status'],
        'updatedAt' => date('Y-m-d H:i:s')
    ];

    helperForms::updateFormById($projectId, $updatedData);
    Auth::logUserAction(Auth::getUserData($_SESSION['user'], "id"),'update_form:'.$projectId);
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
                                       <?= $projectData['title'] ?? ''; ?>
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
                                          <?= PRJ_01; ?>                                             
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                          <?= PRJ_UP_01; ?>     
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>
                           
                           <div class="card mb-5 mb-xl-10">
                              
                              <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                 <div class="card-title m-0">
                                    <h3 class="fw-bold m-0"> <?= PRJ_ADD_03; ?> </h3>
                                 </div>
                              </div>
                              
                              <div id="kt_account_settings_profile_details" class="collapse show">
                                 
                                 <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?id=<?= $projectId; ?>&success=true">
                                    
                                    <div class="card-body border-top p-9">
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Campaign </span>
                                            <span class="ms-1"  data-bs-toggle="tooltip" title="Campaign" >
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span>
                                            <span class="path2"></span><span class="path3"></span></i></span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="campaign" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="campaign" 
                                              value="<?= $projectData['campaign'] ?? ''; ?>" />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Subject </span>
                                            <span class="ms-1"  data-bs-toggle="tooltip" title="Subject" >
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span>
                                            <span class="path2"></span><span class="path3"></span></i></span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                              <textarea 
                                                id="message" 
                                                class="form-control form-control-lg form-control-solid" 
                                                name="message"><?= $projectData['message'] ?? ''; ?></textarea>
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Message </span>
                                            <span class="ms-1"  data-bs-toggle="tooltip" title="Subject" >
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span>
                                            <span class="path2"></span><span class="path3"></span></i></span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="subject" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="subject" 
                                              value="<?= $projectData['subject'] ?? ''; ?>" />
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Reply To Name </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <input 
                                                    type="text" 
                                                    name="replyToName" 
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="replyToName" 
                                                    value="<?= $projectData['replyToName'] ?? ''; ?>" />
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Reply To </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <input 
                                                    type="text" 
                                                    name="replyTo" 
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="replyTo" 
                                                    value="<?= $projectData['replyTo'] ?? ''; ?>" />
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Status </label>
                                          
                                          <div class="col-lg-8 fv-row">
                                             <select 
                                                name="status" 
                                                data-placeholder="Select project status..." 
                                                class="form-select form-select-solid form-select-lg"
                                              >
                                                <option value="enabled" <?= CMS::isSelected('enabled', $status ?? ''); ?> > Enabled </option>
                                                <option value="disabled" <?= CMS::isSelected('disabled', $status ?? ''); ?> > Disabled  </option>
                                                <option value="onhold" <?= CMS::isSelected('onhold', $status ?? ''); ?> > On-Hold </option>
                                             </select>
                                             <div class="form-text">
                                                <?= PRJ_UP_03; ?> 
                                             </div>
                                          </div>
                                       </div>
                                       
                                    </div>
                                    
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                       <button type="reset" class="btn btn-light btn-active-light-primary me-2"> <?= BUTTON_DISCARD_01; ?> </button>
                                       <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"> <?= BUTTON_SUBMIT_01; ?> </button>
                                    </div>
                                    
                                 </form>
                              </div>
                           </div>

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
      <?php //include('../components/custom/modal-project-slot-add/modal-project-slot-add.inc.php'); ?>
      
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

      <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.js"></script>
      
      <script>
          $(document).ready(function() {
            $('#message').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        var data = new FormData();
                        data.append('file', files[0]);
                        $.ajax({
                            url: '/upload-image',
                            type: 'POST',
                            data: data,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                var imagePath = response.path;
                                $('#message').summernote('insertImage', imagePath);
                            },
                            error: function() {
                                alert('Erro ao enviar a imagem');
                            }
                        });
                    }
                }
            });
          });
       </script>

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
               const updatedUrl = url.toString();
               window.history.replaceState({}, document.title, updatedUrl);
               location.reload(); // Isso recarrega a página para refletir a URL atualizada
            });
         }

      </script>
   </body>
</html>