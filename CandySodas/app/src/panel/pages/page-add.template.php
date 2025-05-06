<?php 
include(__DIR__ . '/../../config.inc.php'); 

global $CONFIG;
session_start();
Auth::loginSession();
Configurations::checkFeatureStatus('pagesStatus');

$userId = Auth::getUserData($_SESSION['user'], "id");
$name = Auth::getUserData($_SESSION['user'], "name");
$login = Auth::getUserData($_SESSION['user'], "email");
$currentLanguage = Auth::getUserData($_SESSION['user'], "language");

$saveSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $projectDeadlineInput = $_POST['projectDeadline'];
  $projectDeadlineTimestamp = strtotime($projectDeadlineInput);

  $dataToSave = [
    'id' => $_POST['uuid'], 
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'content' => $_POST['content'],
    'status' => $_POST['status'],
    'categories' => $_POST['categories_string'],
    'tags' => $_POST['tags'],
    'postSchedule' => !empty($_POST['postSchedule']) 
        ? date('Y-m-d H:i:s', strtotime($_POST['postSchedule']))
        : null,
    'permLink' => $_POST['permLink'],
    'userId' => $userId,
    'createdAt' => date('Y-m-d H:i:s')
];

  if (CMS::savePage($dataToSave)) {
    $message = "Registro salvo com sucesso!";
    $success = true;
    setcookie('lastUuid', $_POST['uuid'], time() + (86400 * 30), "/");
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
        .statusColumn {
            margin-left: 2em;
        }

        .note-image-input {
            display: none !important;
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
                                      <span id="gTitle"> Add new page </span>
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
                                          add new page
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                         <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i> 
                                        </li>
                                        <li class="breadcrumb-item text-gray-500">
                                           <span id="permLink"></span>
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
                                action="?success=true"
                              >
                               
                                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                    <div class="tab-content">
                                      <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                          <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                  <div class="card-title">
                                                      <h2> Details </h2>
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
                                                      />
                                                      <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                                  </div>

                                                  <div class="mt-6">
                                                      <label class="form-label"> Content </label>
                                                      <textarea id="content" name="content"></textarea>
                                                  </div>
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
                                                  foreach ($data as $category) { ?>
                                                    <option value="<?= $category['id']; ?>">  <?= $category['title']; ?> </option>
                                                  <?php } ?>
                                              </select>

                                              <input type="hidden" id="categories-string" name="categories_string" value="">
                                              <input type="hidden" id="inputPermLink" name="permLink" value="">


                                              <label class="form-label d-block">Tags</label>
                                              <input 
                                                class="form-control mb-2" 
                                                name="tags" 
                                                id="tags"
                                                required
                                              />
                                              <input id="uuid" name="uuid" type="hidden" />
                                              <div class="text-muted fs-7"> Add tags to a product.</div>
                                            </div>
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
                                            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                          </div>
                                      </div>
                                      <div class="card-body pt-0">
                                          <select 
                                            class="form-select mb-2" 
                                            name="status"
                                            id="status"
                                            required
                                          >
                                            <option value="enabled" selected> Enabled </option>
                                            <option value="disabled">Disable</option>
                                            <option value="scheduled">Scheduled</option>
                                          </select>
                                          <div class="text-muted fs-7">Set the product status.</div>
                                          
                                          <div id="dateSchedule" class="d-none mt-10">
                                                <div class="card-title">
                                                  <h2> Post Schedule</h2>
                                                </div>
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
                                            <h2>Thumbnail</h2>
                                          </div>
                                      </div>
                                     
                                      <div class="card-body text-center pt-0">
                                          <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                            <div class="image-input-wrapper"></div>
                                            <label class="btn btn-icon btn-circle btn-active-color-primary bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                                          </div>
                                          <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
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
      <script src="assets/plugins/global/plugins.bundle.js"></script>
      <script src="assets/js/scripts.bundle.js"></script>
      <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
      <script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
      <script src="assets/js/widgets.bundle.js"></script>
      <script src="assets/js/custom/utilities/modals/create-app.js"></script>

      <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-bs4.min.js"></script>
      <script>
          $(document).ready(function() {
            $('#content').summernote({
                height: 400,
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
                                $('#content').summernote('insertImage', imagePath);
                            },
                            error: function() {
                                alert('Erro ao enviar a imagem');
                            }
                        });
                    }
                }
            });
          });


        document.addEventListener('DOMContentLoaded', () => {
          const statusSelect = document.getElementById('status');
          const scheduleDiv = document.getElementById('dateSchedule');

          statusSelect.addEventListener('change', () => {
            if (statusSelect.value === 'scheduled') {
              scheduleDiv.classList.remove('d-none');
            } else {
              scheduleDiv.classList.add('d-none');
            }
          });
        });
      </script>
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
                const cookies = document.cookie.split('; ').reduce((acc, cookie) => {
                    const [name, value] = cookie.split('=');
                    acc[name] = value;
                    return acc;
                }, {});
                const lastUuid = cookies.lastUuid;

                if (lastUuid) {
                    window.location.href = `page-update.html?id=${lastUuid}`;
                } else {
                    console.error('UUID não encontrado no cookie lastUuid!');
                }
            });
        }


        // Form transformation Permlink and Title
        document.getElementById('title').addEventListener('input', (e) => {
              const gTitle = document.getElementById('gTitle');
              const permLink = document.getElementById('permLink');
              const inputPermLink = document.getElementById('inputPermLink');
              const inputValue = e.target.value.trim();

              // Atualiza o gTitle
              gTitle.textContent = inputValue || 'Add new post';

              // Gera o permalink
              const formattedPermlink = inputValue
                  .toLowerCase() // Converte para minúsculas
                  .normalize('NFD') // Remove acentos
                  .replace(/[\u0300-\u036f]/g, '') // Remove diacríticos
                  .replace(/[^a-z0-9\s-]/g, '') // Remove caracteres especiais
                  .replace(/\s+/g, '-') // Substitui espaços por hífens
                  .replace(/-+/g, '-') // Remove hífens consecutivos
                  .replace(/^-+|-+$/g, ''); // Remove hífens no início e no fim

              // Atualiza o permLink no span
              permLink.textContent = formattedPermlink || 'new-post';

              // Atualiza o valor do input hidden
              inputPermLink.value = formattedPermlink || 'new-post';
        });



        function updateCategoryString() {
          const select = document.getElementById('categories');
          const selectedOptions = Array.from(select.selectedOptions);
          const selectedValues = selectedOptions.map(option => option.value);
          const categoriesString = selectedValues.join('|');  // Converte os IDs selecionados em string separada por |
          document.getElementById('categories-string').value = categoriesString;  // Atualiza o campo oculto
          
          // Adicionando o console.log para verificar os valores selecionados
          console.log('Categorias selecionadas:', selectedValues);
        }
      </script>
   </body>
</html>