<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
?>
<section class="home-section pt-2">
        <div class="container-fluid-lg">
            <div class="row g-4">

                <div class="col-xl-8 ratio_65">
                    <div class="home-contain h-100">
                        <a href="<?= $siteUlr; ?>/search.html?search=monster">
                            <div class="h-100">
                                <img src="<?= $siteUlr; ?>/assets/images/banner-01.jpg" class="bg-img blur-up lazyload" alt="">
                            </div>
                            
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 ratio_65">
                    <div class="row g-4">
                        <div class="col-xl-12 col-md-6">
                            <a href="<?= $siteUlr; ?>/search.html?search=Kit%20Kat">
                                <div class="home-contain">
                                    <img src="<?= $siteUlr; ?>/assets/images/banner-02.jpg" 
                                        class="bg-img blur-up lazyload"
                                        alt="">
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-12 col-md-6">
                            <a href="<?= $siteUlr; ?>/p/3eda71aa-05bc-11ee-be56-0242ac120002.html">
                                <div class="home-contain">
                                    <img src="<?= $siteUlr; ?>/assets/images/banner-03.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>