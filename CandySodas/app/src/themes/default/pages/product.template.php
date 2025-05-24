<?php
include('../../../config.inc.php');
$baseUrl = $CONFIG['CONF']['siteUrl'];
$permLink = $_REQUEST['permLink'];
$id = Commerce::getProductIdfromPermLink($permLink);
$pageTitle = Commerce::getProductDetail($id,'title');
$title = Cms::getSiteConfigurationData('defaultPageTitle')." | ".$pageTitle;
$autor = Cms::getSiteConfigurationData('author');
$description = Commerce::getProductDetail($id,'content');
$keywords = Cms::getSiteConfigurationData('keywords');
$image = $CONFIG['CONF']['uploadUrl']."/products/".Commerce::getProductDetail($id,'featuredImage');
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
                        <?= Commerce::getProductDetail($id,'title'); ?> 
                     </h1>
                     <p class="mt20 wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <?= Commerce::getProductDetail($id,'description'); ?>
                      </p>
                  </div>
               </div>
            </div>
         </div>
    </section>

    <!--  -->
    <section class="shop-products-prvw pt20 pb60">
			<div class="container shop-container">
				<div class="row">

					<div class="col-lg-8">
						
						<div class="rpb-shop-prevw">
							<?php
								$featuredImage = $CONFIG['CONF']['uploadUrl']."/products/".Commerce::getProductDetail($id,'featuredImage');
							?>
							<img 
                src="<?= $featuredImage; ?>" 
                class="w-100" 
                alt="img"
                onerror="this.onerror=null;this.src='<?= $baseUrl; ?>/assets/images/no-image.jpg';"
              >
						</div>

						<div class="rpb-item-info">
							<div class="tab-17 tabs-layout">
								<div>
									<div class="mt20 tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1a">

										<h4 class="mb10">Descrição </h4>              
										<p class="mb30">
                      <?= utf8_decode(Commerce::getProductDetail($id,'content')); ?>
                    </p>

										<h4 class="mb10">Detalhes:</h4> 
										<ul class="ul-list mb30">
											<li>Gramagem: <?= Commerce::getProductDetail($id,'weight'); ?> </li>
											<li>Categoria: <?= Commerce::getProductDetail($id,'categories'); ?></li>                
											<li>SKU: <?= Commerce::getProductDetail($id,'sku'); ?> </li>                
										</ul>

									</div>

								</div>
							</div>
						</div>	
					</div>

					<div class="col-lg-4">

						<div class="rpb-item-infodv">
							<ul>
								<li class="price">
									<strong>SKU </strong>
									<div class="nx-rt">										
										<div class="rpb-itm-pric"> <?= Commerce::getProductDetail($id,'sku'); ?> </div>
									</div>
								</li>
								<li>
									<strong> Peso </strong>
									<div class="nx-rt"> <?= Commerce::getProductDetail($id,'weight'); ?> </div>
								</li>
								<li>
									<strong>Tags</strong>
									<div class="nx-rt"> <?= Commerce::getProductDetail($id,'tags'); ?> </div>
								</li>
								<li>
									<strong> Categorias </strong>
									<div class="nx-rt"> <?= Commerce::getProductDetail($id,'categories'); ?> </div>
								</li>
								
                <li>
									<a href="contato.html" class="btn-main bg-btn3 lnk w-100 mt10"> Entrar em contato <span class="circle"></span> </a>
								</li>
								
							</ul>
						</div>

						

					</div>
				</div>
			</div>
		</section>
    <!--  -->
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