<?php
include('../config.inc.php');
global $CONFIG;
$productId=$_GET['id'];
$title = Commerce::getProductDetail($productId, 'title');
$description = Commerce::getProductDetail($productId, "description");
$longDescription = Commerce::getProductDetail($productId, "longDescription");
$sku = Commerce::getProductDetail($productId, "sku");
$weight = Commerce::getProductDetail($productId, "weight");
$siteUrl = $CONFIG['CONF']['siteUrl'];
$content = CMS::isPage($pageId, "content");
$slug = CMS::isPage($pageId, "slug");
$pageBackground = CMS::getImage(CMS::isPage($pageId, "pageBackground"));

// Contact
$metaId = "b9c29334-d1c8-11ed-afa1-0242ac120002";
$email= CMS::isComponent($metaId,"email");
$phoneString= CMS::isComponent($metaId,"phoneString");
$whatsapp= CMS::isComponent($metaId,"whatsapp");

// SEO
$metaIdSeo = "0ff54848-c781-11ed-afa1-0242ac120002";
$pageTitle = Seo::isSeo($metaIdSeo, "defaultPageTitle")." - ".$title;
$siteDescription = Seo::isSeo($metaIdSeo, "description");
$siteAuthor = Seo::isSeo($metaIdSeo, "author");
$keywords = Seo::isSeo($metaIdSeo, "keywords");
$favicon = Seo::isSeo($metaIdSeo, "favicon");


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
    <meta name="author" content="<?= $siteAuthor; ?>">
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

    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2> <?= Commerce::getProductDetail($productId, 'title'); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Product Info -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-sm-4 g-2">
                                <?php 
                                    $featuredImage = Commerce::normalizeFeatureImage(Commerce::getProductDetail($productId, "featuredImage"));
                                ?>
                                    <div class="col-12">
                                        <div class="product-main no-arrow">
                                            <div>
                                                <div class="slider-image">
                                                    <img src="<?= $featuredImage; ?>" id="img-1"
                                                        data-zoom-image="<?= $featuredImage; ?>" class="
                                                        img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="left-slider-image left-slider no-arrow slick-top">

                                            
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="<?= $featuredImage; ?>"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                            <?php ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp">
                            <div class="right-box-contain">
                                <h2 class="name">
                                    <?= Commerce::getProductDetail($productId, 'title'); ?>
                                </h2>
                                <div class="price-rating">
                                    <p class="theme-color "> R$ (Consulte) </p>
                                </div>

                                <div class="procuct-contain">
                                    <p>
                                        <?= $description; ?>
                                    </p>
                                </div>

                                <div class="product-packege">
                                    <div class="product-title">
                                        <h4> Peso </h4>
                                    </div>
                                    <ul class="select-packege">
                                       
                                        <li>
                                            <?= $weight; ?>
                                        </li>
                                    </ul>
                                </div>

                                <?php
                                /*
                                <div class="note-box product-packege">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <button type="button" class="qty-left-minus" data-type="minus"
                                                data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <button onclick="location.href = 'cart.html';"
                                        class="btn btn-md bg-dark cart-button text-white w-100">Add To Cart</button>
                                </div>
                                */
                                ?>

                                <div class="buy-box">
                                    <a href="wishlist.html">
                                        <i data-feather="heart"></i>
                                        <span>Adicionar aos Favoritos</span>
                                    </a>
                                </div>

                                <div class="paymnet-option">
                                    <div class="product-title">
                                        <h4> Qualidade garantida, entre em contato agora mesmo </h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="../assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="verndor-contain">
                                <div class="vendor-name">
                                    <h5 class="fw-500"> 
                                        SKU: <?= $sku; ?>
                                    </h5>
                                </div>
                            </div>

                            <p class="vendor-detail">
                                Se você precisar entrar em contato com nosso departamento comercial utilize nossos canais de atendimento
                            </p>

                            <div class="vendor-list">
                                <ul>
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="map-pin"></i>
                                            <h5>E-mail: <span class="text-content"><?= $email; ?> </span></h5>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="headphones"></i>
                                            <h5>Atendimento: <span class="text-content"><?= $phone; ?></span></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Novidades -->
            <div class="col-md-12 mt-4">
                <h3 class="mb-4"> Veja também </h3>
                <div class="product-border overflow-hidden wow fadeInUp">
                        <div class="product-box-slider no-arrow">

                            <?php 
                                $data= Commerce::isProducts();
                                $count = 0;
                                $productPorPagina = 20;
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

                                    if($count <= $productPorPagina AND $productType != 'variation' AND $item->status == "enabled") {
                            ?>
                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="<?= $permLink; ?>">
                                                    <img src="<?= $featuredImage; ?>"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <a href="<?= $permLink; ?>" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="<?= $permLink; ?>" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="<?= $permLink; ?>">
                                                    <h6 class="name h-100">
                                                        <?= $title; ?> </h6>
                                                </a>

                                                <div class="add-to-cart-box">
                                                   
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>

                        </div>
                    </div>
            </div>
            <!--  -->
         
        </div>
    </section>

    
    <?php include('../components/newsletter/newsletter.inc.php'); ?>
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