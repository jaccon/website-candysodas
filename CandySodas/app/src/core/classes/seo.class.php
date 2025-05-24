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

  static public function seoRenderAttributes($page = []) {
    global $CONFIG;
    $siteUrl = $CONFIG['CONF']['siteUrl'];
    $seo = $page;
    $seo['url'] = $seo['url'] ?? $siteUrl;

    if (isset($seo['title'])) echo "<title>{$seo['title']}</title>\n";
    if (!empty($seo['description'])) echo "<meta name=\"description\" content=\"{$seo['description']}\">\n";
    if (!empty($seo['keywords'])) echo "<meta name=\"keywords\" content=\"{$seo['keywords']}\">\n";
    if (isset($seo['index'])) {
        $robots = $seo['index'] ? 'index, follow' : 'noindex, nofollow';
        echo "<meta name=\"robots\" content=\"$robots\">\n";
    }
    if (!empty($seo['url'])) echo "<link rel=\"canonical\" href=\"{$seo['url']}\">\n";

    if (!empty($seo['title'])) echo "<meta property=\"og:title\" content=\"{$seo['title']}\">\n";
    if (!empty($seo['description'])) echo "<meta property=\"og:description\" content=\"{$seo['description']}\">\n";
    if (!empty($seo['image'])) echo "<meta property=\"og:image\" content=\"{$seo['image']}\">\n";
    if (!empty($seo['url'])) echo "<meta property=\"og:url\" content=\"{$seo['url']}\">\n";
    if (!empty($seo['type'])) echo "<meta property=\"og:type\" content=\"{$seo['type']}\">\n";

    if (!empty($seo['title'])) echo "<meta name=\"twitter:title\" content=\"{$seo['title']}\">\n";
    if (!empty($seo['description'])) echo "<meta name=\"twitter:description\" content=\"{$seo['description']}\">\n";
    if (!empty($seo['image'])) echo "<meta name=\"twitter:image\" content=\"{$seo['image']}\">\n";
    if (!empty($seo['image'])) echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";

    // JSON-LD Article
    if (!empty($seo['title']) || !empty($seo['image']) || !empty($seo['author']) || !empty($seo['published']) || !empty($seo['type']) || !empty($seo['url'])) {
        $json = [
            "@context" => "https://schema.org",
            "@type" => $seo['type'] ?? 'WebPage'
        ];
        if (!empty($seo['title'])) $json["headline"] = $seo['title'];
        if (!empty($seo['image'])) $json["image"] = [$seo['image']];
        if (!empty($seo['author'])) {
            $json["author"] = [
                "@type" => "Person",
                "name" => $seo['author']
            ];
        }
        if (!empty($seo['published'])) $json["datePublished"] = $seo['published'];
        if (!empty($seo['url'])) $json["url"] = $seo['url'];

        echo '<script type="application/ld+json">' . json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }

    // JSON-LD Breadcrumbs
    if (!empty($seo['breadcrumbs'])) {
        $breadcrumbList = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => []
        ];
        foreach ($seo['breadcrumbs'] as $index => $item) {
            if (!empty($item['name']) && !empty($item['url'])) {
                $breadcrumbList["itemListElement"][] = [
                    "@type" => "ListItem",
                    "position" => $index + 1,
                    "name" => $item['name'],
                    "item" => $item['url']
                ];
            }
        }
        echo '<script type="application/ld+json">' . json_encode($breadcrumbList, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
}



}

?>