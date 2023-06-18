<?php 
class Newsletter {

  // Newsletter Signup
  static public function signUp($data){
    global $CONFIG;
    
    $api = $CONFIG['CONF']['apiUrl'];
    $contractId = $CONFIG['CONF']['contractId'];
    $userId = $CONFIG['CONF']['userId'];
    $authorizationToken = $CONFIG['CONF']['authorization'];

    $email = $data[0]['email'];
    $consentiment = "true";

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $api.'/user/crm/newsletter-signup',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "email" : "'.$email.'",
        "consentiment" : "'.$consentiment.'"
      }',
      CURLOPT_HTTPHEADER => array(
        'authorization: '.$authorizationToken,
        'userid: '.$userId,
        'contractid: '.$contractId,
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
  }

}
?>