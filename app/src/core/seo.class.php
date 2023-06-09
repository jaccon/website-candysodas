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

}

?>