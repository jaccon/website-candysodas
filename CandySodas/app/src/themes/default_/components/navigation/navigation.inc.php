<?php 
// include('../config.inc.php');
global $CONFIG;
$siteUrl=$CONFIG['CONF']['siteUrl'];
?>
<nav>
        <div class="header-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-sm-6 col-6">
                        <div class="logo text-left">
                            <a href="index.html"><img src="<?= $siteUrl; ?>/assets/images/logotipo-andorra-seguros.jpg" alt="" width="200"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-sm-6 col-6">
                        <a href="javascript:void(0)" class="hidden-lg hamburger">
                            <span class="h-top"></span>
                            <span class="h-middle"></span>
                            <span class="h-bottom"></span>
                        </a>
                        <nav class="main-nav">
                            <div class="logo mobile-ham-logo d-lg-none d-block text-left">
                                <a href="index.html"><img src="assets/images/logotipo-andorra-seguros.jpg" alt=""></a>
                            </div>
                            <ul>
                                <li><a class="active" href="<?= $siteUrl; ?>">Home</a> </li>
                                <li><a href="<?= $siteUrl; ?>/seguro-auto.html">Seguro Auto </a></li>
                                <li><a href="<?= $siteUrl; ?>/para-voce.html">Para Você </a></li>
                                <li><a href="<?= $siteUrl; ?>/para-seu-negocio.html">Para Seu Negócio </a></li>
                                <li><a href="<?= $siteUrl; ?>/atendimento-24-horas.html">Atendimento 24h </a></li>
                                <li><a href="<?= $siteUrl; ?>/sobre-agente.html"> Sobre a gente </a> </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                        <div class="btn-wrap menu-btn-wrap text-end">
                            <a class="common-btn menu-btn" href="<?= $siteUrl;?>/fale-conosco.html">
                            <i class="fas fa-plus"></i> 
                            Contato </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>