<?php
include('../config.inc.php');
global $CONFIG;
$pageId="0608f566-cc20-11ed-afa1-0242ac120002";
$metaDescription = Commerce::getCommerceSettings('daa548ea-f152-11ed-a05b-0242ac120003','description');
$title = CMS::isPage($pageId, "slug");
$featuredImage = CMS::isPage($pageId, "featuredImage");
$siteUrl = $CONFIG['CONF']['siteUrl'];
$tel="+55 11 95569-6541";

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
    <?php include('../components/banners/default.inc.php'); ?>
    <?php include('../components/banners/secondary.inc.php'); ?>
    <?php include('../components/home/home.inc.php'); ?>
    <?php include('../components/newsletter/newsletter.inc.php'); ?>
    <?php include('../components/footer/footer.inc.php'); ?>
    <?php include('../components/banner-cookie-consent.inc.php'); ?>
    <?php include('../components/deal/deal.inc.php'); ?>

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