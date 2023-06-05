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

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />    
    <meta name="description" content="" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <title> <?= $pageTitle." - ".$defaultTitle; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- [if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif] -->
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/fontawesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/magnific-popup.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/loader.min.css">    
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,800,800i,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&amp;subset=latin-ext" rel="stylesheet"> 
 
</head>

<body>

	<div class="page-wraper"> 
       	
        <?php include('../components/header/header.inc.php'); ?>
        
        <div class="page-content">
        
            <div class="wt-bnr-inr overlay-wraper bg-parallax bg-top-center"  
              data-stellar-background-ratio="0.5"  
              style="background-image:url(<?= $pageBackground; ?>);" >
            	<div class="overlay-main bg-black opacity-07"></div>
                <div class="container">
                    <div class="wt-bnr-inr-entry">
                    	<div class="banner-title-outer">
                        	<div class="banner-title-name">
                        		<h2 class="text-white text-uppercase letter-spacing-5 font-18 font-weight-300"> 
                              <?= $slug; ?> 
                            </h2>
                            </div>
                        </div>
                        <div class="p-tb20">
                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="javascript:void(0);">Home</a></li>
                                    <li> <?= $slug; ?> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
            <div class="section-full p-tb90 bg-gray square_shape2">
                <div class="container">
                    <div class="section-content ">
                    	<div class="row">
                        	<div class="col-md-5 col-sm-6">
                            	<div class="m-about m-l50 m-r50">
                            		<div class="owl-carousel about-us-carousel owl-btn-bottom-right">

                                        <?php 
                                          foreach ($data as $key => $value) {
                                              $count++;
                                              $featuredImage = CMS::getImage($value);
                                        ?>
                                          <div class="item">
                                              <div class="ow-img wt-img-effect zoom-slow">
                                                  <a href="javascript:void(0);"><img src="<?= $featuredImage; ?>" alt=""></a>
                                              </div>
                                          </div>
                                        <?php } ?>
                                   </div>
                               </div>
                            </div>
                              <div class="col-md-6 col-sm-6">
                                    <div class="m-about-containt text-black p-t30">
                                          <span class="font-30 font-weight-300"> <?= $slug; ?> </span>
                                          <h2 class="font-40"> <?= $description; ?></h2>
                                          <p class="font-10">
                                              <?= $content; ?>
                                          </p>
                                      </div>
                                  </div>                            
                              </div>
                    </div>

                    
                  </div>
                </div>   
                
                <?php include('../components/newsletter/newsletter.inc.php'); ?>
        </div>
        
        <?php include('../components/footer/footer.inc.php'); ?>
        
		<button class="scroltop">
            <span class="fa fa-angle-up  relative" id="btn-vibrate"></span>
        </button>
        
    </div>

<script  src="<?= $siteUrl; ?>/assets/js/jquery-1.12.4.min.js"></script><!-- JQUERY.MIN JS -->
<script  src="<?= $siteUrl; ?>/assets/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script  src="<?= $siteUrl; ?>/assets/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
<script  src="<?= $siteUrl; ?>/assets/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script  src="<?= $siteUrl; ?>/assets/js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script  src="<?= $siteUrl; ?>/assets/js/waypoints-sticky.min.js"></script><!-- COUNTERUP JS -->
<script  src="<?= $siteUrl; ?>/assets/js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
<script  src="<?= $siteUrl; ?>/assets/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
<script  src="<?= $siteUrl; ?>/assets/js/stellar.min.js"></script><!-- PARALLAX BG IMAGE   --> 
<script  src="<?= $siteUrl; ?>/assets/js/scrolla.min.js"></script><!-- ON SCROLL CONTENT ANIMTE   --> 
<script  src="<?= $siteUrl; ?>/assets/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script  src="<?= $siteUrl; ?>/assets/js/shortcode.js"></script><!-- SHORTCODE FUCTIONS  -->

</body>

</html>