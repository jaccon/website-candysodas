<section class="banner-section ratio_60 wow fadeInUp">
        <div class="container-fluid-lg">
            <div class="banner-slider">


                <?php 
                    $banners = CMS::getComponentsByMetaType('componentMetaSecondaryBanner');

                    $count = 0;
                    foreach ($banners as $banner) {
                        $title = $banner->title;
                        $permLink = $siteUrl.$banner->permLink;
                        $featuredImage = CMS::getImage($banner->featuredImage);
                        $count++;
                ?>
                <div>
                    <div class="banner-contain hover-effect">
                        <img src="<?= $featuredImage; ?>" class="bg-img blur-up lazyload" alt="">
                        <div class="banner-details">
                            <div class="banner-box ">
                                <h6 class="text-content text-banner-box"><?= $title; ?> </h6>
                            </div>
                            <a href="<?= $permLink; ?>" class="banner-button text-white">Ver Agora <i
                                    class="fa-solid fa-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
        </div>
    </section>