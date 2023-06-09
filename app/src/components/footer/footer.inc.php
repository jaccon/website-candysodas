<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
// Social Links
$metaId = "b9c29334-d1c8-11ed-afa1-0242ac120002";
$whatsapp= CMS::isComponent($metaId,"whatsappLink");
$instagram= CMS::isComponent($metaId,"instagram");
$facebook= CMS::isComponent($metaId,"facebook");
$phone = CMS::isComponent($metaId,"phoneString");
$email = CMS::isComponent($metaId,"email");
$description = CMS::isComponent($metaId,"description");

?>
<footer class="section-t-space">
        <div class="container-fluid-lg">
            <div class="service-section">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="service-contain">
                            <div class="service-box">
                                <div class="service-detail">
                                    <h5> Os melhores produtos importados </h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-detail">
                                    <h5> Entrega para todo Brasil </h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-detail">
                                    <h5> Compra Segura </h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-detail">
                                    <h5> O melhor preço do mercado </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-footer section-b-space section-t-space">
                <div class="row g-md-4 g-3">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-logo">
                            <div class="theme-logo">
                                <a href="index.html">
                                    <img src="<?= $siteUrl; ?>/assets/images/logotipo.jpg" class="blur-up lazyload" alt="">
                                </a>
                            </div>

                            <div class="footer-logo-contain">
                                <p>
                                    <?= $description; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-title">
                            <h4> Categorias </h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <?php 
                                    $count = 0;
                                    foreach ($categories as $cat) {
                                        $title = $cat->title;
                                        $permLink = $siteUrl."/c/".$cat->permLink;
                                        $count++;
                                ?>
                                    <li>
                                        <a href="<?= $permLink; ?>" class="text-content">
                                            <?= $title; ?>
                                        </a>
                                    </li>
                                <?php } ?>


                            </ul>
                        </div>
                    </div>

                    <div class="col-xl col-lg-2 col-sm-3">
                        <div class="footer-title">
                            <h4> Links Úteis </h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="<?= $siteUrl; ?>/index.html" class="text-content">Home</a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/produtos.html" class="text-content"> Produtos </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/sobre.html" class="text-content"> Sobre Nós </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/noticias.html" class="text-content"> Notícias </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/contato.html" class="text-content"> Contato </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-2 col-sm-3">
                        <div class="footer-title">
                            <h4> Ajuda </h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="<?= $siteUrl; ?>/orders.html" class="text-content">
                                        Seu pedido
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/account.html" class="text-content">
                                        Sua conta
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/order-tracking.html" class="text-content">
                                        Verificar pedido
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/wishlist.html" class="text-content">
                                        Favoritos </a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-title">
                            <h4>Entre em contato </h4>
                        </div>

                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <div class="footer-number">
                                        <i data-feather="phone"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">Atendimento :</h6>
                                            <h5> <?= $phone; ?> </h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="footer-number">
                                        <i data-feather="mail"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">E-mail  :</h6>
                                            <h5> <?= $email; ?> </h5>
                                        </div>
                                    </div>
                                </li>

                                <li class="social-app mb-0">
                                    <h5 class="mb-2 text-content">Baixe nosso aplicativo: </h5>
                                    <ul>
                                        <li class="mb-0">
                                            <a href="<?= $appAndroid; ?>" target="_blank">
                                                <img src="<?= $siteUrl; ?>/assets/images/playstore.svg" class="blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li class="mb-0">
                                            <a href="<?= $appiOS; ?>" target="_blank">
                                                <img src="<?= $siteUrl; ?>/assets/images/appstore.svg" class="blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-footer section-small-space">
                <div class="reserve">
                    <h6 class="text-content"><?= date('Y'); ?> Candy Sodas ® </h6>
                </div>

                <div class="payment">
                    <img src="<?= $siteUrl; ?>/assets/images/1.png" class="blur-up lazyload" alt="">
                </div>

                <div class="social-link">
                    <h6 class="text-content"> Siga-nos </h6>
                    <ul>
                        <li>
                            <a href="<?= $facebook; ?>" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $instagram; ?>" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $whatsapp; ?>" target="_blank">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>