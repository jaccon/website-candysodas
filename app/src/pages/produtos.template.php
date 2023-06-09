<?php
include('../config.inc.php');
global $CONFIG;
$pageId="55611fd2-06cf-11ee-be56-0242ac120002";
$metaDescription = Commerce::getCommerceSettings('daa548ea-f152-11ed-a05b-0242ac120003','description');
$title = CMS::isPage($pageId, "title");
$siteUrl = $CONFIG['CONF']['siteUrl'];
$content = CMS::isPage($pageId, "content");
$slug = CMS::isPage($pageId, "slug");
$pageBackground = CMS::getImage(CMS::isPage($pageId, "pageBackground"));

$metaId = "650660fe-01d0-11ee-be56-0242ac120002";
$data= CMS::isComponent($metaId,"images");

// SEO
$metaIdSeo = "0ff54848-c781-11ed-afa1-0242ac120002";
$pageTitle = Seo::isSeo($metaIdSeo, "defaultPageTitle")." - ".$title;
$siteDescription = Seo::isSeo($metaIdSeo, "description");
$siteAuthor = Seo::isSeo($metaIdSeo, "author");
$keywords = Seo::isSeo($metaIdSeo, "keywords");
$favicon = Seo::isSeo($metaIdSeo, "favicon");

// Categories
$categories = Commerce::isCategories();

?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $siteDescription; ?>">
    <meta name="keywords" content="<?= $keywords; ?>">
    <meta name="author" content="<?= $author; ?>">
    <link rel="icon" href="<?= $favicon; ?>" type="image/x-icon">
    <title> 
        <?= $pageTitle; ?>
    </title>

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link id="rtl-link" rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" href="<?= $siteUrl; ?>/assets/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/bulk-style.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/animate.css">
    <link id="color-link" rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/style.css">
</head>

<body class="bg-effect">


    <?php include('../components/header/header.inc.php'); ?>
    <?php include('../components/mobile/menuStart.inc.php'); ?>

    <!--  -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2> <?= CMS::isPage($pageId, "title"); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <!--  -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-md-3">
                    <div class="left-box wow fadeInUp">
                        <div class="shop-left-sidebar">
                            
                            
                            <div class="accordion custome-accordion" id="accordionExample">
                                <div class="accordion-item">
                                   
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne">
                                        <div class="accordion-body">
                                            

                                            <h2 class="accordion-header" id="headingOne">
                                              Categorias
                                            </h2>

                                            <ul class="category-list custom-padding custom-height mt-4">
                                                <?php 
                                                    $count = 0;
                                                    foreach ($categories as $cat) {
                                                        $title = $cat->title;
                                                        $permLink = $siteUrl."/c/".$cat->permLink.".html";
                                                        $count++;
                                                ?>
                                                  <li>
                                                      <a href="<?= $permLink; ?>" 
                                                        class="categories" 
                                                        alt="<?= $title; ?>">
                                                        <?= $title; ?>
                                                      </a>
                                                  </li>
                                                <?php } ?>
                                              
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Banner Sidebar -->
                                <?php include('../components/banners/banner-sidebar-01.php'); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>
                        
                    </div>

                    <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section list-style">
                        
                        <!--  -->
                        <?php 
                                $data= Commerce::isProducts();
                                $count = 0;
                                $productPorPagina = 10000;
                                foreach ($data as $item) {
                                    $count++;
                                    $featuredImage =  Commerce::normalizeFeatureImage($item->featuredImage);
                                    $title = $item->title;
                                    $priceList = $item->priceList;
                                    $priceSale = Commerce::normalizePricebook($item->priceSale);
                                    $description = $item->description;
                                    $id = $item->id;
                                    $category = Commerce::getCategoryTitle($item->categories);
                                    $vproducts = '';
                                    $vproductsTitle = '';
                                    $sku = $item->sku;
                                    $tags = $item->tags;
                                    $variationMaster = $item->variationMaster;
                                    $productType = $item->productType;
                                    $permLink = $siteUrl."/p/".$id.".html";
                                    $weight = $item->weight;

                                    if($count <= $productPorPagina AND $productType != 'variation' AND $item->status == "enabled") {
                          ?>
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="<?= $permLink; ?>">
                                                <img src="<?= $featuredImage; ?>"
                                                    class="img-fluid blur-up lazyload" alt="<?= $title; ?>">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhes">
                                                    <a href="<?= $permLink; ?>" alt="<?= $title; ?>">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="<?= $siteUrl; ?>/wishlist.html" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">
                                              <?= $title; ?>
                                            </span>
                                            <a href="<?= $permLink; ?>">
                                                <h5 class="name">
                                                  <?= $title; ?>
                                                </h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">
                                              <?= $description; ?>
                                            </p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                    <li>
                                                      <i data-feather="star" class="fill"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <h6 class="unit">
                                              <?= $weight; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                        <!--  -->

                    </div>

                    
                </div>

            </div>
        </div>
    </section>
    <!--  -->
    
    <?php include('../components/footer/footer.inc.php'); ?>

    <div class="bg-overlay"></div>

    <script src="<?= $siteUrl; ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/bootstrap/bootstrap-notify.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/feather/feather.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/feather/feather-icon.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/lazysizes.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/slick/slick.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/slick/slick-animation.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/slick/custom_slick.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/auto-height.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/timer1.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/fly-cart.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/quantity-2.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/wow.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/custom-wow.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/script.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/theme-setting.js"></script>
</body>

</html>