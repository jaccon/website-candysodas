<?php
class Payments {

  // Generate a Pix Payment Link
  static public function pixPayment($data){
    global $CONFIG;

    $name = $data['name'];
    $chave = $data['chave'];
    $city = $data['city'];
    $valor = $data['valor'];
    $txid = $data['txid'];
    $type = $data['type'];

    $url = urldecode("https://gerarqrcodepix.com.br/api/v1?nome=$name&cidade=$city&saida=$type&chave=$chave&valor=$valor&txid=$txid");
    
    if($type == "qr") {
      $imageDataUrl = "data:image/png;base64," . base64_encode($imageData);
      echo  $url;
    } elseif($type == "br") {
      $response = file_get_contents($url);
      $data = json_decode($response, true);
      $brcode = $data['brcode'];
      echo $brcode;
    }

  } 

}
?>