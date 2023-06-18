<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
$categories = Commerce::isCategories();

// Social Links
$metaId = "b9c29334-d1c8-11ed-afa1-0242ac120002";
$whatsapp= CMS::isComponent($metaId,"whatsappLink");
$instagram= CMS::isComponent($metaId,"instagram");
$facebook= CMS::isComponent($metaId,"facebook");
$phone = CMS::isComponent($metaId,"phoneString");
$email = CMS::isComponent($metaId,"email");

// Marquee
$metaIdMarquee = "65ca8ef0-06c3-11ee-be56-0242ac120002";

if(isset($_COOKIE['wishlist']) && !empty($_COOKIE['wishlist']) && $_COOKIE['wishlist'] !== "[]") {
    $blink="blinking-text";
}

?>

<style>
.blinking-text {
  animation: blink 1s infinite;
}

@keyframes blink {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>

<header class="pb-md-4 pb-0">
        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 d-xxl-block d-none">
                        <div class="top-left-header">
                            <i class="iconly-Location icli text-white"></i>
                            <span class="text-white">
                                Dúvidas ? <?= $email; ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                        <div class="header-offer">
                            <div class="notification-slider">

                                    <div>
                                        <div class="timer-notification">
                                            <h6>
                                               <?= CMS::isComponent($metaIdMarquee,"text1"); ?>
                                            </h6>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="timer-notification">
                                            <h6>
                                               <?= CMS::isComponent($metaIdMarquee,"text2"); ?>
                                            </h6>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="timer-notification">
                                            <h6>
                                               <?= CMS::isComponent($metaIdMarquee,"text3"); ?>
                                            </h6>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                            <li>
                                <a href="<?= $instagram; ?>" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $facebook; ?>" target="_blank" class="social-icons"> 
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $whatsapp; ?>" target="_blank" class="social-icons"> 
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="<?= $siteUrl; ?>" class="web-logo nav-logo">
                                <img src="<?= $siteUrl; ?>/assets/images/logotipo.png" class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="middle-box">
                                

                                <div class="search-box">
                                    <div class="input-group">
                                        <input type="search" 
                                            class="form-control" 
                                            placeholder="Procurar por..."
                                            aria-label="Search" 
                                            aria-describedby="button-addon2"
                                            value=""
                                            name="search"
                                            id="searchString"
                                        >

                                        <button class="btn" 
                                                type="button" 
                                                id="searchSubmit"
                                                onclick="handleSearchClick()"
                                        >
                                            <i data-feather="search"></i>
                                        </button>

                                        <script>
                                            function handleSearchClick() {
                                                var searchString = $('#searchString').val();
                                                var searchString = $('input[name="search"]').val();
                                                var url = '/search.html?search=' + encodeURIComponent(searchString);
                                                window.location.href = url;
                                            }
                                        </script>

                                    </div>
                                </div>
                            </div>

                            <div class="rightside-box">
                                <div class="search-full">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                        <input type="text" class="form-control search-type" placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side">
                                        <a href="contact-us.html" class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="phone-call"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>Atendimento</h6>
                                                <h5><?= $phone; ?></h5>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="right-side">
                                        <a href="<?= $siteUrl; ?>/wishlist.html" class="btn p-0 position-relative header-wishlist <?= $blink; ?>">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </li>
                                    <!-- <li class="right-side">
                                        <div class="onhover-dropdown header-badge">
                                            <button type="button" class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="shopping-cart"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge">2
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            </button>

                                            <div class="onhover-div">
                                                <ul class="cart-list">
                                                    <li class="product-box-contain">
                                                        <div class="drop-cart">
                                                            <a href="product-left-thumbnail.html" class="drop-image">
                                                                <img src="../assets/images/vegetable/product/1.png"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="drop-contain">
                                                                <a href="product-left-thumbnail.html">
                                                                    <h5>Fantasy Crunchy Choco Chip Cookies</h5>
                                                                </a>
                                                                <h6><span>1 x</span> $80.58</h6>
                                                                <button class="close-button close_button">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <div class="drop-cart">
                                                            <a href="product-left-thumbnail.html" class="drop-image">
                                                                <img src="../assets/images/vegetable/product/2.png"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="drop-contain">
                                                                <a href="product-left-thumbnail.html">
                                                                    <h5>Peanut Butter Bite Premium Butter Cookies 600 g
                                                                    </h5>
                                                                </a>
                                                                <h6><span>1 x</span> $25.68</h6>
                                                                <button class="close-button close_button">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <div class="price-box">
                                                    <h5>Total :</h5>
                                                    <h4 class="theme-color fw-bold">$106.58</h4>
                                                </div>

                                                <div class="button-group">
                                                    <a href="cart.html" class="btn btn-sm cart-button">View Cart</a>
                                                    <a href="checkout.html" class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li> -->
                                    <!-- <li class="right-side onhover-dropdown">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>Hello,</h6>
                                                <h5>My Account</h5>
                                            </div>
                                        </div>

                                        <div class="onhover-div onhover-div-login">
                                            <ul class="user-box-name">
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="login.html">Log In</a>
                                                </li>

                                                <li class="product-box-contain">
                                                    <a href="sign-up.html">Register</a>
                                                </li>

                                                <li class="product-box-contain">
                                                    <a href="forgot.html">Forgot Password</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">
                        <div class="header-nav-left">
                            <button class="dropdown-category">
                                <i data-feather="align-left"></i>
                                <span> Categorias</span>
                            </button>

                            <div class="category-dropdown">
                                <div class="category-title">
                                    <h5>Categories</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <ul class="category-list">

                                    <?php 
                                        $count = 0;
                                        foreach ($categories as $cat) {
                                            $title = $cat->title;
                                            $permLink = $siteUrl."/c/".$cat->permLink.".html";
                                            $count++;
                                    ?>
                                        <li class="onhover-category-list">
                                            <a href="<?= $permLink; ?>" class="category-name">
                                                <h6> 
                                                    <?= $title; ?> 
                                                </h6>
                                            </a>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>

                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">

                                            <li class="nav-item-custom">
                                                <a href="<?= $siteUrl; ?>"> Home </a>
                                            </li>
                                            <li class="nav-item-custom">
                                                <a href="<?= $siteUrl; ?>/sobre.html">  Sobre Nós </a>
                                            </li>
                                            <li class="nav-item-custom">
                                                <a href="<?= $siteUrl; ?>/produtos.html"> Produtos </a>
                                            </li>

                                            <li class="nav-item-custom">
                                                <a href="<?= $siteUrl; ?>/c/lancamentos.html"> Lançamentos </a>
                                            </li>

                                            <li class="nav-item-custom">
                                                <a href="<?= $siteUrl; ?>/contato.html"> Contato </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="header-nav-right">
                            <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                                <i data-feather="zap"></i>
                                <span> Recomendamos pra você </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

 