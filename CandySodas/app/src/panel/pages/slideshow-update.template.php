<?php 
include(__DIR__ . '/../../config.inc.php'); 

global $CONFIG;
session_start();
Auth::loginSession();

$id = Security::inputSanitizer($_REQUEST['id']);
$userId = Auth::getUserData($_SESSION['user'], "id");
$name = Auth::getUserData($_SESSION['user'], "name");
$login = Auth::getUserData($_SESSION['user'], "email");
$currentLanguage = Auth::getUserData($_SESSION['user'], "language");

$saveSuccess = false;

if ($id) {
   $loadData = CMS::loadMetadaById($id);
}

if (!$loadData) {
   echo "Registro não encontrado ou erro ao carregar os dados.";
   exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $dataToSave = [
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'status' => $_POST['status'],
    'metadataType' => 'slideshow',
    'sliderType' => $_POST['sliderType'],
    'userId' => $userId,
    'createdAt' => date('Y-m-d H:i:s')
  ];

  if (CMS::updateSliderById($id, $dataToSave)) {
    $message = "Registro salvo com sucesso!";
    $success = true;
    header('Location: slideshow-update.html?id=' . $id);
    exit;
  } else {
    $message = "Erro ao salvar registro!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
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

   <body id="kt_body" 
      data-kt-app-header-stacked="true" 
      data-kt-app-header-primary-enabled="true" 
      data-kt-app-header-secondary-enabled="true" 
      data-kt-app-toolbar-enabled="true"  
      class="app-default" 
   >
      <script src="assets/js/sgix.js"></script>

      <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
         <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div id="kt_app_header" class="app-header">
               <?php include('../components/header/header.inc.php'); ?>
            </div>
            
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
               <div class="app-container container-xxl d-flex flex-row flex-column-fluid">
                  <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                     <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_toolbar" class="app-toolbar pt-lg-9 pt-6">
                           <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                              <div class="d-flex flex-stack flex-wrap gap-4 w-100">
                                 <div class="page-title d-flex flex-column gap-3 me-3">
                                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bolder fs-2x my-0">
                                       Slideshow Manager Update
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
                                         Slideshows                                            
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                          Update
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div id="kt_app_content" class="app-content pb-0">
                           <?php include('../components/my-account/resume.inc.php'); ?>
                           
                           <div class="card mb-5 mb-xl-10">
                              <div class="card-header border-0 cursor-pointer">
                                 <div class="card-title m-0">
                                    <h3 class="fw-bold m-0"> <?= CORE_DETAILS; ?> </h3>
                                 </div>

                                 <a href="slideshows.html" class="btn btn-sm btn-secondary align-self-center">
                                    Ver todos
                                 </a>
                              </div>

                              <div id="kt_account_settings_profile_details" class="collapse show">
                                 <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?id=<?= $id; ?>">
                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                    
                                    <div class="card-body border-top p-9">
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> <?= TABLE_TITLE; ?> </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="title" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="Slideshow Title" 
                                              required
                                              value="<?= $loadData['title']; ?>"
                                              />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Content </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <input 
                                                    type="text" 
                                                    name="content" 
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Slideshow content" 
                                                    value="<?= $loadData['content']; ?>"
                                                    />
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                      <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Slider Type </label>
                                          <div class="col-lg-8 fv-row">
                                             <select 
                                                name="sliderType" 
                                                data-placeholder="Select slideshow type..." 
                                                class="form-select form-select-solid form-select-lg"
                                              >
                                              <option value="slideshow" <?= CMS::isSelected('slideshow', $loadData['sliderType'] ?? ''); ?>> Image Slideshow </option>
                                              <option value="single" <?= CMS::isSelected('single', $loadData['sliderType'] ?? ''); ?>> Single Image </option>
                                                <option value="hero" <?= CMS::isSelected('hero', $loadData['sliderType'] ?? ''); ?>>  Hero </option>
                                                <option value="video" <?= CMS::isSelected('video', $loadData['sliderType'] ?? ''); ?>> Video </option>
                                             </select>
                                          </div>
                                      </div>

                                      <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Status </label>
                                          <div class="col-lg-8 fv-row">
                                             <select 
                                                name="status" 
                                                data-placeholder="Select category..." 
                                                class="form-select form-select-solid form-select-lg"
                                              >
                                                <option value="enabled" <?= CMS::isSelected('enabled', $loadData['status'] ?? ''); ?>>  <?= STATUS_ENABLED; ?> </option>
                                                <option value="disabled" <?= CMS::isSelected('disabled', $loadData['status'] ?? ''); ?>> <?= STATUS_DISABLED; ?> </option>
                                             </select>
                                          </div>
                                      </div>

                                      <div class="row mb-6" id="singleImage" style="display: none;">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Single Image </label>
                                          <div class="col-lg-8 fv-row">
                                                <input 
                                                   type="text" 
                                                   name="singleImageUrl" 
                                                   class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                   placeholder="Single image URL" 
                                                   value="<?= $loadData['singleImage']; ?>"
                                                />
                                          </div>
                                      </div>

                                      <div class="row mb-6" id="Video" style="display: none;">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Video </label>
                                          <div class="col-lg-8 fv-row">
                                                <input 
                                                   type="text" 
                                                   name="VideoUrl" 
                                                   class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                   placeholder="Video URL" 
                                                   value="<?= $loadData['VideoUrl']; ?>"
                                                />
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

     
   </body>
</html>