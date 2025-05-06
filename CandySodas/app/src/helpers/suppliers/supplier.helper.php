<?php
  class helperSupplier {

    static public function getEnabledCustomers($filePath){
        if (!file_exists($filePath)) {
            return [];
        }

        $users = json_decode(file_get_contents($filePath), true);
        if (!is_array($users)) {
            return [];
        }

        $filteredCustomers = array_filter($users, function ($user) {
            return isset($user['usergroup'], $user['status']) &&
                  $user['usergroup'] === 'customer' &&
                  $user['status'] === 'enabled';
        });

        return $filteredCustomers;
    }

    static public function getSupplierById($sId) {
      global $CONFIG;
  
      $customersFile = $CONFIG['CONF']['cacheDir'] . '/users.json';
      if (!file_exists($customersFile)) {
          return null; 
      }
  
      $users = json_decode(file_get_contents($customersFile), true);
      if (!is_array($users)) {
          return null; 
      }
  
      foreach ($users as $user) {
          if (isset($user['id'], $user['status'], $user['usergroup']) &&
              $user['id'] === $sId &&
              $user['status'] === 'enabled' &&
              $user['usergroup'] === 'supplier') {
              return $user['name']; 
          }
      }
      return null; 
    }

    static public function getSupplierNameById($supplierId) {
      global $CONFIG;
  
      $filePath = $CONFIG['CONF']['cacheDir'] . '/users.json';
  
      if (!file_exists($filePath)) {
          return null; 
      }
  
      $jsonData = file_get_contents($filePath);
  
      $suppliers = json_decode($jsonData, true);
  
      if (!is_array($suppliers)) {
          return null; 
      }
  
      foreach ($suppliers as $supplier) {
        if (isset($supplier['id'], $supplier['status'], $supplier['usergroup']) &&
        $supplier['id'] === $supplierId &&
        $supplier['status'] === 'enabled' &&
        $supplier['usergroup'] === 'supplier') {
        return $supplier['name']; 
        }
      }
  
      return null;
    }
  

  }
?>