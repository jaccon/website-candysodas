<?php 
include('../../../config.inc.php');
$baseUrl = $CONFIG['CONF']['siteUrl'];
$pageId = "index";
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
      <meta charset="utf-8"/>
      <title> Balboa Comércio Serviços &amp; Importação e Exportação Ltda</title>
      <meta name="description" content="Creative Agency, Marketing Agency Template">
      <meta name="keywords" content="Creative Agency, Marketing Agency">
      <meta name="author" content="rajesh-doot">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="theme-color" content="#fff">
      <link href="<?= $baseUrl; ?>/assets/images/favicon.png" rel="icon">
      <link href="<?= $baseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?= $baseUrl; ?>/assets/css/plugin.min.css" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
      <link href="<?= $baseUrl; ?>/assets/css/style.css" rel="stylesheet">
      <link href="<?= $baseUrl; ?>/assets/css/responsive.css" rel="stylesheet">
      <link href="<?= $baseUrl; ?>/assets/css/darkmode.css" rel="stylesheet">
   </head>
   <body>
      <?php include('../components/loader/loader.php'); ?>
      <?php include('../components/header/header.php'); ?>
      <?php include('../components/slider/hero.php'); ?>
      <?php include('../components/about/about.php'); ?>
      <?php //include('../components/distributors/distributors.php'); ?>
      <?php //include('../components/histories/histories.php'); ?>
      <?php include('../components/brands/brands.php'); ?>
      <?php include('../components/footer/footer.php'); ?>
      <?php include('../components/banner-cookie-consent.inc.php'); ?>
      <?php include('../components/whatsapp-button.inc.php'); ?>

      <script src="<?= $baseUrl; ?>/assets/js/vendor/modernizr-3.5.0.min.js"></script>
      <script src="<?= $baseUrl; ?>/assets/js/jquery.min.js"></script>
      <script src="<?= $baseUrl; ?>/assets/js/jquery.cookie.js"></script>
      <script src="<?= $baseUrl; ?>/assets/js/bootstrap.bundle.min.js"></script> 
      <script src="<?= $baseUrl; ?>/assets/js/plugin.min.js"></script>
      <script src="<?= $baseUrl; ?>/assets/js/preloader.js"></script>
      <script src="<?= $baseUrl; ?>/assets/js/dark-mode.js"></script>
      <script src="<?= $baseUrl; ?>/assets/js/main.js"></script>
      <script src="<?= $siteUrl; ?>/assets/js/pagefai.js"></script>
      
   </body>
</html>