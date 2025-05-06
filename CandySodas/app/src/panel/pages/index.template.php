<?php 
include(__DIR__ . '/../../config.inc.php');
include(__DIR__ . '/../../core/featureflags/featureflags.inc.php');
session_start();
if (($_SESSION["user"])) {
    header("Location: " . $CONFIG["CONF"]["adminCMS"] . "/home.html");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= PAGE_TITLE; ?></title>
    <meta charset="utf-8"/>
    <meta name="description" content="SGIX Content Management System, fast, secure"/>
    <meta name="keywords" content="SGIX CMS, SGIX Content Management System, Secure, Flexible"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="SGIX CMS | Powerful CMS" />
    <meta property="og:url" content="#/products/oliver-html-pro"/>
    <meta property="og:site_name" content="SGIX CMS | Powerful CMS" />
    <link rel="canonical" href="basic.html"/>
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>

    <style>
        .bg-image {
            background-image: url(assets/media/background.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        @media (min-width: 1200px) {
            .centralize-xl {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>

    <script>
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>

<body id="kt_body" class="app-blank">
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">

        <!-- BLOCO COM BG E TEXTO CENTRALIZADO -->
        <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px position-xl-relative bg-image centralize-xl">
            <div class="d-flex flex-column w-xl-600px scroll-y">
                <div class="d-flex flex-column text-center p-5 p-lg-10 justify-content-center flex-grow-1">
                    <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">
                        <?= CMS::getSiteConfigurationData("defaultPageTitle"); ?>
                    </h1>
                    <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                        <?= CMS::getSiteConfigurationData("loginPageMessage"); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- BLOCO DO FORM -->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                    <form class="form w-100" novalidate="novalidate" method="POST" action="<?= $CONFIG['CONF']['adminCMS']; ?>/login.html">
                        <div class="text-center mb-10">
                            <h1 class="text-gray-900 mb-3">
                                <img alt="Logo" src="assets/media/logos/logotipo-white.svg" width="120"/><br/><br/>
                                <?= SIGN_IN_TXT1; ?>
                            </h1>

                            <div class="text-gray-500 fw-semibold fs-4">
                                <?php if (Configurations::settings($CONFIG['CONF']['systemConfigurationId'], 'regUserStatus') === '1') { ?>
                                    <?= SIGN_IN_TXT2; ?>
                                    <a href="register.html" class="link-primary fw-bold"><?= CREATE_ACCOUNT_TXT1; ?></a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bold text-gray-900">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off"/>
                        </div>

                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bold text-gray-900 fs-6 mb-0"><?= FORM_PASSWORD; ?></label>
                                <?php if (Configurations::settings($CONFIG['CONF']['systemConfigurationId'], 'resetPasswordStatus') === '1') { ?>
                                    <a href="<?= $siteUrl; ?>/panel/reset-password.html" class="link-primary fs-6 fw-bold"><?= RESET_PASSWORD_TXT1; ?></a>
                                <?php } ?>
                            </div>
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off"/>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label"><?= FORM_BUTTON_SUBMIT; ?></span>
                                <span class="indicator-progress"><?= FORM_WAITING_MSG; ?> 
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                            <?php if (LOGIN_GOOGLE || LOGIN_FACEBOOK || LOGIN_APPLE) { ?>
                                <div class="text-center text-muted text-uppercase fw-bold mb-5"><?= FORM_OR; ?></div>
                            <?php } ?>

                            <?php if (LOGIN_GOOGLE) { ?>
                                <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3"/>
                                    <?= FORM_LOGIN_GOOGLE; ?>
                                </a>
                            <?php } ?>

                            <?php if (LOGIN_FACEBOOK) { ?>
                                <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-3"/>
                                    <?= FORM_LOGIN_FACEBOOK; ?>
                                </a>
                            <?php } ?>

                            <?php if (LOGIN_APPLE) { ?>
                                <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-20px me-3"/>
                                    <img alt="Logo" src="assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-20px me-3"/>
                                    <?= FORM_LOGIN_APPLE; ?>
                                </a>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <div class="d-flex flex-center fw-semibold fs-6">
                    <?= PAGE_TITLE_FOOTER; ?> &copy; <?= date('Y'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var hostUrl = "/oliver-html-pro/assets/";
</script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/js/custom/authentication/sign-in/general.js"></script>
</body>
</html>
