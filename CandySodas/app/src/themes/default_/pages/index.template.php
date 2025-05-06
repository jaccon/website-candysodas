<?php
include('../../../config.inc.php');
global $CONFIG;
$pageId="0608f566-cc20-11ed-afa1-0242ac120002";

$featuredImage = CMS::isPage($pageId, "featuredImage");

// Site Configuration
$siteUrl = $CONFIG['CONF']['siteUrl'];

// SEO
$metaIdSeo = "423cf0ca-6e66-11ef-b864-0242ac120002";
$pgTitle = CMS::getSiteConfigurationData("defaultPageTitle");
$siteDescription = CMS::getSiteConfigurationData("description");
$siteAuthor = CMS::getSiteConfigurationData("author");
$keywords = CMS::getSiteConfigurationData("keywords");
$favicon = CMS::getSiteConfigurationData("favicon");

?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="<?= $siteDescription; ?>">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?= $siteUrl; ?>/assets/images/favicon.png" type="image/x-icon">
        <link rel="icon" href="<?= $siteUrl; ?>/assets/images/favicon.png" type="image/x-icon">
		    <title> <?= $pgTitle; ?> </title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $siteDescription; ?>">
        <meta name="keywords" content="<?= $keywords; ?>">
        <meta name="author" content="<?= $siteAuthor; ?>">
		    <link href="<?= $siteUrl; ?>/assets/css/main.css" rel="stylesheet">

				<style> 
					.logo {
							width: 300px;
					}
				</style>

				<?php include('../components/opengraph.inc.php'); ?>
				
	</head>

	<body>

		<div class="page-wrapper">
			
			<?php //include('../components/loading/loading.inc.php'); ?>
			<?php include('../components/header/header.inc.php'); ?>

			<div class="aside_info">
				<div class="aside_close"><i class="fa fa-close"></i></div>
				<div class="logo-side">
					<a href="<?= $siteUrl; ?>index.html">
						<img src="<?= $siteUrl; ?>/assets/images/logo.svg" alt="img">
					</a>
				</div>
				<div class="side-about-info">
					<h5>Sobre Nós</h5>
					<p>A Dealer Shop Distribuidora é uma empresa jovem, moderna e entrega a melhor Solução quando o assunto é desenvolvimento de projetos.</p>
				</div>

				<div class="side-contact-info">
					<h5>Entre em contato</h5>
					<p><a href="mailto:contato@dealershop.com.br">contato@dealershop.com.br</a></p>
					<p>(11) 4878-1001</p>
					<p>R. Guarizinho, 35 - Casa Verde - SP</p>
				</div>
				
				<div class="aside-social">
					<ul class="d-flex align-items-center justify-content-center">
						<li class="facebook"><a href="index.html#"><i class="fa fa-facebook"></i></a></li>
						<li class="twitter"><a href="index.html#"><i class="fa fa-twitter"></i></a></li>
						<li class="youtube"><a href="index.html#"><i class="fa fa-youtube"></i></a></li>
						<li class="instagram"><a href="index.html#"><i class="fa fa-instagram"></i></a></li>
						<li class="linkedin"><a href="index.html#"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>

			</div>
			
			<?php include('../components/slider/hero.inc.php'); ?>
			<?php include('../components/about/about.inc.php'); ?>
			<?php include('../components/comofunciona/comofunciona.inc.php'); ?>
			<?php include('../components/cftv/cftv.inc.php'); ?>
			<?php include('../components/distribuicao/distribuicao.inc.php'); ?>
			<?php //include('../components/treinamentos/treinamentos.inc.php'); ?>
			<?php include('../components/ourCustomers/ourCustomers.inc.php'); ?>
			<?php include('../components/brands/brands.inc.php'); ?>
			<?php include('../components/contact/contact.inc.php'); ?>
			<?php include('../components/footer/footer.inc.php'); ?>
			<?php include('../components/whatsapp-button.inc.php'); ?>
			<?php include('../components/banner-cookie-consent.inc.php'); ?>
			
		</div>

		<div class="progress-wrap active-progress">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
			<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;"></path>
			</svg>
		</div>

		<script src="<?= $siteUrl; ?>/assets/js/jquery.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/jquery.cookie.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/popper.min.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/bootstrap.min.js"></script>	
    <script src="<?= $siteUrl; ?>/assets/plugins/menu/ma5-menu.min.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/magnific-popup.min.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/appear.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/tilt.jquery.min.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/owl.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/wow.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/odometer.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/jquery-ui.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/script.js"></script>
		<script src="<?= $siteUrl; ?>/assets/js/pagefai.js"></script>

	</body>
</html>