<?php
include('../config.inc.php');
global $CONFIG;
$pageId="e7675e7a-c5ff-11ed-afa1-0242ac120002";
$metaDescription = Commerce::getCommerceSettings('daa548ea-f152-11ed-a05b-0242ac120003','description');
$title = CMS::isPage($pageId, "title");
$siteUrl = $CONFIG['CONF']['siteUrl'];
$content = CMS::isPage($pageId, "content");
$slug = CMS::isPage($pageId, "slug");
$pageBackground = CMS::getImage(CMS::isPage($pageId, "pageBackground"));

// Contact
$metaId = "b9c29334-d1c8-11ed-afa1-0242ac120002";
$email= CMS::isComponent($metaId,"email");
$phoneString= CMS::isComponent($metaId,"phoneString");
$whatsapp= CMS::isComponent($metaId,"whatsapp");

// SEO
$metaIdSeo = "0ff54848-c781-11ed-afa1-0242ac120002";
$pageTitle = Seo::isSeo($metaIdSeo, "defaultPageTitle")." - ".$title;
$siteDescription = Seo::isSeo($metaIdSeo, "description");
$siteAuthor = Seo::isSeo($metaIdSeo, "author");
$keywords = Seo::isSeo($metaIdSeo, "keywords");
$favicon = Seo::isSeo($metaIdSeo, "favicon");


?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $siteDescription; ?>">
    <meta name="keywords" content="<?= $keywords; ?>">
    <meta name="author" content="<?= $siteAuthor; ?>">
    <link rel="icon" href="<?= $favicon; ?>" type="image/x-icon">
    <title> 
        <?= $pageTitle; ?>
    </title>

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link id="rtl-link" rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" href="<?= $siteUrl; ?>/assets/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/bulk-style.css">
    <link rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/vendors/animate.css">
    <link id="color-link" rel="stylesheet" type="text/css" href="<?= $siteUrl; ?>/assets/css/style.css">
</head>

<body class="bg-effect">


    <?php include('../components/header/header.inc.php'); ?>
    <?php include('../components/mobile/menuStart.inc.php'); ?>

    <!--  -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2> <?= CMS::isPage($pageId, "title"); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3> Entrar em contato </h3>
                                    <p class="mt-4"> Utilize um de nossos canais de comunicação </p>
                                </div>

                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-12 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <span class="fas fa-phone"></span>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4> Telefone </h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p><?= $phoneString; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-12 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <span class="fas fa-phone"></span>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4> Whatsapp </h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p><?= $whatsapp; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-12 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>E-mail</h4>
                                                </div>
                                                <div class="contact-detail-contain">
                                                    <p><?= $email; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>Formulário de contato</h2>
                        <p> Envie sua dúvida que em breve entraremos em contato </p>
                    </div>
                    <form id="contact-form-2" method="POST" enctype="multipart/form-data">
                        <div class="right-sidebar-box">
                            <div class="row">
                                <div class="col-xxl-12 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput" class="form-label">Nome Completo</label>
                                        <div class="custom-input">
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                name="name" 
                                                id="name" 
                                                placeholder="Seu Nome"
                                             >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput2" class="form-label">E-mail</label>
                                        <div class="custom-input">
                                            <input 
                                                type="email" 
                                                class="form-control" 
                                                name="email" 
                                                id="email" 
                                                placeholder="E-mail"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput3" class="form-label">Telefone</label>
                                        <div class="custom-input">
                                            <input 
                                                type="number" 
                                                class="form-control" 
                                                name="whatsapp" 
                                                id="whatsapp" 
                                                placeholder="Whatsapp"
                                                maxlength="10" 
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                                this.value.slice(0, this.maxLength);"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlTextarea" class="form-label">Mensagem</label>
                                        <div class="custom-textarea">
                                            <textarea 
                                                class="form-control" 
                                                name="message" 
                                                id="message" 
                                                cols="30" 
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-animation btn-md fw-bold ms-auto" id="button-submit">Envair Mensagem</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    
    <?php include('../components/footer/footer.inc.php'); ?>

    <div class="bg-overlay"></div>

    <script src="<?= $siteUrl; ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/bootstrap/bootstrap-notify.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/feather/feather.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/feather/feather-icon.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/lazysizes.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/slick/slick.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/slick/slick-animation.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/slick/custom_slick.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/auto-height.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/timer1.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/fly-cart.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/quantity-2.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/wow.min.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/custom-wow.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/script.js"></script>
    <script src="<?= $siteUrl; ?>/assets/js/theme-setting.js"></script>

    <script>

        document.getElementById("button-submit").onclick = function(e) {sendForm(e)};
        
        function sendForm(e) {
            
            e.preventDefault();

            alert('Para confirmar o envio clique em OK! ');
        
            var name = $("#name").val();
            var email = $('#email').val();
            var whatsapp = $('#whatsapp').val();
            var message = $("#message").val();

            var data = [{
                name : name, 
                email : email, 
                whatsapp : whatsapp, 
                message : message
            }]

            jQuery.ajax({
                type: "POST",
                url: "https://dash-api-v1.pagefai.com/mail/NjJjYjFlZDYyMDk3MmYwMDIxNTdlM2Vi",
                data: JSON.stringify({ data }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data){
                    if(data = 1){
                        $("#contact-form-2").css("display", "none");
                        $("#contact-form-message").css("display", "block");
                        alert('Mensagem Enviada com sucesso!')
                        console.log(data)
                    }
                }
            });
            return false;
        }
        </script>

</body>

</html>