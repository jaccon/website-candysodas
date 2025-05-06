<?php 
include(__DIR__ . '/../../config.inc.php'); 

global $CONFIG;
session_start();
Auth::loginSession();

$message = '';
$success = false;

$registerId = "423cf0ca-6e66-11ef-b864-0242ac120002";
$pubId = $_GET['pubId'] ?? null;
$projectData = null;

if ($registerId) {
    $loadData = CMS::loadSiteConfiguration($registerId);
}

if (!$loadData) {
    echo "Registro não encontrado ou erro ao carregar os dados.";
    exit;
}

$userId = Auth::getUserData($_SESSION['user'], "id");
$usergroup = Auth::getUserData($_SESSION['user'], "usergroup");
$name = Auth::getUserData($_SESSION['user'], "name");
$login = Auth::getUserData($_SESSION['user'], "email");
$document = Auth::getUserData($_SESSION['user'], "document");
$phone = Auth::getUserData($_SESSION['user'], "phone");
$language = Auth::getUserData($_SESSION['user'], "language");
$avatar = Auth::getUserData($_SESSION['user'], "avatar");
$thumbnail = Auth::getAvatar($avatar);

$saveSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uploadDirBase = $CONFIG['CONF']['uploadDir'];
    $todayDirectory = date('Y-m-d');
    $uploadDir = $uploadDirBase ."/". $todayDirectory . '/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadedFilesData = [];

    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['files']['name'] as $key => $filename) {
            if ($_FILES['files']['error'][$key] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['files']['tmp_name'][$key];
                $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

                $newFilename = uniqid() . '-' . bin2hex(random_bytes(4)) . ($fileExtension ? '.' . $fileExtension : '');
                $targetFilePath = $uploadDir . $newFilename;

                if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                    $uploadedFilesData[] = [
                        'fileName' => $filename,
                        'directory' => $uploadDir,
                        'originalDirectory' => $todayDirectory,
                        'uploadPath' => $newFilename,
                    ];
                }
            }
        }
    }

    if (empty($uploadedFilesData)) {
        $uploadedFilesData = $loadData['uploadFiles'] ?? [];
    }

    $jsonFilePath = $CONFIG['CONF']['cacheDir'] . '/siteconfigurations.cms.json';

    if (!file_exists($jsonFilePath)) {
        file_put_contents($jsonFilePath, json_encode([], JSON_PRETTY_PRINT));
    }

    $jsonData = file_get_contents($jsonFilePath);
    $comments = json_decode($jsonData, true) ?: [];

    $dataToSave = [
        'defaultPageTitle' => $_POST['defaultPageTitle'] ?? '',
        'loginPageMessage' => $_POST['loginPageMessage'] ?? '',
         'siteUrl' => $_POST['siteurl'] ?? '',
         'keywords' => $_POST['keywords'] ?? '',
         'robots' => $_POST['robots'] ?? '',
         'author' => $_POST['author'] ?? '',
         'favicon' => $_POST['favicon'] ?? '',
         'description' => $_POST['description'] ?? '',
         'email_default' => $_POST['email_default'] ?? '',
         'content' => $_POST['content'] ?? '',
         'contractId' => $_POST['contractId'] ?? '',
         'userId' => $_POST['userId'] ?? '',
         'whatsappnumber' => $_POST['whatsappnumber'] ?? '',
         'whatsappWidget' => $_POST['whatsappWidget'] ?? '',
         'consentWidget' => $_POST['consentWidget'] ?? '',
         'consentWidgetMessage' => $_POST['consentWidgetMessage'] ?? '',
         'thumbOpenGraph' => $_POST['thumbOpenGraph'] ?? '',
         'social_facebook' => $_POST['social_facebook'] ?? '',
         'social_instagram' => $_POST['social_instagram'] ?? '',
         'social_youtube' => $_POST['social_youtube'] ?? '',
         'social_linkedin' => $_POST['social_linkedin'] ?? '',
         'social_twitter' => $_POST['social_twitter'] ?? '',
         'pagesStatus' => $_POST['pagesStatus'] ?? '',
         'postStatus' => $_POST['postStatus'] ?? '',
         'fmStatus' => $_POST['fmStatus'] ?? '',
         'addOnStatus' => $_POST['addOnStatus'] ?? '',
         'resetPasswordStatus' => $_POST['resetPasswordStatus'] ?? '',
         'regUserStatus' => $_POST['regUserStatus'] ?? '',
         'omStatus' => $_POST['omStatus'] ?? '',
         'ecomStatus' => $_POST['ecomStatus'] ?? '',
         'customStatus' => $_POST['customStatus'] ?? '',
         'status' => $_POST['status'] ?? '',
         'updatedAt' => date('Y-m-d H:i:s'),
    ];

    if (CMS::siteConfigurationUpdates($dataToSave)) {
        $message = "Registro salvo com sucesso!";
        $success = true;
    } else {
        $message = "Erro ao salvar registro!";
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

      <style>
        img.image-list {
            margin: 10px 0;
            border: 2px #fff dotted;
        }
      </style>
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
                                       Site Configuration
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
                                          Site Configuration                                            
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
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>
                           
                           <div class="card mb-5 mb-xl-10">
                              <div class="card-header border-0 cursor-pointer" role="button">
                                 <div class="card-title m-0">
                                    <h3 class="fw-bold m-0"> <?= CORE_DETAILS; ?> </h3>
                                 </div>
                              </div>
                              
                              <div id="kt_account_settings_profile_details" class="collapse show">

                                 <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?mId=<?= $registerId; ?>&pubId=<?= $_REQUEST['pubId'];?>&success=true">
                                    
                                    <div class="card-body border-top p-9">

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_job_1_1">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                Default Site Settings                         
                                             </h4>
                                       </div>
                                     
                                       <div id="kt_job_1_1" class="collapse fs-6 ms-1">
                                             <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <!--  form -->
                                                <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Default Site Title </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="defaultPageTitle" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="defaultPageTitle" 
                                              value="<?= $loadData['defaultPageTitle']; ?>"
                                              require
                                              />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> E-mail Default </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="email_default" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="email_default" 
                                              value="<?= $loadData['email_default']; ?>"
                                              require
                                              />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Site Url </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="siteurl" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="siteUrl" 
                                              value="<?= $loadData['siteUrl']; ?>"
                                              require
                                              />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Author </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="author" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="author" 
                                              value="<?= $loadData['author']; ?>"
                                              require
                                              />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Favicon ( url ) </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="favicon" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="favicon" 
                                              value="<?= $loadData['favicon']; ?>"
                                              require
                                              />
                                          </div>
                                       </div>

                                       

                                                <!--  form -->
                                             </div>
                                       </div>                
                                       <div class="separator separator-dashed"></div>
                                    </div>

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#login-page">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                Login Page                         
                                             </h4>
                                       </div>
                                     
                                       <div id="login-page" class="collapse fs-6 ms-1">
                                             <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                <!--  form -->
                                                <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Login Page Message </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="loginPageMessage" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="Dashboard Login Page Message" 
                                              value="<?= $loadData['loginPageMessage']; ?>"
                                              require
                                              />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> Register User Page </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="regUserStatus" 
                                                                     name="regUserStatus"
                                                                     <?= CMS::isChecked('1', $loadData['regUserStatus'] ?? ''); ?>
                                                                  >
                                                            </div>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> Reset Password Page </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="resetPasswordStatus" 
                                                                     name="resetPasswordStatus"
                                                                     <?= CMS::isChecked('1', $loadData['resetPasswordStatus'] ?? ''); ?>
                                                                  >
                                                            </div>
                                                         </div>
                                                   </div>

                                                <!--  form -->
                                             </div>
                                       </div>                
                                       <div class="separator separator-dashed"></div>
                                    </div>

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_2">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                Credentials and APIs                                
                                             </h4>
                                       </div>
                                      
                                       <div id="kt_job_1_2" class="collapse  fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                   <!--  form -->
                                                   <div class="row mb-6">
                                                      <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                         <span class="required"> Contract Id ( SGIX Premium Contract ) </span>
                                                      </label>
                                                      <div class="col-lg-8 fv-row">
                                                         <input 
                                                         type="text" 
                                                         name="contractId" 
                                                         class="form-control form-control-lg form-control-solid" 
                                                         placeholder="contractId" 
                                                         value="<?= $loadData['contractId']; ?>"
                                                         require
                                                         />
                                                      </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                      <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                         <span class="required"> User Id ( SGIX Premium User Id ) </span>
                                                      </label>
                                                      <div class="col-lg-8 fv-row">
                                                         <input 
                                                         type="text" 
                                                         name="userId" 
                                                         class="form-control form-control-lg form-control-solid" 
                                                         placeholder="userId" 
                                                         value="<?= $loadData['userId']; ?>"
                                                         require
                                                         />
                                                      </div>
                                                   </div>


                                                   <!--  form -->
                                                </div>
                                          </div>                
                                       
                                       <div class="separator separator-dashed"></div>
                                    </div>

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_whatsapp">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                Whatsapp Integration                               
                                             </h4>
                                       </div>
                                      
                                       <div id="kt_job_1_whatsapp" class="collapse  fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                   <!--  form -->

                                                   <div class="row mb-6">
                                                      <label class="col-lg-4 col-form-label required fw-semibold fs-6"> 
                                                         Whatsapp Number </label>
                                                      <div class="col-lg-8">
                                                         <div class="row">
                                                            <div class="col-lg-12 fv-row">
                                                            <input 
                                                               type="text" 
                                                               name="whatsappnumber" 
                                                               class="form-control form-control-lg form-control-solid" 
                                                               placeholder="whatsappnumber" 
                                                               value="<?= $loadData['whatsappnumber']; ?>"
                                                               require
                                                               />
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Whatsapp Widget Status </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <select 
                                                               name="whatsappWidget" 
                                                               data-placeholder="Select status..." 
                                                               class="form-select form-select-solid form-select-lg"
                                                            >
                                                               <option value="enabled" <?= CMS::isSelected('enabled', $loadData['whatsappWidget'] ?? ''); ?> >  <?= STATUS_ENABLED; ?> </option>
                                                               <option value="disabled" <?= CMS::isSelected('disabled', $loadData['whatsappWidget'] ?? ''); ?> > <?= STATUS_DISABLED; ?> </option>
                                                            </select>
                                                            <span class="text-muted fs-6"> Control Whatsapp Widget Button Status enable/disable </span>
                                                         </div>
                                                   </div>

                                                   <!--  form -->
                                                </div>
                                          </div>                
                                       
                                       <div class="separator separator-dashed"></div>
                                    </div>

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_consentiment">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                Contentiment Cookies                               
                                             </h4>
                                       </div>
                                      
                                          <div id="kt_job_1_consentiment" class="collapse  fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                   <!--  form -->

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Consentiment Cookies Bar </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <select 
                                                               name="consentWidget" 
                                                               data-placeholder="Select status..." 
                                                               class="form-select form-select-solid form-select-lg"
                                                            >
                                                               <option value="enabled" <?= CMS::isSelected('enabled', $loadData['consentWidget'] ?? ''); ?> >  <?= STATUS_ENABLED; ?> </option>
                                                               <option value="disabled" <?= CMS::isSelected('disabled', $loadData['consentWidget'] ?? ''); ?> > <?= STATUS_DISABLED; ?> </option>
                                                            </select>
                                                            <span class="text-muted fs-6"> LGPD messages control to consentiment </span>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Consentiment Cookies Bar Message </label>
                                                         <div class="col-lg-8 fv-row mb-6">
                                                            <input 
                                                                  type="text" 
                                                                  name="consentWidgetMessage" 
                                                                  class="form-control form-control-lg form-control-solid" 
                                                                  placeholder="consentWidgetMessage" 
                                                                  value="<?= $loadData['consentWidgetMessage']; ?>"
                                                                  require
                                                            />
                                                         </div>
                                                   </div>

                                                   <!--  form -->
                                                </div>
                                          </div>                
                                       
                                       <div class="separator separator-dashed"></div>
                                    </div>

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_social">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                Social Media Settings                             
                                             </h4>
                                       </div>
                                      
                                          <div id="kt_job_1_social" class="collapse  fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                   <!--  form -->

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Open Graph Thumbnail ( Url ) </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <input 
                                                               type="text" 
                                                               name="thumbOpenGraph" 
                                                               class="form-control form-control-lg form-control-solid" 
                                                               placeholder="thumbOpenGraph" 
                                                               value="<?= $loadData['thumbOpenGraph']; ?>"
                                                               require
                                                            />
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Facebook Profile </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <input 
                                                               type="text" 
                                                               name="social_facebook" 
                                                               class="form-control form-control-lg form-control-solid" 
                                                               placeholder="social_facebook" 
                                                               value="<?= $loadData['social_facebook']; ?>"
                                                               require
                                                            />
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Instagram Profile </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <input 
                                                               type="text" 
                                                               name="social_instagram" 
                                                               class="form-control form-control-lg form-control-solid" 
                                                               placeholder="social_instagram" 
                                                               value="<?= $loadData['social_instagram']; ?>"
                                                               require
                                                            />
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Youtube Profile </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <input 
                                                               type="text" 
                                                               name="social_youtube" 
                                                               class="form-control form-control-lg form-control-solid" 
                                                               placeholder="social_youtube" 
                                                               value="<?= $loadData['social_youtube']; ?>"
                                                               require
                                                            />
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Linkedin Profile </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <input 
                                                               type="text" 
                                                               name="social_linkedin" 
                                                               class="form-control form-control-lg form-control-solid" 
                                                               placeholder="social_linkedin" 
                                                               value="<?= $loadData['social_linkedin']; ?>"
                                                               require
                                                            />
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Twitter X Profile </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <input 
                                                               type="text" 
                                                               name="social_twitter" 
                                                               class="form-control form-control-lg form-control-solid mb-6" 
                                                               placeholder="social_twitter" 
                                                               value="<?= $loadData['social_twitter']; ?>"
                                                               require
                                                            />
                                                         </div>
                                                   </div>

                                                   <!--  form -->
                                                </div>
                                          </div>                
                                       
                                       <div class="separator separator-dashed"></div>
                                    </div>

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_feature">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                Feature Flags                               
                                             </h4>
                                       </div>
                                      
                                          <div id="kt_job_1_feature" class="collapse  fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                   <!--  form -->

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> Add-Ons </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="addOnStatus" 
                                                                     name="addOnStatus"
                                                                     <?= CMS::isChecked('1', $loadData['addOnStatus'] ?? ''); ?> 
                                                                  >
                                                                     <!-- checked="checked" -->
                                                            </div>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> Posts </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="postStatus" 
                                                                     name="postStatus"
                                                                     <?= CMS::isChecked('1', $loadData['postStatus'] ?? ''); ?> 
                                                                  >
                                                                     <!-- checked="checked" -->
                                                            </div>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> Pages </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="pagesStatus" 
                                                                     name="pagesStatus"
                                                                     <?= CMS::isChecked('1', $loadData['pagesStatus'] ?? ''); ?> 
                                                                  >
                                                            </div>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> Online Markeitng ( Forms / Leads ) </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="omStatus" 
                                                                     name="omStatus"
                                                                     <?= CMS::isChecked('1', $loadData['omStatus'] ?? ''); ?> 
                                                                  >
                                                            </div>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> E-Commerce </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="ecomStatus" 
                                                                     name="ecomStatus"
                                                                     <?= CMS::isChecked('1', $loadData['ecomStatus'] ?? ''); ?>
                                                                  >
                                                            </div>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> Customizations </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="customStatus" 
                                                                     name="customStatus"
                                                                     <?= CMS::isChecked('1', $loadData['customStatus'] ?? ''); ?>
                                                                  >
                                                            </div>
                                                         </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                         <label class="col-lg-4 col-form-label fw-semibold fs-6"> File Manager </label>
                                                         <div class="col-lg-8 fv-row">
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                  <input 
                                                                     class="form-check-input" 
                                                                     type="checkbox" 
                                                                     value="1" 
                                                                     id="fmStatus" 
                                                                     name="fmStatus"
                                                                     <?= CMS::isChecked('1', $loadData['fmStatus'] ?? ''); ?>
                                                                  >
                                                            </div>
                                                         </div>
                                                   </div>
                                                   <!--  form -->
                                                </div>
                                          </div>                
                                       
                                       <div class="separator separator-dashed"></div>
                                    </div>

                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_seo">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                 Search Engine Optimizatio ( SEO )                            
                                             </h4>
                                       </div>
                                      
                                          <div id="kt_job_1_seo" class="collapse  fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                   <!--  form -->

                                                   <div class="row mb-6">
                                                      <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                      <span class="required"> Keywords </span>
                                                   </label>
                                                      <div class="col-lg-8 fv-row">
                                                         <input 
                                                         type="text" 
                                                         name="keywords" 
                                                         class="form-control form-control-lg form-control-solid" 
                                                         placeholder="keywords" 
                                                         value="<?= $loadData['keywords']; ?>"
                                                         require
                                                         />
                                                      </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                      <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                      <span class="required"> Robots (txt) </span>
                                                   </label>
                                                      <div class="col-lg-8 fv-row">
                                                            <textarea 
                                                               class="form-control form-control-solid" 
                                                               rows="3" 
                                                               placeholder="Content robots..." 
                                                               name="robots" 
                                                               id="description"><?= $loadData['robots']; ?></textarea>
                                                      </div>
                                                   </div>

                                                   <div class="row mb-6">
                                                   <label class="col-lg-4 col-form-label required fw-semibold fs-6"> 
                                                      Description </label>
                                                   <div class="col-lg-8">
                                                      <div class="row">
                                                         <div class="col-lg-12 fv-row">
                                                            <textarea 
                                                               class="form-control form-control-solid" 
                                                               rows="3" 
                                                               placeholder="Content here..." 
                                                               name="description" 
                                                               id="description"><?= $loadData['description']; ?></textarea>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="row mb-6">
                                                   <label class="col-lg-4 col-form-label required fw-semibold fs-6"> 
                                                      Content </label>
                                                   <div class="col-lg-8">
                                                      <div class="row">
                                                         <div class="col-lg-12 fv-row">
                                                            <textarea 
                                                               class="form-control form-control-solid" 
                                                               rows="3" 
                                                               placeholder="Content here..." 
                                                               name="content" 
                                                               id="content"><?= $loadData['content']; ?></textarea>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>

                                                   

                                                   <!--  form xxx -->
                                                </div>
                                          </div>                
                                          <div class="separator separator-dashed"></div>
                                    </div>


                                    <div class="m-0">
                                       <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_1_disablewebsite">
                                             <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                             </div>
                                             <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                 Disable / Enable Website                              
                                             </h4>
                                       </div>
                                      
                                          <div id="kt_job_1_disablewebsite" class="collapse  fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                   <!--  form -->

                                                   <div class="row mb-6 mt-6">
                                                      <label class="col-lg-4 col-form-label required fw-semibold fs-6"> Status </label>
                                                      <div class="col-lg-8 fv-row">
                                                         <select 
                                                            name="status" 
                                                            data-placeholder="Select status..." 
                                                            class="form-select form-select-solid form-select-lg"
                                                            >
                                                            <option value="enabled" <?= CMS::isSelected('enabled', $loadData['status'] ?? ''); ?> >  <?= STATUS_ENABLED; ?> </option>
                                                            <option value="disabled" <?= CMS::isSelected('disabled', $loadData['status'] ?? ''); ?> > <?= STATUS_DISABLED; ?> </option>
                                                         </select>
                                                         <span class="text-muted fs-6"> Controla o status do metadado dentro da publicação, ativa e desativa o conteúdo </span>
                                                      </div>
                                                   </div>

                                                   <!--  form -->
                                                </div>
                                          </div>                
                                       
                                    </div>
                                       
                                    <input type="hidden" id="pubId" name="pubId" value="<?= Security::inputSanitizer($_REQUEST['pubId']); ?>">

                                    </div>
                                    
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                       <button 
                                          type="reset" 
                                          class="btn btn-light btn-active-light-primary me-2"
                                        >
                                          <?= BUTTON_DISCARD_01; ?>
                                        </button>
                                       <button 
                                          type="submit" 
                                          class="btn btn-primary" 
                                          id="kt_account_profile_details_submit"
                                        >
                                          <?= BUTTON_SUBMIT_01; ?> 
                                        </button>
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

      </script>
      <script>
          document.addEventListener("DOMContentLoaded", function () {
              const uploadContent = document.getElementById("uploadContent");
              const metadataType = document.getElementById("metadataType");

              function toggleUploadContent() {
                  if (metadataType.value === "gallery" || metadataType.value === "image" || metadataType.value === "featuredImage") {
                      uploadContent.style.display = "flex"; 
                  } else {
                      uploadContent.style.display = "none";
                  }
              }

              metadataType.addEventListener("change", toggleUploadContent);
              toggleUploadContent(); 
          });
      </script>
   </body>
</html>