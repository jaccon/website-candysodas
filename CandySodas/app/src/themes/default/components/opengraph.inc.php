<?php
global $CONFIG;
$title = CMS::getSiteConfigurationData("defaultPageTitle");
$content = CMS::getSiteConfigurationData("content"); 
$description = CMS::getSiteConfigurationData("description");
$thumb = CMS::getSiteConfigurationData("thumbOpenGraph");
$updateAt = CMS::getSiteConfigurationData("updatedAt");
?>
<meta property="og:site_name" content="<?= $title; ?>">
<meta property="og:title" content="<?= $title; ?>" />
<meta property="og:description" content="<?= $content; ?>" />
<meta property="og:image" itemprop="image" content="<?= $thumb; ?>">
<meta property="og:type" content="website" />
<meta property="og:updated_time" content="<?= $updateAt; ?>" />