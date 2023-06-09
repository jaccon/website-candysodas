<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];
$metaId = "87fe7702-06e1-11ee-be56-0242ac120002";
$featuredImage= CMS::getImage(CMS::isComponent($metaId,"featuredImage"));
$permLink = CMS::isComponent($metaId,"permLink");
$slug = CMS::isComponent($metaId,"slug");

?>
<div> 
<a href="<?= $permLink; ?>">
    <img src="<?= $featuredImage; ?>"
      class="blur-up lazyload"
      width="98%"
      alt="<?= $slug; ?>">
</a>
</div>