<?php
class Commerce {

  // filter products
  static public function isProducts($filter=null){
    global $CONFIG;

    $file = $CONFIG['CONF']['cacheDir']."/products.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);

    return $objitems;
    
  }

  // get product detail
  static public function getProductDetail($id, $field){

    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/products.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
    foreach ($objitems as $content) {
        if ($content->id === $id) return $content->$field;
     }
    return false;

  }

  static public function isCategories($filter=null) {
    global $CONFIG;
    
    $file = $CONFIG['CONF']['cacheDir']."/product-categories.json";
    
    if(file_exists($file)){
      $data =  file_get_contents($file);
    }
  
    $objitems = json_decode($data);
    
  
    return $objitems;
    
  }

  



  static public function getCategoryTitle($id) {

    global $CONFIG;

    $file = $CONFIG['CONF']['cacheDir']."/product-categories.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }
    
    $objitems = json_decode($data);
    // print_r($objitems);

    foreach ($objitems as $content) {
        if ($content->id === $id) return $content->title;
      }

      return false;


  }

  // show category item
  static public function isCategoryItem($id, $field) {
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/product-categories.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->permLink === $id) return $content->$field;
       }
      return false;
  }

  // show the category itens list
  static public function categoryListItens($id){
    global $CONFIG;

    $data = Commerce::isProducts();
    $results = array();

    foreach ($data as $item) {
      $vm = $item->categories;

      if($vm == $id){
          $results[] = $item->$field;
      }
    }
    // $vids = implode(",", $results);
    return $results;

  }

  // show variation products 
  static public function variationProducts($id, $field) {
    global $CONFIG;

    $data = Commerce::isProducts();
    $results = array();

    foreach ($data as $item) {
      $vm = $item->variationMaster;
      $pId = $item->id;

      if($vm == $id){
          $results[] = $item->$field;
      }
    }

    // $vids = implode(",", $results);
    return $results;

  }

  // generate a product link to system
  static public function productLink($string){
    global $CONFIG;
    return $CONFIG['CONF']['siteUrl']."/p/".$string.".html";
  }

  // normalize a feature Image URL
  static public function normalizeFeatureImage($img){
    global $CONFIG;

    $featureImage = Commerce::getProductDetail($img, "featuredImage");
    if(!$img) {
      return $CONFIG['CONF']['siteUrl'].$CONFIG['CONF']['productDirUrl']."/no-image.jpg";
    } else {
      return $CONFIG['CONF']['siteUrl'].$CONFIG['CONF']['productDirUrl']."/".$img;
    }
  }

  static public function normalizeFeatureImageV2($id){
    global $CONFIG;

    $featuredImage = Commerce::getProductDetail($id, "featuredImage");
    $feateuredImageMasterId = Commerce::getProductDetail($id, "variationMaster");
    $feateuredImageMasterImage = Commerce::getProductDetail($feateuredImageMasterId, "featuredImage");


    if(!$featuredImage) {
      
      return $CONFIG['CONF']['siteUrl'].$CONFIG['CONF']['productDirUrl']."/".$feateuredImageMasterImage;

    } else {
      return $CONFIG['CONF']['siteUrl'].$CONFIG['CONF']['productDirUrl']."/".$featuredImage;
    }
  }

  // normalize the pricebook
  static public function normalizePricebook($price) {
    global $CONFIG;

    if(!$price) {
      return 'Consulte';
    } else {
      return $CONFIG['CONF']['currency']." ".$price;
    }
  }

  // get total baskets
  static public function getBasketTotalItens() {
    global $CONFIG;

    $basketCookie = $_COOKIE['basket'];
    $basketItems = explode(',', $basketCookie);

    $cleaned = array_filter($basketItems, function($value) {
      return trim($value) !== '';
    });

    return count($cleaned);
  }

  // shipping methods
  static public function getShippingMethod($metaId, $id) {
    global $CONFIG;

    $shippingStandart = CMS::isComponent($metaId,"shippingStandart");
    $shippingStandartDesc = CMS::isComponent($metaId,"shippingStandartDesc");

    $shippingFree = CMS::isComponent($metaId,"shippingFree");
    $shippingFreeDesc = CMS::isComponent($metaId,"shippingFreeDesc");

    if($id == 'standart') {
      return [ "method" => "$shippingStandartDesc", "amount" => "$shippingStandart" ];
    } elseif ( $id == 'free') {
      return [ "method" => "$shippingFreeDesc", "amount" => "$shippingFree" ];
    }

  }

    // payment methods
    static public function getPaymentMethod($metaId, $id) {
      global $CONFIG;

      $paymentMethod1 = CMS::isComponent($metaId,"paymentMethod1");
      $paymentMethod2 = CMS::isComponent($metaId,"paymentMethod2");

      $shippingFree = CMS::isComponent($metaId,"shippingFree");
      $shippingFreeDesc = CMS::isComponent($metaId,"shippingFreeDesc");

      if($id == '1') {
        return $paymentMethod1;
      } elseif ( $id == '2') {
        return $paymentMethod2;
      }
      
    }

    // Get Commerce Settings
    static public function getCommerceSettings($id, $field) {
      global $CONFIG;

      global $CONFIG;
      $file = $CONFIG['CONF']['cacheDir']."/commerce-settings.json";

      if(file_exists($file)){
        $data =  file_get_contents($file);
      }

      $objitems = json_decode($data);
        foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
        }
        return false;

    }

    // Get Minimum Amount
    static public function getShippingMinimumAmount() {
      global $CONFIG;

      $settingId = "06ffcf54-d660-11ed-afa1-0242ac120002";
      $amount = Commerce::getCommerceSettings($settingId, 'amount');

      return $amount;

    }

    // get product status
    static public function getProductStatus($status){

      if($status == "enabled") {
        return true;
      }

    }

    static public function priceNormalize($string) {
      global $CONFIG;
  
      $currencyDefault = Commerce::getCommerceSettings('925d2964-fd04-11ed-be56-0242ac120002','currency');
      return  $currencyDefault." ".$string;
  
    }

    // Product Search
    static public function productSearch($sku, $field) {

      global $CONFIG;
      $file = $CONFIG['CONF']['cacheDir']."/products.json";

      if(file_exists($file)){
        $data =  file_get_contents($file);
      }

      $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->sku === $sku){
            return $content->$field;
          } 
      }
      
    }

    static public function searchProducts($s){
      global $CONFIG;
  
      $data = Commerce::isProducts();
      $results = array();

      foreach ($data as $item) {
  
        $lowercaseS = strtolower($s);
        $lowercaseTitle = strtolower($item->title);

        if( $item->sku === $s || strpos($lowercaseTitle, $lowercaseS) !== false || $item->id === $s){
            $results[] = $item;
        }
      }

      return $results;
  
    }
    

}
?>