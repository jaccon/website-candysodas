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

$saveSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = __DIR__ . '/../../uploads/avatars';
    $avatarPath = Uploads::handleFileUploadAvatar('avatar', $uploadDir);
    $avatarPath = $avatarPath ? 'uploads/avatars/' . $avatarPath : $avatar;

    $dataToUpdate = [
        'name' => $_POST['name'],
        'document' => $_POST['document'],
        'phone' => $_POST['phone'],
        'language' => $_POST['language'],
        'avatar' => $avatarPath,
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    Auth::updateUserData($id, $dataToUpdate);
    $saveSuccess = true;

    if ($saveSuccess) {
        echo 'Dados salvos com sucesso!';
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
                                       <?= MYACCOUNT_01; ?>
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
                                          <?= MYACCOUNT_02; ?>                                             
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
                              
                              <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                 <div class="card-title m-0">
                                    <h3 class="fw-bold m-0"> <?= MYACCOUNT_04; ?> </h3>
                                 </div>
                              </div>
                              
                              
                              <div id="kt_account_settings_profile_details" class="collapse show">
                                 
                                 <!-- <form class="form" method="POST" action="?success=true"> -->
                                 <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?success=true">
                                    
                                    <div class="card-body border-top p-9">
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                             <?= MYACCOUNT_05; ?>
                                          </label>   
                                          
                                          <div class="col-lg-8">
                                             <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?= $thumbnail ; ?>')">
                                                
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(<?= $CONFIG['CONF']['siteUrl']."/".$avatar ; ?>)"> </div>

                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                   <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                                   <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                   <input type="hidden" name="avatar_remove"/>
                                                </label>
                                                
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                            </span>
                                                
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>                            </span>
                                                
                                             </div>

                                             <div class="form-text"> 
                                                <?= MYACCOUNT_06; ?>
                                             </div>
                                          </div>
                                          
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> <?= MYACCOUNT_07; // Form ?> </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="<?= MYACCOUNT_08; ?>" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="email" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="Email address" 
                                              value="<?= $login; ?>" />
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= MYACCOUNT_09; // Form ?> </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <input 
                                                    type="text" 
                                                    name="name" 
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="<?= MYACCOUNT_09; // Form ?>" 
                                                    value="<?= htmlspecialchars($name); ?>" />
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       
                                       

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> <?= MYACCOUNT_10; // Form ?> </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Phone number must be active" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="tel" 
                                              name="phone" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="<?= MYACCOUNT_10; // Form ?>" 
                                              value="<?= $phone; ?>" />
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span class="required"> <?= MYACCOUNT_11; // Form ?>  </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Phone number must be active" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="document" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="<?= MYACCOUNT_11; // Form ?>" 
                                              value="<?= htmlspecialchars($document); ?>" />
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> <?= MYACCOUNT_12; // Form ?></label>
                                          
                                          <div class="col-lg-8 fv-row">
                                             <select 
                                                name="language" 
                                                aria-label="Select a Language" 
                                                data-control="select2" 
                                                data-placeholder="Select a language..." 
                                                class="form-select form-select-solid form-select-lg"
                                              >
                                                <option value="en" <?= CMS::isSelected('en', $currentLanguage); ?>> English </option>
                                                <option value="ptbr" <?= CMS::isSelected('ptbr', $currentLanguage); ?>> Portuguese Brazilian </option>
                                             </select>
                                             
                                             <div class="form-text">
                                                <?= MYACCOUNT_13; // Form ?>
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
                           
                           <div class="card  mb-5 mb-xl-10"   >
                              <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                                 <div class="card-title m-0">
                                    <h3 class="fw-bold m-0"> <?= MYACCOUNT_14; // Form ?>  </h3>
                                 </div>
                              </div>
                              
                              <div id="kt_account_settings_signin_method" class="collapse show">
                                 <div class="card-body border-top p-9">
                                    <div class="d-flex flex-wrap align-items-center">
                                       <div id="kt_signin_email">
                                          <div class="fs-6 fw-bold mb-1"> Login </div>
                                          <div class="fw-semibold text-gray-600">
                                            <?= $login; ?>
                                          </div>
                                       </div>
                                    </div>
                                    
                                    <div class="separator separator-dashed my-6"></div>
                                    <div class="d-flex flex-wrap align-items-center mb-10">
                                       
                                       <div id="kt_signin_password">
                                          <div class="fs-6 fw-bold mb-1"> <?= PASSWORD_1; // Form ?> </div>
                                          <div class="fw-semibold text-gray-600">************</div>
                                       </div>
                                       
                                       <div id="kt_signin_password_button" class="ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">
                                          <button class="btn btn-light btn-active-light-primary"> 
                                             <?= PASSWORD_2; // Form ?> 
                                          </button>
                                       </div>
                                       
                                    </div>
                                    
                                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed  p-6">
                                       <i class="ki-duotone ki-shield-tick fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span></i>        
                                       <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                          <div class="mb-3 mb-md-0 fw-semibold">
                                             <h4 class="text-gray-900 fw-bold"> <?= SECURE_01; // Form ?> </h4>
                                             <div class="fs-6 text-gray-700 pe-7"> <?= SECURE_02; // Form ?> Last password udpate </div>
                                          </div>

                                          <?= Admin::formatDateTime(Auth::getUserData($_SESSION['user'], "updatedAt")); ?> 

                                       </div>
                                    </div>
                                 </div>
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