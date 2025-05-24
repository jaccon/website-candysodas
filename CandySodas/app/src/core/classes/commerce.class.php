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
    $file = $CONFIG['CONF']['cacheDir']."/catalog.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
    foreach ($objitems as $content) {
        if ($content->id === $id) return $content->$field;
     }
    return false;

  }

  static public function getProductIdfromPermLink($permLink){

    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/catalog.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
    foreach ($objitems as $content) {
        if ($content->permLink === $permLink) return $content->id;
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

   static public function getProductCategories($categoryType = null) {
    global $CONFIG;
    $filePath = $CONFIG['CONF']['cacheDir'].'/catalog-categories.json';

    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $categories = json_decode($jsonData, true);
        
        if (is_array($categories)) {
            return array_filter($categories, function($category) use ($categoryType) {
                $isEnabled = isset($category['status']) && $category['status'] === 'enabled';
                // $matchesType = $categoryType ? (isset($category['categoryType']) && $category['categoryType'] === $categoryType) : true;
                return $isEnabled;
            });
        }
    }

    return [];
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

    static public function getProductCategoryById($registerId) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/catalog-categories.json';

    if (!file_exists($filePath)) {
        return null; 
    }

    $jsonData = file_get_contents($filePath);

    $registers = json_decode($jsonData, true);

    if (!is_array($registers)) {
        return null; 
    }

    foreach ($registers as $register) {
        if ($register['id'] === $registerId) {
            return $register;
        }
    }

    return null; 
  }

  static public function updateProductCategoryById($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/catalog-categories.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo catalog-categories.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo catalog-categories.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'Register note found.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo categories.json.'];
    }

    Auth::logUserAction($projectId, 'update users');
    return ['success' => true, 'message' => 'Register atualizado com sucesso.'];

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

  static public function getShipping($shippingCode) {
    global $CONFIG;

    $file = $CONFIG['CONF']['cacheDir']."/commerceconfigurations.cms.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);

    foreach ($objitems as $content) {
        if ($content->shippingCode === $shippingCode) return $content->Slug;
     }

    return false;

  }

  static public function getShippingList($category) {
    global $CONFIG;

    $file = $CONFIG['CONF']['cacheDir']."/commerceconfigurations.cms.json";

    if (file_exists($file)) {
        $data = file_get_contents($file);
    }

    $objitems = json_decode($data);
    $result = [];

    foreach ($objitems as $content) {
        if ($content->category === $category) {
            $result[] = $content;
        }
    }

    if (!empty($result)) {
        return $result;
    }

      return false;

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
      $file = $CONFIG['CONF']['cacheDir']."/commerceconfigurations.cms.json";

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
    
    static public function getShippingAmount($id){
      global $CONFIG;
  
      $file = $CONFIG['CONF']['cacheDir']."/commerceconfigurations.cms.json";
  
      if(file_exists($file)){
        $data =  file_get_contents($file);
      }
  
      $objitems = json_decode($data);
        foreach ($objitems as $content) {
          if ($content->shippingCode === $id) return $content->amount;
        }
        return false;
  
    }

    static public function getPaymentMethodsList() {

      global $CONFIG;
      $file = $CONFIG['CONF']['cacheDir']."/commerceconfigurations.cms.json";

      if(file_exists($file)){
        $data =  file_get_contents($file);
      }

      $objitems = json_decode($data);
      $result = [];

      foreach ($objitems as $content) {
          if ($content->category === 'paymentMethod' AND $content->status === 'enabled') {
              $result[] = $content;
          }
      }

      if (!empty($result)) {
          return $result;
      }

      return false;

    }
    
    static public function getRedirectToCartStatus() {
      global $CONFIG;
  
      $file = $CONFIG['CONF']['cacheDir']."/commerceconfigurations.cms.json";
  
      if (file_exists($file)) {
          $data = file_get_contents($file);
          $objitems = json_decode($data);
  
          foreach ($objitems as $content) {
              if ($content->category === 'redirectCart') {
                  return $content->redirect;
              }
          }
      }
  
      return false;
    }

    public static function checkoutCookieClean() {
      // Lista de cookies a serem removidos
      $cookies = ['basket', 'c', 'order', 'shipping', 'shippingAmount', 'paymentMethod', 'checkout'];

      foreach ($cookies as $cookie) {
          // Remove o cookie com o tempo de expiração passado e sem especificar o domínio ou caminho
          setcookie($cookie, '', time() - 3600);
          unset($_COOKIE[$cookie]);
      }
    }

    // Cria o link do Checkout Pro do Mercado Pago
    public static function mercadoPagoPreferences($preference_data) {

      $access_token = 'SEU_ACCESS_TOKEN';
  
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/checkout/preferences?access_token=$access_token");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($preference_data));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
      $response = curl_exec($ch);
      curl_close($ch);
  
      $preference = json_decode($response, true);
  
      return $preference['init_point'];
    }
  


    
  }





?>