<?php

class Configurations {

  static public function settings($id, $field){

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

  static public function checkFeatureStatus($id) {
    global $CONFIG;

    $file = $CONFIG['CONF']['cacheDir']."/siteconfigurations.cms.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $CONFIG['CONF']['systemConfigurationId'] ) {
            if($content->$id != "1") {
              header("Location: ".$CONFIG['CONF']['adminCMS']."/home.html");
              exit();
            }
          }
       }
      return false;
  }

}

?>