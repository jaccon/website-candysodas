<?php 
include(__DIR__ . '/../../config.inc.php'); 

global $CONFIG;
session_start();
Auth::loginSession();

$message = '';
$success = false;

$registerId = $_GET['id'] ?? null;
$projectData = null;

if ($registerId) {
    $loadData = CMS::getCategoryById($registerId);
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
$id = Auth::getUserData($_SESSION['user'], "id");
$currentLanguage = Auth::getUserData($_SESSION['user'], "language");
$thumbnail = Auth::getAvatar($avatar);

$saveSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $dataToSave = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'status' => $_POST['status'],
    'categoryFather' => $_POST['categoryFather'],
    'usergroup' => $_POST['usergroup'],
    'categoryType' => $_POST['categoryType'],
    'updatedAt' => date('Y-m-d H:i:s')
];

  if (CMS::updateCategoryById($registerId, $dataToSave)) {
    $message = "Registro salvo com sucesso!";
    $success = true;
  } else {
    $message = "Erro ao salvar Registro!";
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
                                       <?= CAT_0; ?> / <?= $loadData['title']; ?>
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
                                          <?= CAT_01; ?>                                             
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                          <?= CORE_UPDATE; ?>     
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>
                           
                           <div class="card mb-5 mb-xl-10">
                              
                              <div class="card-header border-0 cursor-pointer" >
                                 <div class="card-title m-0">
                                    <h3 class="fw-bold m-0"> <?= CORE_DETAILS; ?> </h3>
                                 </div>

                                 <a href="categories-list.html" class="btn btn-sm btn-secondary align-self-center">
                                    Ver todos
                                 </a>


                              </div>
                              
                              
                              <div id="kt_account_settings_profile_details" class="collapse show">
                                 
                                 <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?id=<?= $registerId; ?>&success=true">
                                    
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
                                              placeholder="Title" 
                                              value="<?= $loadData['title']; ?>"
                                              require
                                              />
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label required fw-semibold fs-6"> 
                                             <?= CORE_DESC; ?> </label>
                                          <div class="col-lg-8">
                                             <div class="row">
                                                <div class="col-lg-12 fv-row">
                                                   <input 
                                                    type="text" 
                                                    name="description" 
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="description" 
                                                    value="<?= $loadData['description']; ?>"
                                                    />
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                          <span> <?= CAT_06; ?> </span>
                                          <span class="ms-1"  data-bs-toggle="tooltip" title="Category parent if exists" >
                                          <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i></span>                    </label>
                                          <div class="col-lg-8 fv-row">
                                                <select 
                                                  name="categoryFather" 
                                                  data-placeholder="Select category..." 
                                                  class="form-select form-select-solid form-select-lg"
                                                >
                                                  <option value="">  Select a category father if exists </option>
                                                  <?php 
                                                    $data = CMS::getCategories();
                                                    foreach ($data as $category) { ?>
                                                      <option 
                                                        value="<?= $category['id']; ?>" 
                                                        <?= CMS::isSelected($category['id'], $loadData['categoryFather']  ?? ''); ?> 
                                                      >  <?= $category['title']; ?> </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="form-text">
                                                    If you need select a category father
                                                </div>
                                          </div>
                                       </div>
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> <?= CAT_08; ?>  </span>
                                          </label>
                                          <div class="col-lg-8 fv-row">
                                              <select 
                                                name="categoryType" 
                                                data-placeholder="Select category type..." 
                                                class="form-select form-select-solid form-select-lg"
                                              >
                                                <option value="posts" <?= CMS::isSelected('posts', $loadData['categoryType']  ?? ''); ?> >  <?= CAT_09; ?> </option>
                                                <option value="pages" <?= CMS::isSelected('pages', $loadData['categoryType']  ?? ''); ?> > <?= CAT_10; ?> </option>
                                                <option value="products" <?= CMS::isSelected('products', $loadData['categoryType']  ?? ''); ?> > <?= CAT_11; ?> </option>
                                             </select>
                                             <div class="form-text">
                                                Select the category type
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
                                                <option value="enabled" <?= CMS::isSelected('enabled', $loadData['status'] ?? ''); ?> >  <?= STATUS_ENABLED; ?> </option>
                                                <option value="disabled" <?= CMS::isSelected('disabled', $loadData['status'] ?? ''); ?> > <?= STATUS_DISABLED; ?> </option>
                                             </select>
                                          </div>
                                      </div>

                                       <input type="hidden" id="uuid" name="uuid" value="">

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

      <script>

        async function fetchUuid() {
            try {
                const response = await fetch('https://www.uuidgenerator.net/api/version1');
                if (!response.ok) {
                    throw new Error('Erro ao buscar UUID');
                }
                const uuid = await response.text();
                document.getElementById('uuid').value = uuid;
                console.log(uuid);
            } catch (error) {
                console.error(error);
                alert('Erro ao obter UUID');
            }
        }

        window.onload = fetchUuid;

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

   </body>
</html>