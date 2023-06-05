<?php
include('../config.inc.php');
global $CONFIG;
$pageId="e7675e7a-c5ff-11ed-afa1-0242ac120002";
$metaId="b9c29334-d1c8-11ed-afa1-0242ac120002";
$metaDescription = Commerce::getCommerceSettings('daa548ea-f152-11ed-a05b-0242ac120003','description');
$title = CMS::isPage($pageId, "title");
$siteUrl = $CONFIG['CONF']['siteUrl'];
$content = CMS::isPage($pageId, "content");
$slug = CMS::isPage($pageId, "slug");
$featuredImage = CMS::isPage($pageId, "featuredImage");
$pageBackground = CMS::getImage(CMS::isPage($pageId, "pageBackground"));

$tel = CMS::isComponent($metaId,"telString");
$email = CMS::isComponent($metaId,"email");
$address = CMS::isComponent($metaId,"address");

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
    <title>
      <?= $title; ?>
    </title>
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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,800,800i,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i&amp;subset=latin-ext" rel="stylesheet"> 
</head>

<body id="bg">

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
             
            <div class="section-full p-tb80">
                <!-- LOCATION BLOCK-->
                <div class="container">
                    <!-- TITLE START -->
                    <div class="section-head text-left text-black">
                        <h2 class="text-uppercase font-36"> Canais de contato </h2>
                        <p> Para entrar em contato preencha o formulário abaixo com suas informações que em breve entraremos em contato </p>
                        <div class="wt-separator-outer">
                            <div class="wt-separator bg-black"></div>
                        </div>
                    </div>
                    <!-- TITLE END -->                
                    <!-- GOOGLE MAP & CONTACT FORM -->
                    <div class="section-content">
                        <!-- CONTACT FORM-->
                        <div class="wt-box">
                            <form class="contact-form cons-contact-form" method="post" action="http://thememajestic.com/modern/form-handler.php">
                            	<div class="contact-one p-a40 p-r150">
                                            <div class="form-group">
                                                <input name="name" type="text" required class="form-control" placeholder="Nome Completo">
                                            </div>
                                       
                                            <div class="form-group">
                                                <input name="email" type="text" class="form-control" required placeholder="E-mail">
                                            </div>
                                       
                                            <div class="form-group">
                                                <textarea name="message" rows="3" class="form-control " required placeholder="Mensagem"></textarea>
                                            </div>
                                        
                                            <button name="submit" type="submit" value="Submit" class="site-button black radius-no text-uppercase">
                                                    <span class="font-12 letter-spacing-5">Enviar</span>
                                            </button>
                                            
                                            <div class="contact-info bg-black text-white p-a30">
                                                <div class="wt-icon-box-wraper left p-b30">
                                                    <div class="icon-sm"><i class="iconmoon-smartphone-1"></i></div>
                                                    <div class="icon-content text-white ">
                                                        <h5 class="m-t0 text-uppercase">Telefone</h5>
                                                        <p>
                                                          <?= $tel; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="wt-icon-box-wraper left p-b30">
                                                    <div class="icon-sm"><i class="iconmoon-email"></i></div>
                                                    <div class="icon-content text-white">
                                                        <h5 class="m-t0  text-uppercase">E-mail</h5>
                                                        <p>
                                                          <?= $email; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="wt-icon-box-wraper left">
                                                    <div class="icon-sm"><i class="iconmoon-travel"></i></div>
                                                    <div class="icon-content text-white">
                                                        <h5 class="m-t0  text-uppercase">Endereço</h5>
                                                        <p>
                                                          <?= $address; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
           
            <div class="section-full">
                <div class="gmap-outline">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.329968320653!2d-46.59762738502224!3d-23.55658978468532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce594b05d7b257%3A0x44ac6f1f1ea23459!2sR.%20dos%20Capit%C3%A3es%20Mores%2C%20306%20-%20Mooca%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2003167-030!5e0!3m2!1sen!2sbr!4v1685899971307!5m2!1sen!2sbr" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
           </div>           
            
        </div>
      
        <?php include('../components/footer/footer.inc.php'); ?>
    
		    <button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>
        
    </div>
    
<script  src="<?= $siteUrl; ?>/assets/js/jquery-1.12.4.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/bootstrap.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/magnific-popup.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/waypoints.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/counterup.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/waypoints-sticky.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/isotope.pkgd.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/owl.carousel.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/stellar.min.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/scrolla.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqwdZHU6gzIhPBEB2VNbIydp4coZmNPy0&amp;callback=initMap"  ></script>
<script  src="<?= $siteUrl; ?>/assets/js/map.script.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/custom.js"></script>
<script  src="<?= $siteUrl; ?>/assets/js/shortcode.js"></script>
</body>

</html>
