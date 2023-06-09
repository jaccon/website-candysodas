<?php 
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
$categories = Commerce::isCategories();
?>
<section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        <div class="category-menu">
                            <h3> Categorias </h3>
                            <ul>

                                <?php 
                                    $count = 0;
                                    foreach ($categories as $cat) {
                                        $title = $cat->title;
                                        $permLink = $siteUrl."/c/".$cat->permLink.".html";
                                        $count++;
                                ?>
                                    <li>
                                        <div class="category-list">
                                            <h5>
                                                <a href="<?= $permLink; ?>">
                                                    <?= $title; ?>
                                                </a>
                                            </h5>
                                        </div>
                                    </li>
                                <?php } ?>


                            </ul>
                            
                        </div>

                        <div class="ratio_156 section-t-space">
                            <?php include('../components/banners/banner-sidebar-01.php'); ?>
                        </div>

                        
                    </div>
                </div>

                <div class="col-xxl-9 col-xl-8">
                    

                    <div class="title d-block">
                        <h2> Novidades </h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                        <p> As mais variadas novidades da Candy Sodas estão aqui </p>
                    </div>

                    <div class="product-border overflow-hidden wow fadeInUp">
                        <div class="product-box-slider no-arrow">

                            <?php 
                                $data= Commerce::isProducts();
                                $count = 0;
                                $productPorPagina = 20;
                                foreach ($data as $item) {
                                    $count++;
                                    $featuredImage =  Commerce::normalizeFeatureImage($item->featuredImage);
                                    $title = $item->title;
                                    $priceList = $item->priceList;
                                    $priceSale = Commerce::normalizePricebook($item->priceSale);
                                    $description = $item->description;
                                    $id = $item->id;
                                    $category = Commerce::getCategoryTitle($item->categories);
                                    $vproducts = '';
                                    $vproductsTitle = '';
                                    $sku = $item->sku;
                                    $tags = $item->tags;
                                    $variationMaster = $item->variationMaster;
                                    $productType = $item->productType;
                                    $permLink = $siteUrl."/p/".$id.".html";

                                    if($count <= $productPorPagina AND $productType != 'variation' AND $item->status == "enabled") {
                            ?>
                            <div>
                                <div class="row m-0">
                                    <div class="col-12 px-0">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="<?= $permLink; ?>">
                                                    <img src="<?= $featuredImage; ?>"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <ul class="product-option">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <a href="<?= $permLink; ?>" data-bs-toggle="modal"
                                                            data-bs-target="#view">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="<?= $permLink; ?>" class="notifi-wishlist">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-detail">
                                                <a href="<?= $permLink; ?>">
                                                    <h6 class="name h-100">
                                                        <?= $title; ?> </h6>
                                                </a>

                                                <div class="add-to-cart-box">
                                                   
                                                    <div class="cart_qty qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-left-minus"
                                                                data-type="minus" data-field="">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity" value="0">
                                                            <button type="button" class="qty-right-plus"
                                                                data-type="plus" data-field="">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>

                        </div>
                    </div>

                    <div class="section-t-space section-b-space">
                        <div class="row g-md-4 g-3">
                            <div class="col-xxl-8 col-xl-12 col-md-7">
                                <div class="banner-contain hover-effect">
                                    <img src="../assets/images/vegetable/banner/12.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h2 class="text-kaushan fw-normal theme-color">Get Ready To</h2>
                                            <h3 class="mt-2 mb-3">TAKE ON THE DAY!</h3>
                                            <p class="text-content banner-text">In publishing and graphic design, Lorem
                                                ipsum is a placeholder text commonly used to demonstrate.</p>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                class="btn btn-animation btn-sm mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-12 col-md-5">
                                <a href="shop-left-sidebar.html" class="banner-contain hover-effect h-100">
                                    <img src="../assets/images/vegetable/banner/13.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="banner-details p-center-left p-4 h-100">
                                        <div>
                                            <h2 class="text-kaushan fw-normal text-danger">20% Off</h2>
                                            <h3 class="mt-2 mb-2 theme-color">SUMMRY</h3>
                                            <h3 class="fw-normal product-name text-title">Product</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="title d-block">
                        <?php 
                            // Block Mais Procurados
                            $title = CMS::isComponent("309d517e-0301-11ee-be56-0242ac120002","title");
                            $description = CMS::isComponent("309d517e-0301-11ee-be56-0242ac120002","description");
                        ?>
                        <div>
                            <h2> <?= $title; ?> </h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p> 
                                <?= $description; ?> 
                            </p>
                        </div>
                    </div>

                    <div class="best-selling-slider product-wrapper wow fadeInUp">
                        <div>
                            <ul class="product-list">

                                <!-- Bloco 01 -->
                                <?php 
                                    $data = CMS::isComponent("309d517e-0301-11ee-be56-0242ac120002","bloco01");

                                    foreach($data as $value) {
                                        $uuid = Commerce::productSearch($value, 'id');
                                        $title = Commerce::productSearch($value, 'title');
                                        $featuredImage = Commerce::productSearch($value, 'featuredImage');
                                        $weight = Commerce::productSearch($value, 'weight');
                                        $permLink = $siteUrl."/p/".$uuid.".html";
                                ?>
                                <li>
                                    <div class="offer-product">
                                        <a href="<?= $permLink; ?>" class="offer-image">
                                            <img src="<?= Commerce::normalizeFeatureImage($featuredImage); ?>" class="blur-up lazyload" alt="">
                                        </a>
                                        <div class="offer-detail">
                                            <div>
                                                <a href="<?= $permLink; ?>" class="text-title">
                                                    <h6 class="name"> 
                                                        <?= $title; ?> 
                                                    </h6>
                                                </a>
                                                <span><?= $weight; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php 
                                    } 
                                ?>

                            </ul>
                        </div>

                        <div>
                            <ul class="product-list">

                                <!-- Bloco 02 -->
                                <?php 
                                    $data = CMS::isComponent("309d517e-0301-11ee-be56-0242ac120002","bloco02");

                                    foreach($data as $value) {
                                        $uuid = Commerce::productSearch($value, 'id');
                                        $title = Commerce::productSearch($value, 'title');
                                        $featuredImage = Commerce::productSearch($value, 'featuredImage');
                                        $weight = Commerce::productSearch($value, 'weight');
                                        $permLink = $siteUrl."/p/".$uuid.".html";
                                ?>
                                    <li>
                                        <div class="offer-product">
                                            <a href="<?= $permLink; ?>" class="offer-image">
                                                <img src="<?= Commerce::normalizeFeatureImage($featuredImage); ?>"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="<?= $permLink; ?>" class="text-title">
                                                        <h6 class="name"> <?= $title; ?> </h6>
                                                    </a>
                                                    <span><?= $weight; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>

                            </ul>
                        </div>

                        <div>
                            <ul class="product-list">

                                <!-- Bloco 03 -->
                                <?php 
                                    $data = CMS::isComponent("309d517e-0301-11ee-be56-0242ac120002","bloco03");

                                    foreach($data as $value) {
                                        $uuid = Commerce::productSearch($value, 'id');
                                        $title = Commerce::productSearch($value, 'title');
                                        $featuredImage = Commerce::productSearch($value, 'featuredImage');
                                        $weight = Commerce::productSearch($value, 'weight');
                                        $permLink = $siteUrl."/p/".$uuid.".html";
                                ?>
                                    <li>
                                        <div class="offer-product">
                                            <a href="<?= $permLink; ?>" class="offer-image">
                                                <img src="<?= Commerce::normalizeFeatureImage($featuredImage); ?>"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="<?= $permLink; ?>" class="text-title">
                                                        <h6 class="name"> <?= $title; ?> </h6>
                                                    </a>
                                                    <span><?= $weight; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                                
                            </ul>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </section>