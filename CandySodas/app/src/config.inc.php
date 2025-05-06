<?php
// error_reporting(E_ERROR | E_PARSE);
// header_remove("X-Powered-By");
header('X-Powered-By: PAGEFAI CMS');

$CONFIG = array();

// Site Configuration
$CONFIG['CONF']['siteUrl']="http://localhost:8908";
// $CONFIG['CONF']['siteUrl']="https://dev.candysodas.com.br/";
$CONFIG['CONF']['assets']=$CONFIG['CONF']['siteUrl']."/assets/";
$CONFIG['CONF']['sitePrdUrl']="#";
$CONFIG['CONF']['siteDevUrl']="#";
$CONFIG['CONF']['instagramUrl']="#";
$CONFIG['CONF']['facebookUrl']="#";
$CONFIG['CONF']['whatsappUrl']="#";
$CONFIG['CONF']['contentUrl']="/assets/images";
$CONFIG['CONF']['productDirUrl']=$CONFIG['CONF']['contentUrl']."/products";
$CONFIG['CONF']['defaultPageTitle']="SGIX Content Management System";

# Admin Control
$CONFIG['CONF']['adminCMS']=$CONFIG['CONF']['siteUrl']."/"."panel";
$CONFIG['CONF']['defaultLanguage']="en"; # default language update here
$CONFIG['CONF']['appVersion']="01.0529.03";

// System Configuration
$CONFIG['CONF']['siteDir']="/var/www/html/";
$CONFIG['CONF']['cacheDir']=$CONFIG['CONF']['siteDir']."cached";
$CONFIG['CONF']['coreDir']=$CONFIG['CONF']['siteDir']."/core";
$CONFIG['CONF']['currency']= "R$ ";
$CONFIG['CONF']['localImagesRepositoryUrl']="/assets/images";
$CONFIG['CONF']['remoteCDNStatus']= "disable";
$CONFIG['CONF']['remoteCDN']= "https://statics.pagefai.com/".$CONFIG['CONF']['contractId']."/";
$CONFIG['CONF']['loginHistoryResults'] = 30;
$CONFIG['CONF']['systemConfigurationId'] = "423cf0ca-6e66-11ef-b864-0242ac120002";

// Upload settings
$CONFIG['CONF']['uploadMaxFileSize'] = 500;
$CONFIG['CONF']['uploadUrl'] = $CONFIG['CONF']['siteUrl'].'/uploads';
$CONFIG['CONF']['uploadDir'] = $CONFIG['CONF']['siteDir'].'/uploads';
$CONFIG['CONF']['acceptedFiles'] = "image/*,application/pdf,.zip,.rar,mp3,.mp4";


// PAGEFAI Configuration
$CONFIG['CONF']['contractId']="65ee8514b86293002cf4f90d";
$CONFIG['CONF']['userId']="62cb1c8420972f002157e3e9";
$CONFIG['CONF']['secrectKey']="xxxxxx";
$CONFIG['CONF']['apiUrl']="https://dash-api-v1.pagefai.com";
// $CONFIG['CONF']['apiUrl']="http://localhost:3333";
$CONFIG['CONF']['authorization']="iugeib4Phu6wauphae9NeengiTh1aeXaingezaij5lieVaaxe3IChaengoishahc";
$CONFIG['CONF']['updateCacheAcl']=array('172.16.144.1','209.126.106.143');

// Payment Method Keys
$CONFIG['CONF']['pixKey']= "55048081000191";
$CONFIG['CONF']['mercadoPagoToken']= "TEST-164926a1-20ce-4c84-9379-5f09ad9a74f7";
$CONFIG['CONF']['mercadoPagoPublicKey']= "TEST-4403149761551083-011421-7dc3c081ee4e6261da73aba70fafdf63-449037082";

// Amazon Ses Credentials
$CONFIG['CONF']['SMTP_HOST'] = 'email-smtp.us-east-1.amazonaws.com';
$CONFIG['CONF']['SMTP_PORT'] = '465';
$CONFIG['CONF']['SMTP_USER'] = 'AKIAS55DMGJ6HD6TW2ED';
$CONFIG['CONF']['SMTP_PASS'] = 'BN1SHrd0N1rPjQpEDGU76z0Zynol/gS3KDbrVfXzPBGv';
$CONFIG['CONF']['FROM_EMAIL'] = 'io@pagefai.com';

// Core Application
include($CONFIG['CONF']['coreDir']."/classes/cms.class.php");
include($CONFIG['CONF']['coreDir']."/classes/commerce.class.php");
include($CONFIG['CONF']['coreDir']."/classes/social.class.php");
include($CONFIG['CONF']['coreDir']."/classes/payments.class.php");
include($CONFIG['CONF']['coreDir']."/classes/reviews.class.php");
include($CONFIG['CONF']['coreDir']."/classes/seo.class.php");
include($CONFIG['CONF']['coreDir']."/classes/newsletter.class.php");
include($CONFIG['CONF']['coreDir']."/classes/auth.class.php");
include($CONFIG['CONF']['coreDir']."/classes/uploads.class.php");
include($CONFIG['CONF']['coreDir']."/classes/admin.class.php");
include($CONFIG['CONF']['coreDir']."/classes/forms.class.php");
include($CONFIG['CONF']['coreDir']."/classes/security.class.php");
include($CONFIG['CONF']['coreDir']."/classes/configurations.class.php");

// Helpers
include($CONFIG['CONF']['siteDir']."/helpers/helper.inc.php");
include('core/translates/loadtranslate.inc.php');

?>
