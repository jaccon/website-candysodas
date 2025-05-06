<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
$categories = Commerce::isCategories();

// Social Links
$metaId = "b9c29334-d1c8-11ed-afa1-0242ac120002";
$whatsapp= CMS::isComponent($metaId,"whatsappLink");
$instagram= CMS::isComponent($metaId,"instagram");
$linkedin= CMS::isComponent($metaId,"linkedin");
$facebook= CMS::isComponent($metaId,"facebook");
$phone = CMS::isComponent($metaId,"phoneString");
$email = CMS::isComponent($metaId,"email");
$address = CMS::isComponent($metaId,"address");
$logotipo = $siteUrl."/assets/images/logotipo-acalanto.png";
?>

<nav class="absolute transparent">
                <div class="nav-bar">
                    <div class="module left">
                        <a href="<?= $siteUrl; ?>">
                            <img class="logo logo-light" alt="Foundry" src="<?= $siteUrl; ?>/assets/img/logo-light.png" />
                            <img class="logo logo-dark" alt="Foundry" src="<?= $siteUrl; ?>/assets/img/logo-dark.png" />
                        </a>
                    </div>
                    <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="module-group right">
                        <div class="module left">
                            <ul class="menu">
                                <li>
                                    <a href="<?= $siteUrl; ?>">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/quem-somos.html">
                                        Quem Somos
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/servicos.html">
                                        Serviços 
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/portfolio.html">
                                        Portfólio
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $siteUrl; ?>/contato.html">
                                        Contato
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>