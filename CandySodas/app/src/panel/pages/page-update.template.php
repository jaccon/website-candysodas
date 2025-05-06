<?php 
include(__DIR__ . '/../../config.inc.php'); 

global $CONFIG;
session_start();
Auth::loginSession();
Configurations::checkFeatureStatus('pagesStatus');

$message = '';
$success = false;

$postId = $_GET['id'] ?? null;
$postData = null;

if ($postId) {
    $loadData = Cms::getPagesById($postId);
}

if (!$loadData) {
    echo "Registro não encontrado ou erro ao carregar os dados.";
    exit;
}

$userId = Auth::getUserData($_SESSION['user'], "id");
$name = Auth::getUserData($_SESSION['user'], "name");
$login = Auth::getUserData($_SESSION['user'], "email");
$currentLanguage = Auth::getUserData($_SESSION['user'], "language");

$saveSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $existingPermLink = $loadData['permLink']; 

  if (isset($_POST['permLink']) && trim($_POST['permLink']) !== '') {
    $permLink = $_POST['permLink'];
  } else {
    $permLink = $existingPermLink;
  }

  $categories = !empty($_POST['categories_string']) ? $_POST['categories_string'] : $loadData['categories'];

  $dataToSave = [
    'id' => $_GET['id'],
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'content' => $_POST['content'],
    'status' => $_POST['status'],
    'categories' => $categories,
    'postSchedule' => !empty($_POST['postSchedule']) 
        ? date('Y-m-d H:i:s', strtotime($_POST['postSchedule']))
        : null,
    'permLink' => $permLink,
    'tags' => $_POST['tags'],
    'userId' => $userId,
    'updatedAt' => date('Y-m-d H:i:s')
  ];

  if (CMS::updatePage($postId, $dataToSave)) {
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

      <style> 
        .statusColumn {
            margin-left: 2em;
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
                                      <span id="gTitle"> Update Page</span>
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
                                         Pages                                          
                                       </li>
                                       <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                         update page
                                        </li>
                                        <li class="breadcrumb-item"> 
                                          <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                        </li>
                                        <li class="breadcrumb-item text-gray-500">
                                          <span id="permLink"><?= $loadData['permLink']; ?></span>
                                        </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>
                           
                          <div id="kt_app_content" class="app-content  pb-0 ">
                             <!-- Start Form custom -->
                             <form 
                                class="form d-flex flex-column flex-lg-row"
                                method="POST" 
                                enctype="multipart/form-data" 
                                action="?id=<?= $postId; ?>&success=true"
                              >
                               
                                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                    <div class="tab-content">
                                      <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                          <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                  <div class="card-title">
                                                      <h2> Post Details </h2>
                                                  </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                  <div class="mb-10 fv-row">
                                                      <label class="required form-label"> Title </label>
                                                      <input 
                                                        type="text" 
                                                        name="title" 
                                                        class="form-control mb-2" 
                                                        placeholder="Publication title" 
                                                        id="title"
                                                        value="<?= $loadData['title']; ?>"
                                                        required
                                                      />
                                                      <div class="text-muted fs-7"> put the publication title.</div>
                                                  </div>
                                                  <div>
                                                      <label class="form-label">Description</label>
                                                      <input 
                                                        type="text" 
                                                        name="description" 
                                                        class="form-control mb-2" 
                                                        placeholder="Description" 
                                                        id="description" 
                                                        value="<?= $loadData['description']; ?>"
                                                      />
                                                      <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                                  </div>

                                                  <div class="mt-6">
                                                      <label class="form-label"> Content </label>
                                                      <textarea id="content" name="content" required><?= $loadData['content']; ?></textarea>
                                                  </div>
                                                </div>
                                            </div>
                                           
                                            

                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                <div class="card-title m-0">
                                                    <h3 class="fw-bold m-0"> Publication Metadata </h3>
                                                </div>

                                                <button 
                                                  type="button" 
                                                  class="btn btn-sm btn-success align-self-center" 
                                                  data-bs-toggle="modal" 
                                                  data-bs-target="#kt_modal_metadata">
                                                  Add Metadata
                                                </button>
                                                </div>

                                                <!--  metadata itens -->
                                                <div class="card-body">
                                                    <div class="hover-scroll-overlay-y pe-6 me-n6" >
                                                      
                                                      <div id="metadata-list"></div>

                                                    </div>
                                                </div>
                                                 <!--  // end metadata itens -->
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10 statusColumn">
                                  <div class="card card-flush py-4">
                                    <div class="card-header">
                                          <div class="card-title">
                                            <h2>Status</h2>
                                          </div>
                                          <div class="card-toolbar">
                                            <?php 
                                              if($loadData['status'] === "enabled") { 
                                            ?>
                                                <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                            <?php } elseif($loadData['status'] === "disabled"){ ?>
                                                <div class="rounded-circle bg-danger w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                            <?php } else { ?>
                                                  <div class="rounded-circle bg-dark w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                            <?php }?>

                                          </div>
                                      </div>
                                      <div class="card-body pt-0">
                                          <select 
                                            class="form-select mb-2" 
                                            name="status"
                                            id="status"
                                          >
                                            <option value="enabled"   <?= CMS::isSelected('enabled', $loadData['status'] ?? ''); ?>> Enabled </option>
                                            <option value="disabled"  <?= CMS::isSelected('disabled', $loadData['status'] ?? ''); ?>>Disable</option>
                                            <option value="scheduled" <?= CMS::isSelected('scheduled', $loadData['status'] ?? ''); ?>>Scheduled</option>
                                          </select>

                                          <div id="dateSchedule" class="d-none mt-10">
                                                <input 
                                                  type="datetime-local" 
                                                  name="postSchedule" 
                                                  id="postSchedule" 
                                                  class="form-control form-control-lg form-control-solid" 
                                                  placeholder="Select date & time"
                                                  value="<?= htmlspecialchars($projectDeadline); ?>"
                                                />
                                          </div>
                                      </div>
                                  </div>
                                    <div class="card card-flush py-4">
                                      <div class="card-header">
                                          <div class="card-title">
                                            <h2>Image Featured </h2>
                                          </div>
                                      </div>
                                     
                                      <div class="card-body text-center pt-0">

                                          <?php 
                                            $imageData = Cms::getLastFeaturedImageByPubId($postId);
                                            if ($imageData) {
                                              $imageUrl = $imageData['originalDirectory'] . '/' . $imageData['uploadPath'];
                                              echo "<img src='" . $CONFIG['CONF']['uploadUrl']. "/" .$imageUrl . "' alt='Imagem de destaque' width='150' class='mb-4' />";
                                            } else {
                                                echo "Nenhuma imagem encontrada.";
                                            }
                                          ?>
                                          
                                          <div class="text-muted fs-7"> To set a image featured add a Metadata if type Image Featured </div>
                                      </div>
                                    </div>

                                    <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                      <h2> Publication Customizations </h2>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                  <label class="form-label">Categories</label>
                                                  <select 
                                                    name="categories"
                                                    id="categories"
                                                    class="form-select mb-2" 
                                                    data-control="select2" 
                                                    data-placeholder="Select an option" 
                                                    data-allow-clear="true" 
                                                    multiple="multiple"
                                                    onchange="updateCategoryString()"
                                                    required
                                                    >
                                                    <option></option>
                                                    <?php 
                                                      $data = CMS::getCategories('posts');
                                                      foreach ($data as $category) { 
                                                        
                                                    ?>
                                                        <option value="<?= $category['id']; ?>" <?= CMS::isSelectedCategories($category['id'], $loadData['categories'] ?? ''); ?> >  
                                                          <?= $category['title']; ?> </option>
                                                      <?php } ?>
                                                  </select>

                                                  <input type="hidden" id="categories-string" name="categories_string" value="">
                                                  <input type="hidden" id="inputPermLink" name="permLink" value="">


                                                  <label class="form-label d-block">Tags</label>
                                                  <input 
                                                    class="form-control mb-2" 
                                                    name="tags" 
                                                    id="tags" 
                                                    value="<?= $loadData['tags']; ?>"
                                                    required
                                                  />
                                                  <input id="uuid" name="uuid" type="hidden" />
                                                  <div class="text-muted fs-7"> Add tags to a product.</div>
                                                </div>
                                            </div>
                                    
                                    <div class="d-flex justify-content-end">
                                      <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"> <?= BUTTON_SUBMIT_01; ?> </button>
                                    </div>
                                </div>



                            </form>
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

      <?php 
        $metaOrigin = 'pages';
        include('../components/modals/add-metadata/add-metadata.inc.php'); 
      ?>

      <script src="assets/plugins/global/plugins.bundle.js"></script>
      <script src="assets/js/scripts.bundle.js"></script>
      <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
      <script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
      <script src="assets/js/widgets.bundle.js"></script>
      <script src="assets/js/custom/utilities/modals/create-app.js"></script>
      <script src="assets/js/post-update.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.js"></script>

      <script> 
       $(document).ready(function () {
            const urlParams = new URLSearchParams(window.location.search);
            const contentId = urlParams.get('id'); 
            if (contentId) {
                $("#metadata-list").load("metadata-list-itens.html?id=" + contentId);
            } else {
                $("#metadata-list").html("<p>ID não especificado na URL.</p>");
            }
        });
      </script>
      
   </body>
</html>