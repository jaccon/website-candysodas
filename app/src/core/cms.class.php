<?php

class CMS {
  static public function apiConnect($contractId, $userId, $apiUrl){
    return "Hello World";
  }

  static public function defaultPageTitle(){
    global $CONFIG;
    return $CONFIG['CONF']['defaultPageTitle'];
  }

  static public function siteUrl() {
    global $CONFIG;
    return $CONFIG['CONF']['siteUrl'];
  }
  
  static public function isPage($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/pages.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
       }
      return false;
  }

  static public function isComponent($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/components-metadata.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
       }
      return false;
  }

  static public function isMenu($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/components-metadata.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
    foreach ($objitems as $content) {
        if ($content->id === $id) return $content->$field;
      }
    return false;
  }

  static public function getContractId(){
    global $CONFIG;

    return base64_encode($CONFIG['CONF']['contractId']);
  }

  static public function getImage($img){
    global $CONFIG;

    $remoteCND = $CONFIG['CONF']['remoteCDN'];
    $remoteCNDStatus = $CONFIG['CONF']['remoteCDNStatus'];

    if(!$img) {
      return $remoteCND."/no-image.jpg";
    }

    if($remoteCNDStatus === "disable") {
      return $CONFIG['CONF']['siteUrl'].$CONFIG['CONF']['localImagesRepositoryUrl']."/".$img;
    } else {
      return $remoteCND."/".$img;
    }

  }

  static public function getCurrentUrl(){
    $currentUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $currentUrl .= $_SERVER['HTTP_HOST'];
    $currentUrl .= $_SERVER['REQUEST_URI'];
    return $currentUrl;
  }

  static public function includeComponent() {
    global $CONFIG;
    return $CONFIG['CONF']['siteDir']."components/";
  }

  

}


?>