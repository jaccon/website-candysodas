<?php
include(__DIR__ . '/../../config.inc.php');

global $CONFIG;
session_start();
Auth::loginSession();

$userId = Auth::getUserData($_SESSION['user'], "id");
$name = Auth::getUserData($_SESSION['user'], "name");
$login = Auth::getUserData($_SESSION['user'], "email");
$currentLanguage = Auth::getUserData($_SESSION['user'], "language");
$saveSuccess = false;
$savedUuid = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= PAGE_TITLE; ?></title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style> 
        .statusColumn {
            margin-left: 2em;
        }
        .note-image-input {
            display: none !important;
        }
    </style>
</head>

<body id="kt_body" 
    data-kt-app-header-stacked="true" 
    data-kt-app-header-primary-enabled="true" 
    data-kt-app-header-secondary-enabled="true" 
    data-kt-app-toolbar-enabled="true"  
    class="app-default">

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
                                                <span id="gTitle">Catalog Import</span>
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
                                                    Catalog                                          
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>                    
                                                </li>
                                                <li class="breadcrumb-item text-gray-500">
                                                    import
                                                </li>
                                                <li class="breadcrumb-item">
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

                            <div id="kt_app_content" class="app-content pb-0">
                                <?php include('../components/my-account/resume.inc.php'); ?>

                                <div class="pb-0">
                                    <?php if ($saveSuccess): ?>
                                        <div class="alert alert-success" role="alert">
                                            CSV importado com sucesso!
                                        </div>
                                    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                                        <div class="alert alert-danger" role="alert">
                                            Falha ao importar o CSV.
                                        </div>
                                    <?php endif; ?>

                                    <form id="importForm" class="form d-flex flex-column flex-lg-row" method="POST" enctype="multipart/form-data">
                                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tabpanel">
                                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                                        <div class="card card-flush py-4">
                                                            <div class="card-body pt-0">
                                                                <div class="mb-4 fv-row">
                                                                    <label class="required form-label">Select CSV</label>
                                                                    <input type="file" id="csvInput" name="csv_file" class="form-control mb-2" accept=".csv" required />
                                                                    <div class="text-muted fs-7">Upload max filesize 20MB.</div>
                                                                    <div class="progress mt-3" style="height: 20px; display: none;" id="uploadProgressContainer">
                                                                        <div id="uploadProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%">0%</div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    // Define max file size (20MB in bytes)
    const MAX_FILE_SIZE = 20 * 1024 * 1024;

    document.getElementById('csvInput').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        // Validate file size
        if (file.size > MAX_FILE_SIZE) {
            Swal.fire({
                title: 'Arquivo muito grande',
                html: `O arquivo selecionado tem ${(file.size / (1024 * 1024)).toFixed(2)}MB.<br>
                       O tamanho máximo permitido é 20MB.`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
            this.value = ''; // Clear the file input
            return;
        }

        // Validate file type
        if (!file.name.toLowerCase().endsWith('.csv')) {
            Swal.fire({
                title: 'Tipo de arquivo inválido',
                text: 'Por favor, selecione apenas arquivos CSV.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            this.value = '';
            return;
        }

        // Show loading state
        Swal.fire({
            title: 'Importando produtos...',
            html: 'Por favor aguarde enquanto processamos seu arquivo.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const formData = new FormData();
        formData.append('csv_file', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/catalog-import', true);

        const progressBarContainer = document.getElementById('uploadProgressContainer');
        const progressBar = document.getElementById('uploadProgressBar');
        progressBarContainer.style.display = 'block';
        progressBar.style.width = '0%';
        progressBar.innerText = '0%';

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percent + '%';
                progressBar.innerText = percent + '%';
            }
        };

        xhr.onload = function () {
            progressBar.classList.remove('progress-bar-animated');
            
            try {
                const response = JSON.parse(xhr.responseText);
                
                if (xhr.status === 200 && response.success) {
                    progressBar.classList.add('bg-success');
                    progressBar.innerText = '100% - Concluído';
                    
                    // Show success modal with statistics
                    Swal.fire({
                        title: 'Importação Concluída!',
                        html: `
                            <div class="text-left">
                                <p><strong>Total de produtos importados:</strong> ${response.stats.totalImported}</p>
                                <p><strong>Produtos ignorados:</strong> ${response.stats.totalSkipped}</p>
                                <p><strong>Total de erros:</strong> ${response.stats.totalErrors}</p>
                                ${response.stats.errors.length > 0 ? 
                                    `<div class="alert alert-warning">
                                        <strong>Erros encontrados:</strong><br>
                                        ${response.stats.errors.join('<br>')}
                                    </div>` 
                                    : ''
                                }
                            </div>
                        `,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); // Reload page after clicking OK
                        }
                    });
                } else {
                    progressBar.classList.add('bg-danger');
                    progressBar.innerText = 'Erro';
                    
                    // Show error modal
                    Swal.fire({
                        title: 'Erro na Importação',
                        text: response.message || 'Falha ao importar o CSV.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (e) {
                progressBar.classList.add('bg-danger');
                progressBar.innerText = 'Erro';
                
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao processar resposta do servidor.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        };

        xhr.onerror = function () {
            progressBar.classList.add('bg-danger');
            progressBar.innerText = 'Erro de conexão';
            
            Swal.fire({
                title: 'Erro de Conexão',
                text: 'Não foi possível conectar ao servidor.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        };

        xhr.send(formData);
    });

    // Reset form and progress bar on page load
    window.addEventListener('load', function() {
        const progressBarContainer = document.getElementById('uploadProgressContainer');
        const progressBar = document.getElementById('uploadProgressBar');
        const csvInput = document.getElementById('csvInput');
        
        progressBarContainer.style.display = 'none';
        progressBar.style.width = '0%';
        progressBar.innerText = '0%';
        progressBar.className = 'progress-bar progress-bar-striped progress-bar-animated bg-primary';
        csvInput.value = '';
    });

    // Add click handler for file input button if it exists
    const importButton = document.querySelector('.btn-import');
    if (importButton) {
        importButton.addEventListener('click', function() {
            document.getElementById('csvInput').click();
        });
    }
</script>



</body>
</html>
