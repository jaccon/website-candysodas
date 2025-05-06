<?php

class Seo {

  // Chek SEO Black List
  static public function seoBlackList($url){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/seo-settings.json";
    $metadataId = "aca3671e-fe9b-11ed-be56-0242ac120002";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
    foreach ($objitems as $content) {

        if ($content->id === $metadataId){
          
          $urls = $content->blacklist;
          $urlArray = explode(',', $urls);

          if (in_array($url, $urlArray)) {
            return true;
          }

        } 
    }
  }

  static public function isSeo($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/seo-settings.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
       }
      return false;
  }

  static public function isSeoV2($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/siteconfigurations.cms.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
       }
      return false;
  }



  // Structure Data for Website SEO
  static public function structuredDataOrganization() {
    global $CONFIG;

    $metaIdSeo = $CONFIG['CONF']['metaIdSeo'];

    $logo = "";
    $facebook = "";
    $instagram = "";
    $youtube = "";
    $linkedin = "";

    $jsonObj = '
      <script type="application/ld+json">
        {
          "@context": "https://schema.org", "@type": "Organization",
          "name": "'.Seo::isSeo($metaIdSeo, "defaultPageTitle").'",
          "url": "'.$CONFIG['CONF']['siteUrl'].'",
          "logo": "'.Seo::isSeo($metaIdSeo, "logo").'",
          "sameAs": [
            "'.Seo::isSeo($metaIdSeo, "social_facebook").'", 
            "'.Seo::isSeo($metaIdSeo, "social_instagram").'", 
            "'.Seo::isSeo($metaIdSeo, "social_youtube").'", 
            "'.Seo::isSeo($metaIdSeo, "social_linkedin").'"
          ] 
        }
      </script>
    ';

    return $jsonObj;
  }

  static public function structuredDataBreadcrumb() {
    global $CONFIG;

    $metaIdSeo = $CONFIG['CONF']['metaIdSeoBreadCrumb'];
    
    $breadcrumbList = $data['BreadcrumbList'];
    $file = $CONFIG['CONF']['cacheDir'] . "/seo-settings.json";
    $url = $CONFIG['CONF']['siteUrl'];

    echo '<script type="application/ld+json"> 
        {
          "@context": "https://schema.org/", 
          "@type": "BreadcrumbList",
          "itemListElement": [
    ';

    if (file_exists($file)) {
        $data = file_get_contents($file);
    }

    $objitems = json_decode($data);

    $count = 0;
    $items = []; // Store items in an array

    foreach ($objitems as $content) {
        if ($content->id === $metaIdSeo) {
            $breadcrumbList = $content->BreadcrumbList;

            foreach ($breadcrumbList as $name => $value) {
                $count++;
                $item = '{
                    "@type": "ListItem", 
                    "position": ' . $count . ', 
                    "name": "' . $name . '", 
                    "item": "' . $url . "/" . $value . '"
                }';

                $items[] = $item; // Add item to the array
            }
        }
    }

    echo implode(',', $items); // Concatenate items with commas
    echo ']}</script>';
    return false;
}


}

?>