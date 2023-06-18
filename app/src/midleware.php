<?php
// Pagefai Middleware Communication
include('config.inc.php');

$midlewareFunction = $_GET['f'];

$requestBody = file_get_contents("php://input");
$jsonObj = json_decode($requestBody, true);
$data = $jsonObj['data'] ?? '';

if($midlewareFunction === 'newsletter-signup') {
  Newsletter::signUp($data);

} elseif ($midlewareFunction === 'contact') {
  echo "Send contact";

} elseif ($midlewareFunction === 'login') {
  echo "Send login";

} else {
  $err = json_encode('request not accepted');
  echo $err;
}



