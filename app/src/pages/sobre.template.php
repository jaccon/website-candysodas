<?php
include('../config.inc.php');
global $CONFIG;
$pageId="f38ff21c-c5ea-11ed-afa1-0242ac120002";
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

    <section class="fresh-vegetable-section section-lg-space">
        <div class="container-fluid-lg">
            <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
                
                <div class="col-xl-6 col-12">
                    <div class="fresh-contain p-center-left">
                        <div>
                            <div class="review-title">
                                <h2>
                                    <?= $description; ?>
                                </h2>
                            </div>

                            <div class="delivery-list">
                                <p class="text-content">
                                    <?= $content; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-12">
                    <div class="row g-sm-4 g-2">
                        <div class="col-6">
                            <div class="fresh-image-2">
                                <div>
                                    <img src="../assets/images/inner-page/about-us/1.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="fresh-image">
                                <div>
                                    <img src="../assets/images/inner-page/about-us/2.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                            </div>
                        </div>
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