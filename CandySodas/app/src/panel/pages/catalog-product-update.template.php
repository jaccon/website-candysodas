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
    $loadData = CMS::getRegisterById($registerId, 'catalog.json');
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
    
    $uuid = Cms::generateUUID();

    // featuredImage
    $featuredImage = $loadData['featuredImage'] ?? null;
    if (isset($_FILES['featuredImage']) && $_FILES['featuredImage']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = '../../uploads/products/';
      
      if (!file_exists($uploadDir)) {
          mkdir($uploadDir, 0777, true);
      }

      $fileExtension = strtolower(pathinfo($_FILES['featuredImage']['name'], PATHINFO_EXTENSION));
      $newFileName = $uuid . '.' . $fileExtension;
      $uploadFile = $uploadDir . $newFileName;

      if (move_uploaded_file($_FILES['featuredImage']['tmp_name'], $uploadFile)) {
          $featuredImage = 'uploads/products/' . $newFileName;
      }
    }

    // Save date
    $dataToSave = [
        'title' => $_POST['title'],
        'description' => $_POST['content'],
        'featuredImage' => $featuredImage,
        'sku' => $_POST['sku'],
        'priceList' => $_POST['priceList'],
        'priceSale' => $_POST['priceSale'],
        'categories' => $_POST['categories'],
        'tags' => $_POST['tags'],
        'inventory' => $_POST['inventory'],
        'permLink' => $_POST['permLink'],
        'variationMaster' => $_POST['variationMaster'],
        'addToSitemap' => $_POST['addToSitemap'],
        'highlightInCategory' => $_POST['highlightInCategory'],
        'productType' => $_POST['productType'],
        'status' => $_POST['status'],
        'userId' => $userId,
        'createdAt' => date('Y-m-d H:i:s'),
        'postSchedule' => $_POST['status'] === 'scheduled' ? $_POST['postSchedule'] : null,

        // Custom fields
        'codProduto' => $_POST['codProduto'],
        'ncm' => $_POST['ncm'],
        'qtdisplay' => $_POST['qtdisplay'],
        'datavalidade' => $_POST['datavalidade'],
        'scPrecoImpostos' => $_POST['scPrecoImpostos'],
        'scPrecoUnitario' => $_POST['scPrecoUnitario'],
        'sccifPrecoImpostos' => $_POST['sccifPrecoImpostos'],
        'sccifPrecoUnitario' => $_POST['sccifPrecoUnitario'],
        'sprefri10PrecoImpostos' => $_POST['sprefri10PrecoImpostos'],
        'sprefri10PrecoUnitario' => $_POST['sprefri10PrecoUnitario'],
        'rscifPrecoImpostos' => $_POST['rscifPrecoImpostos'],
        'rscifPrecoUnitario' => $_POST['rscifPrecoUnitario'],
        'mgcifPrecoImpostos' => $_POST['mgcifPrecoImpostos'],
        'mgcifPrecoUnitario' => $_POST['mgcifPrecoUnitario'],
        'spcifPrecoImpostos' => $_POST['spcifPrecoImpostos'],
        'spcifPrecoUnitario' => $_POST['spcifPrecoUnitario'],
        'catClassFiscal' => $_POST['catClassFiscal']

    ];

    if (CMS::updateCmsRegisterById($registerId, $dataToSave, 'catalog.json')) {
        $message = "Registro salvo com sucesso!";
        $success = true;
        $savedUuid = $uuid;
        header("Location: ?success=true&id=". urlencode($registerId));
        exit;
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
                                      <span id="gTitle"> Catalog Product Update </span>
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
                                          product 
                                       </li>
                                       <li class="breadcrumb-item text-gray-500">
                                         <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i> 
                                        </li>
                                        <li class="breadcrumb-item text-gray-500">
                                          update
                                        </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div id="kt_app_content" class="app-content  pb-0 " >
                           
                          <?php include('../components/my-account/resume.inc.php'); ?>
                           
                          <div id="kt_app_content" class="pb-0 ">
                             <!-- Start Form custom -->
                             <form 
                                class="form d-flex flex-column flex-lg-row"
                                method="POST" 
                                enctype="multipart/form-data" 
                                action="?id=<?= $registerId; ?>&success=true"
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
                                                  <div class="mb-4 fv-row">
                                                      <label class="required form-label"> Title </label>
                                                      <input 
                                                        type="text" 
                                                        name="title" 
                                                        class="form-control mb-2" 
                                                        placeholder="Publication title" 
                                                        id="title"
                                                        value="<?= $loadData['title']; ?>"
                                                      />
                                                      <div class="text-muted fs-7"> catalog product title max 140 chars.</div>
                                                  </div>
                                                  <div class="mb-10 fv-row">
                                                      <label class="required form-label"> SKU </label>
                                                      <input 
                                                        type="text" 
                                                        name="sku" 
                                                        class="form-control mb-2" 
                                                        placeholder="Product SKU ID" 
                                                        id="sku"
                                                        value="<?= $loadData['sku']; ?>"
                                                      />
                                                  </div>
                                                  <div class="mt-6">
                                                      <label class="form-label"> Description </label>
                                                      <textarea id="content" name="content"><?= $loadData['description']; ?></textarea>
                                                  </div>
                                                </div>
                                            </div>
                                           
                                            <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                  <h2> Customizations </h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">

                                              <!--  taxonomy -->
                                              <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_job_1_1">
                                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                    <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                    <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                                </div>
                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                    Taxonomy                         
                                                </h4>
                                              </div>
                                              <div id="kt_job_1_1" class="collapse fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                    <div class="row mb-6">
                                                      <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                      <span class="required"> Categories </span>
                                                      </label>
                                                      <select 
                                                      name="categories"
                                                      id="categories"
                                                      class="form-select mb-2" 
                                                      data-control="select2" 
                                                      data-placeholder="Select an option" 
                                                      data-allow-clear="true" 
                                                      onchange="updateCategoryString()"
                                                      required
                                                      >
                                                      <?php 
                                                        $data = Commerce::getProductCategories();
                                                        foreach ($data as $category) { ?>
                                                          <option value="<?= $category['title']; ?>" <?= CMS::isSelectedCategories($category['title'], $loadData['categories'] ?? ''); ?> >  
                                                          <?= $category['title']; ?> </option>
                                                        <?php } ?>
                                                    </select>

                                                    <input type="hidden" id="categories-string" name="categories_string" value="">
                                                    <input type="hidden" id="inputPermLink" name="permLink" value="">
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <label class="form-label d-block">Tags</label>
                                                    <input 
                                                      class="form-control mb-2" 
                                                      name="tags" 
                                                      id="tags"
                                                      required
                                                      value="<?= $loadData['tags']; ?>"
                                                    />
                                                    <input id="uuid" name="uuid" type="hidden" />
                                                    <div class="text-muted fs-7"> Add tags to a product.</div>

                                                    </div>
                                                </div>
                                              </div>
                                             <!--  // taxonomy -->

                                             <!-- Pricebook -->
                                             <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_price">
                                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                    <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                    <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                                </div>
                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                    Pricebook                         
                                                </h4>
                                              </div>
                                              <div id="kt_price" class="collapse fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                      <div class="mb-10 fv-row">

                                                        <label class="required form-label"> Price List </label>
                                                        <input 
                                                          type="text" 
                                                          name="priceList" 
                                                          class="form-control mb-2" 
                                                          placeholder="Price without discount" 
                                                          id="priceList"
                                                          value="<?= $loadData['priceList']; ?>"
                                                        />
                                                      </div>

                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Price Sale </label>
                                                        <input 
                                                          type="text" 
                                                          name="priceSale" 
                                                          class="form-control mb-2" 
                                                          placeholder="Price with discount" 
                                                          id="priceSale"
                                                          value="<?= $loadData['priceSale']; ?>"
                                                        />
                                                      </div>
                                                </div>
                                              </div>
                                              <!-- // Pricebook -->

                                              <!-- Inventory -->
                                              <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_inventory">
                                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                    <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                    <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                                </div>
                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                    Inventory                         
                                                </h4>
                                              </div>
                                              <div id="kt_inventory" class="collapse fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                      <div class="mb-10 fv-row">

                                                        <label class="required form-label"> Total in Stock </label>
                                                        <input 
                                                          type="text" 
                                                          name="inventory" 
                                                          class="form-control mb-2" 
                                                          placeholder="Stock quantity" 
                                                          id="inventory"
                                                          value="<?= $loadData['inventory']; ?>"
                                                        />
                                                      </div>
                                                </div>
                                              </div>
                                              <!-- // Inventory -->

                                              <!-- General Customization -->
                                              <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_general">
                                                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                    <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                    <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                                </div>
                                                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                    General Customization                         
                                                </h4>
                                              </div>
                                              <div id="kt_general" class="collapse fs-6 ms-1">
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Permlink </label>
                                                        <input 
                                                          type="text" 
                                                          name="permLink" 
                                                          class="form-control mb-2" 
                                                          placeholder="Product URL" 
                                                          id="permLink"
                                                          value="<?= $loadData['permLink']; ?>"
                                                        />
                                                      </div>
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Variation Master Id </label>
                                                        <input 
                                                          type="text" 
                                                          name="variationMaster" 
                                                          class="form-control mb-2" 
                                                          placeholder="Type of product" 
                                                          id="variationMaster"
                                                          value="<?= $loadData['variationMaster']; ?>"
                                                        />
                                                      </div>
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Product Type </label>
                                                        <select 
                                                          name="productType"
                                                          id="productType"
                                                          class="form-select mb-2" 
                                                          onchange="updateCategoryString()"
                                                          required
                                                          >
                                                            <option value="single" <?= CMS::isSelected('single', $loadData['productType'] ?? ''); ?> >  Single </option>
                                                            <option value="variation" <?= CMS::isSelected('variation', $loadData['productType'] ?? ''); ?> >  Product Variation </option>
                                                            <option value="master" <?= CMS::isSelected('master', $loadData['productType'] ?? ''); ?> >  Product Master </option>
                                                         </select>
                                                      </div>
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Add to Sitemap </label>
                                                        <select 
                                                          name="addToSitemap"
                                                          id="addToSitemap"
                                                          class="form-select mb-2" 
                                                          >
                                                            <option value="">  Choose option </option>
                                                            <option value="enable" <?= CMS::isSelected('enable', $loadData['addToSitemap'] ?? ''); ?> >  Enable </option>
                                                            <option value="disable" <?= CMS::isSelected('disable', $loadData['addToSitemap'] ?? ''); ?> >  Disable </option>
                                                         </select>
                                                      </div>
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Highlight in Category </label>
                                                        <select 
                                                          name="highlightInCategory"
                                                          id="highlightInCategory"
                                                          class="form-select mb-2" 
                                                          >
                                                            <option value="">  Choose option </option>
                                                            <option value="enable" <?= CMS::isSelected('enable', $loadData['highlightInCategory'] ?? ''); ?>>  Enable </option>
                                                            <option value="disable" <?= CMS::isSelected('disable', $loadData['highlightInCategory'] ?? ''); ?> >  Disable </option>
                                                         </select>
                                                      </div>
                                                </div>
                                              </div>

                                              <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_commercial">
                                                  <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                      <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>                
                                                      <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> 
                                                  </div>
                                                  <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">                           
                                                      Informações Comerciais                        
                                                  </h4>
                                                </div>
                                                <div id="kt_commercial" class="collapse fs-6 ms-1">

                                                <p class="mb-4 text-blue-600 fw-semibold fs-6 ps-10 mb-6"> 
                                                  As informações apresentadas nestes campos não são de uso exclusivo do Sistema e não são exibidas para o cliente.
                                                </p>
                                                
                                                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Cod. do Produto </label>
                                                        <input 
                                                          type="text" 
                                                          name="codProduto" 
                                                          class="form-control mb-2" 
                                                          placeholder="Cod. do Produto mesmo que o SKU" 
                                                          id="codProduto"
                                                          value="<?= $loadData['codProduto']; ?>"
                                                        />
                                                      </div>
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> NCM </label>
                                                        <input 
                                                          type="text" 
                                                          name="ncm" 
                                                          class="form-control mb-2" 
                                                          placeholder="NCM"
                                                          id="ncm"
                                                          value="<?= $loadData['ncm']; ?>" 
                                                        />
                                                      </div>
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Quantidade para display </label>
                                                        <input 
                                                          type="text" 
                                                          name="qtdisplay" 
                                                          class="form-control mb-2" 
                                                          placeholder="Quantidade para display" 
                                                          id="qtdisplay"
                                                          value="<?= $loadData['qtdisplay']; ?>" 
                                                        />
                                                      </div>
                                                      <div class="mb-10 fv-row">
                                                        <label class="form-label"> Data de validade </label>
                                                        <input 
                                                          type="datetime-local" 
                                                          name="datavalidade" 
                                                          class="form-control form-control-lg form-control-solid" 
                                                          placeholder="Select date & time"
                                                          id="datavalidade"
                                                          value="<?= $loadData['datavalidade']; ?>"
                                                        />
                                                      </div>
                                                      
                                                        <hr/>
                                                        <h3> SC </h3>
                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preço com impostos </label>
                                                          <input 
                                                            type="text" 
                                                            name="scPrecoImpostos" 
                                                            id="scPrecoImpostos"
                                                            class="form-control mb-2" 
                                                            placeholder="SC / Preço com impostos"
                                                            value="<?= $loadData['scPrecoImpostos']; ?>"
                                                          />
                                                        </div>
                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preço Unitário </label>
                                                          <input 
                                                            type="text" 
                                                            class="form-control mb-2" 
                                                            placeholder="SC / Preço com impostos"
                                                            name="scPrecoUnitario" 
                                                            id="scPrecoUnitario"
                                                            value="<?= $loadData['scPrecoUnitario']; ?>" 
                                                          />
                                                        </div>

                                                        <h3> SC CIF </h3>
                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços com impostos </label>
                                                          <input 
                                                            type="text" 
                                                            name="sccifPrecoImpostos" 
                                                            id="sccifPrecoImpostos"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços com impostos"
                                                            value="<?= $loadData['sccifPrecoImpostos']; ?>"
                                                          />
                                                        </div>
                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços unitário </label>
                                                          <input 
                                                            type="text" 
                                                            name="sccifPrecoUnitario" 
                                                            id="sccifPrecoUnitario"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços unitário"
                                                            value="<?= $loadData['sccifPrecoUnitario']; ?>"
                                                          />
                                                        </div>

                                                        <h3> SP REFRI + 10 </h3>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços com impostos </label>
                                                          <input 
                                                            type="text" 
                                                            name="sprefri10PrecoImpostos" 
                                                            id="sprefri10PrecoImpostos"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços com impostos"
                                                            value="<?= $loadData['sprefri10PrecoImpostos']; ?>"
                                                          />
                                                        </div>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços unitário </label>
                                                          <input 
                                                            type="text" 
                                                            name="sprefri10PrecoUnitario" 
                                                            id="sprefri10PrecoUnitario"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços unitário"
                                                            value="<?= $loadData['sprefri10PrecoUnitario']; ?>"
                                                          />
                                                        </div>

                                                        <h3> RS CIF </h3>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços com impostos </label>
                                                          <input 
                                                            type="text" 
                                                            name="rscifPrecoImpostos" 
                                                            id="rscifPrecoImpostos"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços com impostos"
                                                            value="<?= $loadData['rscifPrecoImpostos']; ?>"
                                                          />
                                                        </div>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços unitário </label>
                                                          <input 
                                                            type="text" 
                                                            name="rscifPrecoUnitario" 
                                                            id="rscifPrecoUnitario"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços unitário"
                                                            value="<?= $loadData['rscifPrecoUnitario']; ?>"
                                                          />
                                                        </div>

                                                        <h3> MG CIF </h3>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços com impostos </label>
                                                          <input 
                                                            type="text" 
                                                            name="mgcifPrecoImpostos" 
                                                            id="mgcifPrecoImpostos"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços com impostos"
                                                            value="<?= $loadData['mgcifPrecoImpostos']; ?>"
                                                          />
                                                        </div>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços unitário </label>
                                                          <input 
                                                            type="text" 
                                                            name="mgcifPrecoUnitario" 
                                                            id="mgcifPrecoUnitario"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços unitário" 
                                                            value="<?= $loadData['mgcifPrecoUnitario']; ?>"
                                                          />
                                                        </div>

                                                        <h3> SP CIF </h3>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços com impostos </label>
                                                          <input 
                                                            type="text" 
                                                            name="spcifPrecoImpostos" 
                                                            id="spcifPrecoImpostos"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços com impostos"
                                                            value="<?= $loadData['spcifPrecoImpostos']; ?>"
                                                          />
                                                        </div>

                                                        <div class="mb-10 fv-row">
                                                          <label class="form-label"> Preços unitário </label>
                                                          <input 
                                                            type="text" 
                                                            name="spcifPrecoUnitario" 
                                                            id="spcifPrecoUnitario"
                                                            class="form-control mb-2" 
                                                            placeholder="Preços unitário"
                                                            value="<?= $loadData['spcifPrecoUnitario']; ?>"
                                                          />
                                                        </div>

                                                        <div class="mb-10 fv-row">
                                                        <label class="form-label"> Categoria de Classificação Fiscal </label>

                                                        <select 
                                                          name="catClassFiscal"
                                                          id="catClassFiscal"
                                                          class="form-select mb-2" 
                                                          >

                                                           <option value=""> Escolha a categoria de classificação fiscal </option>
                                                           <option value="1"> GOMA DE MASCAR C/AÇÚCAR </option>
                                                           <option value="2"> BALAS COM AÇÚCAR </option>
                                                           <option value="3"> PIRULITOS </option>
                                                           <option value="4"> CHOCOLATE BRANCO  </option>
                                                           <option value="5"> MIOJO  </option>
                                                           <option value="6"> CASTANHA DE CAJU </option>
                                                           <option value="7"> CHOCOLATES </option>
                                                           <option value="8"> DOCE DE LEITE </option>
                                                           <option value="9"> PIPOCA </option>
                                                           <option value="10"> BISCOITOS </option>
                                                           <option value="11"> BATATA </option>
                                                           <option value="12"> FRUTAS GLACEADAS </option>
                                                           <option value="13"> SUCO DE TOMATE COM PIMENTA </option>
                                                           <option value="14"> SUCO DE FRUTAS </option>
                                                           <option value="15"> CHÁ </option>
                                                           <option value="16"> GOMA DE MASCAR S/ AÇÚCAR </option>
                                                           <option value="17"> BALAS SEM AÇÚCAR </option>
                                                           <option value="18"> GELATINA </option>
                                                           <option value="19"> agua  </option>
                                                           <option value="20"> AGUÁ COM GÁS E REFRIGERANTE </option>
                                                           <option value="21"> ENERGÉTICOS </option>
                                                           <option value="22"> GIM </option>
                                                           <option value="23"> LICOR </option>
                                                           <option value="24"> BEBIDA ICE </option>
                                                           <option value="25"> CERVEJA HARRY POTTER </option>
                                                           <option value="26"> REFRIGERANTE NOVO NCM </option>
                                                           <option value="27"> BARRAS DE CEREAIS  </option>
                                                         </select>
                                                    </div>
                                                </div>
                                              </div>

                                              <!-- // General Customization -->

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
                                      </div>
                                      <div class="card-body pt-0">
                                          <select 
                                            class="form-select mb-2" 
                                            name="status"
                                            id="status"
                                            required
                                          >
                                            <option value="enabled" <?= CMS::isSelected('enabled', $loadData['status'] ?? ''); ?> > Enabled </option>
                                            <option value="disabled" <?= CMS::isSelected('disabled', $loadData['status'] ?? ''); ?> >Disable</option>
                                            <option value="scheduled" <?= CMS::isSelected('scheduled', $loadData['status'] ?? ''); ?> >Scheduled</option>
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
                                                  value="<?= $loadData['postSchedule']; ?>"
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
                                                <div 
                                                class="image-input-wrapper"
                                                style="background-image: url(<?= $baseUrl."/".$loadData['featuredImage'] ?? ''; ?>"
                                                </div>
                                                <label class="btn btn-icon btn-circle btn-active-color-primary bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>
                                                    <input type="file" name="featuredImage" accept=".png, .jpg, .jpeg" id="featuredImage" />
                                                    <input type="hidden" name="avatar_remove" />
                                                </label>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                </span>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                </span>
                                            </div>
                                            <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                          </div>
                                      </div>
                                    
                                    <div class="d-flex justify-content-center">
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
                height: 160,
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
       $(document).ready(function () {
            const urlParams = new URLSearchParams(window.location.search);
            const contentId = urlParams.get('id'); 
            if (contentId) {
                $("#metadata-list").load("metadata-list-itens.html?id=" + contentId);
            } else {
                $("#metadata-list").html("<p>ID não especificado na URL.</p>");
            }
        });

        function updateCategoryString() {
        // Get selected categories
        const categorySelect = document.getElementById('categories');
        const selectedCategories = Array.from(categorySelect.selectedOptions)
            .map(option => option.value)
            .join(',');
    
      // Update hidden input with selected categories
      document.getElementById('categories-string').value = selectedCategories;

      // Update permLink if title and sku exist
      const title = document.getElementById('title').value;
      const sku = document.getElementById('sku').value;
    
      if (title && sku) {
          const permLink = sanitizePermLink(sku + '-' + title);
          document.getElementById('permLink').value = permLink;
      }
     }
      // Helper function to sanitize title and sku
      function sanitizeTitleAndSku(string) {
          return string
              .toLowerCase()
              .normalize('NFD')
              .replace(/[\u0300-\u036f]/g, '')
              .replace(/[^a-z0-9]+/g, '-')
              .replace(/^-+|-+$/g, '')
              .substring(0, 150);
      }

      // Helper function to sanitize permLink
      function sanitizePermLink(string) {
          return string
              .toLowerCase()
              .normalize('NFD')
              .replace(/[\u0300-\u036f]/g, '') // Remove accents
              .replace(/[^a-z0-9]+/g, '-')     // Replace special chars with dash
              .replace(/^-+|-+$/g, '')         // Remove leading/trailing dashes
              .substring(0, 150);              // Limit length
      }

      // Initialize Select2 with configuration
      $(document).ready(function() {
          $('#categories').select2({
              placeholder: 'Select categories',
              allowClear: true,
              width: '100%'
          }).on('change', function() {
              updateCategoryString();
          });

          // Initial update of category string
          updateCategoryString();
      });

      document.addEventListener('DOMContentLoaded', () => {
          const statusSelect = document.getElementById('status');
          const scheduleDiv = document.getElementById('dateSchedule');
          const scheduleInput = document.getElementById('postSchedule');

          // Show/hide schedule field based on initial status
          if (statusSelect.value === 'scheduled') {
              scheduleDiv.classList.remove('d-none');
              scheduleInput.setAttribute('required', 'required');
          }

          statusSelect.addEventListener('change', () => {
              if (statusSelect.value === 'scheduled') {
                  scheduleDiv.classList.remove('d-none');
                  scheduleInput.setAttribute('required', 'required');
              } else {
                  scheduleDiv.classList.add('d-none');
                  scheduleInput.removeAttribute('required');
                  scheduleInput.value = ''; // Clear the value when not scheduled
              }
          });
      });
      </script>

      

      
   </body>
</html>