<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
$categories = Commerce::isCategories();
$logotipo = $siteUrl."/assets/images/logotipo-acalanto.png";
?>
<header class="main-header two">
    <div class="header-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Left Box -->
                <div class="left-box d-flex align-items-center">
                    <!-- Social Box -->
                    <ul class="social-box">
                        <li><a href="<?= CMS::getSiteConfigurationData("social_instagram"); ?>" class="fa fa-instagram"></a></li>
                        <li><a href="<?= CMS::getSiteConfigurationData("social_facebook"); ?>" class="fa fa-facebook-f"></a></li>
                        <li><a href="<?= CMS::getSiteConfigurationData("social_linkedin"); ?>" class="fa fa-linkedin"></a></li>
                    </ul>
                </div>
                
                <!-- Right Box -->
                <div class="right-box d-flex align-items-center">
                    <ul class="info-list">
                        <li><a href="mailto:<?= CMS::getSiteConfigurationData("email_default"); ?>"><span class="icon fa fa-envelope"></span> <?= CMS::getSiteConfigurationData("email_default"); ?> </a></li>
                        <li><a href="https://www.google.com/maps/@-23.502049,-46.6577964,3a,90y,318.85h,85.44t/data=!3m6!1e1!3m4!1s5LrtQNsih7lofMWtCbTKyQ!2e0!7i16384!8i8192?coh=205409&entry=ttu" target="_blank"><span class="icon fa fa-map-marker"></span>R. Guarizinho,35 - Casa Verde - SP</a></li>
                    </ul>

                    <!-- Button Box -->
                    <div class="button-box d-none d-lg-flex">
                        <a href="#contato" class="btn clearfix">
                            <span class="btn-wrap">
                                <span class="text-one">Fale Conosco</span>
                                <span class="text-two">Fale Conosco</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="header-lower">
        
        <div class="container">
            <div class="inner-container d-flex justify-content-between align-items-center">
                
                <div class="logo-box">
                    <!-- Logo -->
                    <div class="logo"><a href="index.html"><img src="<?= $siteUrl; ?>/assets/images/logo.svg" alt="img" title=""></a></div>
                </div>
                <div class="nav-outer d-flex align-items-center">
                    
                    <!-- Main Menu -->
                    <nav class="main-menu d-none d-lg-block">
                        <div class="navbar-collapse collapse clearfix" >
                            <ul class="navigation clearfix">
                                <li class="">
                                    <a href="index.html">Home</a>
                                </li>
                                <li>
                                    <a href="#sobrenos">Sobre Nós</a>
                                </li>
                                </li>
                                <li><a href="#nossos-servicos"> Serviços </a></li>
                                <!--<li class="dropdown"><a href="index.html#">Produtos</a>
                                    <ul>
                                        <li><a href="service.html">Service One</a></li>
                                        <li><a href="service-2.html">Service Two</a></li>
                                        <li><a href="service-details.html">Service Details</a></li>
                                    </ul>-->
                                </li>
                                
                                <li><a href="#marcas">Marcas</a></li>
                                <!--<li class="dropdown"><a href="index.html#">Marcas</a>
                                    <ul>
                                        <li><a href="blog.html">Blog Standard</a></li>
                                        <li><a href="blog-2.html">Blog Grid</a></li>
                                        <li><a href="blog-3.html">Blog Grid with Sidebar</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>-->
                                </li>
                                <li><a href="#diferenciais"> Diferenciais </a></li>
                                <!--<li class="dropdown"><a href="index.html#">Treinamentos</a>
                                    <ul>
                                        <li><a href="blog.html">Blog Standard</a></li>
                                        <li><a href="blog-2.html">Blog Grid</a></li>
                                        <li><a href="blog-3.html">Blog Grid with Sidebar</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>-->
                                </li>
                                
                                <li><a href="#contato">Contato</a></li>
                            </ul>
                        </div>
                        
                    </nav>
                    <!-- Main Menu End-->
                    
                    <!-- Outer Box -->
                    <div class="outer-box d-flex align-items-center">
                        
                        <!-- Header Search -->
                        <!-- <div class="header_search d-none d-sm-block">
                            <form class="search_form" action="https://wpthemebooster.com/demo/themeforest/html/jackcerra/consultancy/search.php">
                                <input type="text" name="search" class="keyword form-control" placeholder="Pesquisar" />
                                <button type="submit" class="form-control-submit"><img src="<?= $siteUrl; ?>/assets/images/icons/search.png" alt="img"></button>
                            </form>
                        </div> -->
                            
                        <!-- Aside Panel 
                        <a href="index.html#" class="aside_open d-none d-sm-block"><img src="<?= $siteUrl; ?>/assets/images/icons/menu.png" alt="img"></a> -->
                        
                        <!-- Responsive Menu -->
                        <button class="ma5menu__toggle d-lg-none d-block ms-3" type="button">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                    <!-- End Outer Box -->
                    
                </div>
                    
            </div>
            
        </div>
    </div>
</header>