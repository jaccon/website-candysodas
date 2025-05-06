<?php 
include(__DIR__ . '/../../config.inc.php'); 

global $CONFIG;
session_start();
Auth::loginSession();

$message = '';
$success = false;

$registerId = $_GET['mId'] ?? null;
$pubId = $_GET['pubId'] ?? null;
$projectData = null;

if ($registerId) {
    $loadData = CMS::loadMetadaById($registerId);
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

    $jsonFilePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

    if (!file_exists($jsonFilePath)) {
        file_put_contents($jsonFilePath, json_encode([], JSON_PRETTY_PRINT));
    }

    $jsonData = file_get_contents($jsonFilePath);
    $comments = json_decode($jsonData, true) ?: [];

    $dataToSave = [
        'title' => $_POST['title'] ?? '',
        'content' => $_POST['content'] ?? '',
        'description' => $_POST['description'] ?? '',
        'status' => $_POST['status'] ?? '',
        'metadataType' => $_POST['metadataType'] ?? '',
        'userId' => $userId,
        'pubId' => $_POST['pubId'] ?? '',
        'uploadFiles' => $uploadedFilesData, 
        'updatedAt' => date('Y-m-d H:i:s'),
    ];

    if (CMS::metadataUpdateById($registerId, $dataToSave)) {
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
                                       Metadada / <?= $loadData['title']; ?>
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
                                          Metadata                                            
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

                                 
                                 <?php 
                                    $metaOrigin = $loadData['metaOrigin'] ?? null;
                                    if($metaOrigin === 'posts') {
                                       $link = "post-update.html";
                                    } elseif ($metaOrigin === 'pages') {
                                       $link = "page-update.html";
                                    }
                                 ?>

                                  <?php 
                                    if ( $metaOrigin === 'posts' || $metaOrigin === 'pages' ) {
                                  ?>

                                    <a href="<?= $link; ?>?id=<?= Security::inputSanitizer($_REQUEST['pubId']); ?>" 
                                       class="btn btn-sm btn-secondary align-self-center">
                                          Ver publicação                                    
                                    </a>

                                  <?php } ?>

                              </div>
                              
                              <div id="kt_account_settings_profile_details" class="collapse show">
                                 <form 
                                    method="POST" 
                                    enctype="multipart/form-data" 
                                    action="?mId=<?= $registerId; ?>&pubId=<?= $_REQUEST['pubId'];?>&success=true">
                                    
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
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required"> Description </span>
                                         </label>
                                          <div class="col-lg-8 fv-row">
                                             <input 
                                              type="text" 
                                              name="description" 
                                              class="form-control form-control-lg form-control-solid" 
                                              placeholder="Description" 
                                              value="<?= $loadData['description']; ?>"
                                              require
                                              />
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
                                       
                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6 required">
                                            <span> Metadata Type </span>
                                            <span class="ms-1"  data-bs-toggle="tooltip" title="Category parent if exists" >
                                            </span>                    
                                          </label>
                                          <div class="col-lg-8 fv-row">
                                                <select 
                                                      name="metadataType" 
                                                      id="metadataType"
                                                      required
                                                      data-placeholder="Select Metadata Type" 
                                                      class="form-select form-select-solid form-select-lg"
                                                  >
                                                      <option value="">  Select a category father if exists </option>
                                                      <option value="files" <?= CMS::isSelected('files', $loadData['metadataType']  ?? ''); ?>>  Files </option>
                                                      <option value="image" <?= CMS::isSelected('image', $loadData['metadataType']  ?? ''); ?>>  Image </option>
                                                      <option value="featuredImage" <?= CMS::isSelected('featuredImage', $loadData['metadataType']  ?? ''); ?>>  Image Featured ( Image High Light ) </option>
                                                      <option value="gallery" <?= CMS::isSelected('gallery', $loadData['metadataType']  ?? ''); ?>>  Image Gallery </option>
                                                      <option value="video" <?= CMS::isSelected('video', $loadData['metadataType']  ?? ''); ?>>  Video Embedded </option>
                                                      <option value="text" <?= CMS::isSelected('text', $loadData['metadataType']  ?? ''); ?>>  Simple Text </option>
                                                  </select>

                                                <div class="form-text">
                                                    Choose the metadata type to using in post
                                                </div>
                                          </div>
                                       </div>

                                       <div class="row mb-6">
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6 required">
                                            <span> Component </span>
                                            <span class="ms-1"  data-bs-toggle="tooltip" title="Category parent if exists" >
                                            </span>                    
                                          </label>
                                          <div class="col-lg-8 fv-row">

                                                <?php $components = Cms::getComponents(); ?>
                                                <select 
                                                      name="metadataType" 
                                                      id="metadataType"
                                                      required
                                                      data-placeholder="Select Metadata Type" 
                                                      class="form-select form-select-solid form-select-lg"
                                                  >
                                                      <option value="">  Select a category father if exists </option>
                                                      <option value="files" <?= CMS::isSelected('files', $loadData['metadataType']  ?? ''); ?>>  Files </option>

                                                      <?php foreach ($components as $component) : ?>
                                                         <option value="<?= $component['id']; ?>" <?= CMS::isSelected($component['id'], $component['id']  ?? ''); ?> > <?= $component['title']; ?> </option>
                                                      <?php endforeach; ?>
                                                  </select>

                                                <div class="form-text">
                                                    Choose the metadata type to using in post
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
                                             <span class="text-muted fs-6"> Controla o status do metadado dentro da publicação, ativa e desativa o conteúdo </span>
                                          </div>
                                      </div>
                                       
                                      <div class="row mb-6" id="uploadContent">
                                          
                                          <label class="col-lg-4 col-form-label fw-semibold fs-6"> Upload File </label>
                                          
                                          <div class="col-lg-8 fv-row">
                                            <input type="file" name="files[]" id="files" class="form-control" multiple>
                                            <span class="text-muted fs-6">Imagens permitidas: JPG, PNG com tamanho de até 2MB.</span>
                                            <div class="progress mt-3">
                                                <div id="upload-progress" class="progress-bar bg-primary" style="width: 0%;"></div>
                                            </div>

                                            <h3 class="mt-4"> Imagens </h3>

                                            <?php 
                                              $jsonFile = $CONFIG['CONF']['cacheDir']."/metadata.json"; 
                                              $jsonData = json_decode(file_get_contents($jsonFile), true);
                                              $gallery = null;

                                              foreach ($jsonData as $item) {
                                                if ($item['id'] === Security::inputSanitizer($_REQUEST['mId']) && $item['status'] === 'enabled') {
                                                    $gallery = $item;
                                                    break;
                                                }
                                              }

                                              if (!$gallery) {
                                                echo "<p>Galeria não encontrada.</p>";
                                              }
                                            ?>

                                            <?php isset($gallery['uploadFiles']) ? '' : $gallery['uploadFiles'] = []; ?>

                                            <div class="gallery-grid">
                                                <?php foreach ($gallery['uploadFiles'] as $file): ?>
                                                    <div class="gallery-item">
                                                        <img 
                                                          src="<?= $CONFIG['CONF']['uploadUrl'] . '/' . $file['originalDirectory'] . '/' . $file['uploadPath']; ?>" 
                                                          alt="<?php echo htmlspecialchars($file['fileName']); ?>" 
                                                          width="300"
                                                          class="border border-dashed border-gray-300 rounded px-7 py-3 mb-6 metadata-item"
                                                        >
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            
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