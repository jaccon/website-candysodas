<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
// Social Links
$metaId = "b9c29334-d1c8-11ed-afa1-0242ac120002";
$whatsapp= CMS::isComponent($metaId,"whatsappLink");
$instagram= CMS::isComponent($metaId,"instagram");
$facebook= CMS::isComponent($metaId,"facebook");
$phone = CMS::isComponent($metaId,"phoneString");
$phoneNumber = CMS::isComponent($metaId,"phoneNumber");
$email = CMS::isComponent($metaId,"email");
$description = CMS::isComponent($metaId,"description");
$addr = CMS::isComponent($metaId,"address");
$logotipo = $siteUrl."/assets/images/logo_white.svg";
?>

<footer class="main-footer">
    <div class="container">
        
        <div class="upper-box">
            <div class="row clearfix align-items-center">
            </div>
        </div>
        
        <!-- Widgets Section -->
        <div class="widgets-section">
            <div class="row clearfix">
            
                <!-- Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">
                        
                        <!-- Footer Column -->
                        <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                        <!-- Logo Column -->
                <div class="logo-column col-lg-12 col-md-12 col-sm-12">
                    <div class="logo"><a href="index.html"><img src="<?= $siteUrl; ?>/assets/images/logo_white.svg" alt="img" title="" width="200"></a></div>
                </div>
                        </div>
                        
                        <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4>Quem Somos</h4>
                                <ul class="links">
                                    <li><a href="#sobrenos">Sobre Nós</a></li>
                                    <li><a href="#nossos-servicos"> Serviços </a></li>
                                    <li><a href="#marcas">Marcas</a></li>
                                    <li><a href="#diferenciais"> Diferenciais </a></li>
                                    <li><a href="#contato">Contato</a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">
                        
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4> Serviços </h4>
                                <ul class="links">
                                    <li><a href="#nossos-servicos"> Controle de Acesso </a></li>
                                    <li><a href="#nossos-servicos"> Instalação de CFTV </a></li>
                                    <li><a href="#nossos-servicos">Sistemas Fotovoltaicos </a></li>
                                    <li><a href="#nossos-servicos">Instalação de Alarmes </a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h4>contato</h4>
                                <ul class="contact-list">
                                    <li><span class="icon fa fa-phone"></span>(11) 4878-1001</span></li>
                                    <li><span class="icon fa fa-envelope"></span><a href="mailto:jackcerra@email.com">contato@dealershop.com.br</a></li>
                                    <li><span class="icon fa fa-map-marker"></span>R. Guarizinho,35 <br> Casa Verde - SP</li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="left-box">
                    <div class="copyright">&copy; 2024. Dealer Shop - Todos os direitos reservados.</div>
                </div>
                <div class="right-box d-flex">
                    <ul class="social-box">
                        <li><a href="https://www.facebook.com/dealershopdistribuicao" class="fa fa-facebook-f"></a></li>
                        <li><a href="https://www.instagram.com/dealershopdistribuicao" class="fa fa-instagram"></a></li>
                        <li><a href="https://www.linkedin.com/company/dealer-shop" class="fa fa-linkedin"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</footer>




    