<?php
  class helperCustomers {

    static public function getEnabledCustomers() {
        global $CONFIG;
        
        $customersFile = $CONFIG['CONF']['cacheDir'] . '/users.json';
        if (!file_exists($customersFile)) {
            return [];
        }

        $users = json_decode(file_get_contents($customersFile), true);
        if (!is_array($users)) {
            return [];
        }

        $filteredCustomers = array_filter($users, function ($user) {
            return isset($user['usergroup'], $user['status']) &&
                  $user['usergroup'] === 'customers' &&
                  $user['status'] === 'enabled';
        });

        return $filteredCustomers;
    }

    static public function getEnabledSupplier() {
        global $CONFIG;
        
        $customersFile = $CONFIG['CONF']['cacheDir'] . '/users.json';
        if (!file_exists($customersFile)) {
            return [];
        }

        $users = json_decode(file_get_contents($customersFile), true);
        if (!is_array($users)) {
            return [];
        }

        $filteredCustomers = array_filter($users, function ($user) {
            return isset($user['usergroup'], $user['status']) &&
                  $user['usergroup'] === 'supplier' &&
                  $user['status'] === 'enabled';
        });

        return $filteredCustomers;
    }


  }
?>