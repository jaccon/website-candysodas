<?php
global $CONFIG;
$whatsapp = CMS::isComponent("b9c29334-d1c8-11ed-afa1-0242ac120002","whatsapp");
$whatsappMessage = CMS::isComponent("b9c29334-d1c8-11ed-afa1-0242ac120002","whatsappMessage");
?>

<style>
      .float {
      position: fixed;
      width: 60px;
      height: 60px;
      bottom: 20px;
      right: 50px;
      background-color: #25d366;
      color: #FFF;
      border-radius: 50px;
      text-align: center;
      font-size: 40px;
      box-shadow: 2px 2px 3px #999;
      z-index: 100;
      }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<a href="<?= Social::shareWhatsapp($whatsapp, $whatsappMessage, null); ?>" class="float" target="_blank">
      <i class="fa fa-whatsapp my-float"></i>
</a>