<?php 
include('../../../config.inc.php');
$baseUrl = $CONFIG['CONF']['siteUrl'];
$pageId = "index";
$pageTitle = "Contato";
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
 </head>
 <body>      
		
    <?php include('../components/header/header.php'); ?>
		
  <section class="breadcrumb-area banner-1" data-background="<?= $baseUrl;?>/assets/images/banner/9.jpg">
    <div class="text-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 v-center">
            <div class="bread-inner">
              <div class="bread-title">
                <h2> <?= $pageTitle; ?> </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include('../components/contact/contact.php'); ?>
  <?php include('../components/footer/footer.php'); ?>

<script src="<?= $baseUrl; ?>/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/jquery.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/bootstrap.bundle.min.js"></script> 
<script src="<?= $baseUrl; ?>/assets/js/plugin.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/dark-mode.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/main.js"></script>
</body>
</html>