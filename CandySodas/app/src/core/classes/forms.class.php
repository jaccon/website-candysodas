<?php
class Forms {

  static public function isForm($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/forms.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
       }
      return false;
  }

  // save leads
  static public function saveLead($data, $email) {
    global $CONFIG;
    $db = $CONFIG['CONF']['cacheDir'] . "/forms-submit-data.json";
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "E-mail inválido.";
    }
    
    if (!file_exists($db)) {
        file_put_contents($db, json_encode([]));
    }
    
    $leads = json_decode(file_get_contents($db), true);
    
    foreach ($leads as &$lead) {
        if ($lead['email'] === $email) {
            $lead['updatedAt'] = date('Y-m-d H:i:s');
            file_put_contents($db, json_encode($leads, JSON_PRETTY_PRINT));
            return "E-mail já cadastrado, data de atualização modificada.";
        }
    }

    $uuid = Cms::generateUUID();
    
    $newLead = [
        'id' => $uuid,
        'email' => $email,
        'createdAt' => date('Y-m-d H:i:s'),
        'updatedAt' => date('Y-m-d H:i:s'),
        'status' => 0
    ];

    foreach ($data as $key => $value) {
        if ($key === 'id') {
            $newLead['formId'] = $value;
        } else {
            $newLead[$key] = $value;
        }
    }
    
    $leads[] = $newLead;
    file_put_contents($db, json_encode($leads, JSON_PRETTY_PRINT));
    
    return "Lead salvo com sucesso.";
  }


  
}
?>