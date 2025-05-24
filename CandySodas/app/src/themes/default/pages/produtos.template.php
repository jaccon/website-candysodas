<?php 
include('../../../config.inc.php');
$baseUrl = $CONFIG['CONF']['siteUrl'];
$pageId = "index";
$pageTitle = "Produtos";

// load seo content
$title = Cms::getSiteConfigurationData('defaultPageTitle')." | ".$pageTitle;
$autor = Cms::getSiteConfigurationData('author');
$description = Cms::getSiteConfigurationData('description');
$keywords = Cms::getSiteConfigurationData('keywords');
$keywords = Cms::getSiteConfigurationData('keywords');
$favicon = Cms::getSiteConfigurationData('favicon');
$published = date('Y-m-d');
$siteUrl = $CONFIG['CONF']['siteUrl'];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <?php 
         Seo::seoRenderAttributes([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'image' => $image,
            'published' => $published,
            'author' => $autor,
            'type' => 'Article',
            'breadcrumbs' => [
               ['name' => 'Home', 'url' => $siteUrl],
               ['name' => 'Contato', 'url' => $siteUrl.'/contato.html'],
               ['name' => 'Produtos', 'url' => $siteUrl.'/produtos.html']
            ],
            'index' => true
            ]);
   ?>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="images/favicon.png" rel="icon">
   <link href="<?= $baseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $baseUrl; ?>/assets/css/plugin.min.css" rel="stylesheet">   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/<?= $baseUrl; ?>/assets/css/all.min.css" rel="stylesheet">   
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
	<link href="<?= $baseUrl; ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?= $baseUrl; ?>/assets/css/responsive.css" rel="stylesheet">
	<link href="<?= $baseUrl; ?>/assets/css/darkmode.css" rel="stylesheet">
  <style>
   .bg-btn {
        background: #ffbd84;
        background: -moz-linear-gradient(left, #61c5db 0, #ff1f8e 100%);
        background: -webkit-linear-gradient(left, #61c5db 0, #ff1f8e 100%);
        background: linear-gradient(to right, #61c5db 0, #ff1f8e 100%);
        -webkit-box-shadow: 0 10px 15px 0 rgba(175, 0, 87, 0.2);
        box-shadow: 0 10px 15px 0 rgba(175, 0, 87, 0.2);
    }
  </style>
 </head>
 <body>      
		
  <?php include('../components/header/header.php'); ?>
		
  <section class="breadcrumb-areav2" data-background="images/banner/4.jpg" style="background-image: url(&quot;images/banner/4.jpg&quot;);">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-7">
                  <div class="bread-titlev2">
                     <h1 class="wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                     <?= $pageTitle; ?> </h1>
                     <p class="mt20 wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        Utilize a barra de pesquisa para encontrar o produto desejado.
                      </p>
                     <div class="email-subs-form mt60">
                        <form action="search.html">
                           <input type="text" placeholder="Digite a nome ou SKU..." name="q" class="no-shadow">
                           <button 
                              type="submit" 
                              name="search" 
                              class="lnk btn-main bg-btn no-shadow"> Pesquisar produto 
                              <i class="fas fa-chevron-right fa-icon"></i>
                              <span class="circle"></span>
                            </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </section>

    <?php include('../components/products/products.php'); ?>
    <?php include('../components/brands/brands.php'); ?>
    <?php include('../components/listenyou/listenyou.php'); ?>
    <?php include('../components/footer/footer.php'); ?>
    <?php include('../components/whatsapp-button.inc.php'); ?>

<script src="<?= $baseUrl; ?>/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/jquery.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/bootstrap.bundle.min.js"></script> 
<script src="<?= $baseUrl; ?>/assets/js/plugin.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/dark-mode.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/main.js"></script>
</body>
</html>