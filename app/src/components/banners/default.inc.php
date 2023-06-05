<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
?>
<section class="home-section pt-2">
        <div class="container-fluid-lg">
            <div class="row g-4">

                <div class="col-xl-8 ratio_65">
                    <div class="home-contain h-100">
                        <div class="h-100">
                            <img src="<?= $siteUlr; ?>/assets/images/banner-01.jpg" class="bg-img blur-up lazyload" alt="">
                        </div>
                        <div class="home-detail p-center-left w-75">
                            <div>
                                <h1 class="text-uppercase text-white"> Tudo para sua saúde diária </h1>
                                <p class="w-75 d-none d-sm-block text-white"> Conheça as águas minerais Healsi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 ratio_65">
                    <div class="row g-4">
                        <div class="col-xl-12 col-md-6">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/2.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-center-left home-p-sm w-75">
                                    <div>
                                        </h2>
                                        <h3 class="theme-color">Nut Collection</h3>
                                        <p class="w-75">We deliver organic vegetables & fruits</p>
                                        <a href="shop-left-sidebar.html" class="shop-button">Shop Now <i
                                                class="fa-solid fa-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-6">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/3.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-center-left home-p-sm w-75">
                                    <div>
                                        <h3 class="mt-0 theme-color fw-bold">Healthy Food</h3>
                                        <h4 class="text-danger">Organic Market</h4>
                                        <p class="organic">Start your daily shopping with some Organic food</p>
                                        <a href="shop-left-sidebar.html" class="shop-button">Shop Now <i
                                                class="fa-solid fa-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>