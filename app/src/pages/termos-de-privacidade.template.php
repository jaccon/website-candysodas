<?php
include('../config.inc.php');
global $CONFIG;
$pageId="4b3de834-fe94-11ed-be56-0242ac120002";
$metaDescription = Commerce::getCommerceSettings('daa548ea-f152-11ed-a05b-0242ac120003','description');
$title = CMS::isPage($pageId, "title");
$siteUrl = $CONFIG['CONF']['siteUrl'];
$content = CMS::isPage($pageId, "content");
$slug = CMS::isPage($pageId, "slug");
$featuredImage = CMS::isPage($pageId, "featuredImage");
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> <?= CMS::defaultPageTitle()." - ".$title; ?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/plugin.css">
        <link rel="stylesheet" href="assets/css/bundle.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
            
            <div class="exporso_wrapper">
                
              <?php include('../components/header/header.inc.php'); ?>
                
                
                <!--Breadcrumb section-->
                <div class="breadcrumb_section">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="breadcrumb_inner">
                                    <ul>
                                        <li><a href="<?= $siteUrl; ?>">Home</a></li>
                                        <li><i class="zmdi zmdi-chevron-right"></i></li>
                                        <li> <?= $title; ?> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Breadcrumb section end-->
                
                <!--About us start-->
                 <div class="about-us bg-gray mb-105">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="about-description">
                                        <div class="about-content">
                                            <h3><?= $title; ?> </h3>
                                            <div class="about-read">
                                               
                                                <p class="text-2">
                                                    <?= $content; ?>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php include('../components/newsletter/newsletter.php'); ?>
                <?php include('../components/footer/footer.inc.php'); ?>
            </div>

        <script src="<?= $siteUrl; ?>/assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="<?= $siteUrl; ?>/assets/js/popper.js"></script>
        <script src="<?= $siteUrl; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?= $siteUrl; ?>/assets/js/plugins.js"></script>
        <script src="<?= $siteUrl; ?>/assets/js/main.js"></script>
    </body>
</html>
