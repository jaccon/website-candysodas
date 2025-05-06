
<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
$categories = Commerce::isCategories();
$logotipo = $siteUrl."/assets/images/logotipo-acalanto.png";
?>
<div class="preloader">
    <div class="vertical-centered-box">
        <div class="content">
            <div class="loader-circle"></div>
            <div class="loader-line-mask">
                <div class="loader-line"></div>
            </div>
            <img src="<?= $logotipo; ?>" alt="" width="250">
        </div>
    </div>
</div>