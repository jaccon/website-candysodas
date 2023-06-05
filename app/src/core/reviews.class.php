<?php

class Reviews {

  static public function getReviews() {
    global $CONFIG;

    $file = $CONFIG['CONF']['cacheDir']."/reviews.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $itens = json_decode($data);
    return $itens;

  }



}