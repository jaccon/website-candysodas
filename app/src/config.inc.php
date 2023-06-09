<?php
// error_reporting(E_ERROR | E_PARSE);
// header_remove("X-Powered-By");
header('X-Powered-By: PAGEFAI CMS');

$CONFIG = array();

// PAGEFAI App Version
$CONFIG['CONF']['appVersion']="01.0529.03";

// PAGEFAI Configuration
$CONFIG['CONF']['contractId']="62cb1ed620972f002157e3eb";
$CONFIG['CONF']['userId']="62cb1c8420972f002157e3e9";
$CONFIG['CONF']['secrectKey']="xxxxxx";
$CONFIG['CONF']['apiUrl']="https://dash-api-v1.pagefai.com";
// $CONFIG['CONF']['apiUrl']="http://localhost:3333";
$CONFIG['CONF']['authorization']="iugeib4Phu6wauphae9NeengiTh1aeXaingezaij5lieVaaxe3IChaengoishahc";
$CONFIG['CONF']['updateCacheAcl']=array('172.16.144.1','209.126.106.143');

// Payment Method Keys
$CONFIG['CONF']['pixKey']= "26532649864";

// Site Configuration
$CONFIG['CONF']['defaultPageTitle']="Candy Sodas";
$CONFIG['CONF']['siteUrl']="http://localhost:8908";
// $CONFIG['CONF']['siteUrl']="https://www.casa8arquitetura.com.br";
$CONFIG['CONF']['assets']=$CONFIG['CONF']['siteUrl']."/assets/";
$CONFIG['CONF']['sitePrdUrl']="#";
$CONFIG['CONF']['siteDevUrl']="#";
$CONFIG['CONF']['instagramUrl']="#";
$CONFIG['CONF']['facebookUrl']="#";
$CONFIG['CONF']['whatsappUrl']="#";
$CONFIG['CONF']['contentUrl']="/assets/images";
$CONFIG['CONF']['productDirUrl']=$CONFIG['CONF']['contentUrl']."/products";

// System Configuration
$CONFIG['CONF']['siteDir']="/var/www/html/";
$CONFIG['CONF']['userId']="#";
$CONFIG['CONF']['cacheDir']=$CONFIG['CONF']['siteDir']."cached";
$CONFIG['CONF']['coreDir']=$CONFIG['CONF']['siteDir']."core";
$CONFIG['CONF']['currency']= "R$ ";
$CONFIG['CONF']['localImagesRepositoryUrl']="/assets/images";
$CONFIG['CONF']['remoteCDNStatus']= "disable";
$CONFIG['CONF']['remoteCDN']= "https://statics.pagefai.com/".$CONFIG['CONF']['contractId']."/";

// Core Application
include($CONFIG['CONF']['coreDir']."/cms.class.php");
include($CONFIG['CONF']['coreDir']."/commerce.class.php");
include($CONFIG['CONF']['coreDir']."/social.class.php");
include($CONFIG['CONF']['coreDir']."/payments.class.php");
include($CONFIG['CONF']['coreDir']."/reviews.class.php");
include($CONFIG['CONF']['coreDir']."/seo.class.php");

?>
