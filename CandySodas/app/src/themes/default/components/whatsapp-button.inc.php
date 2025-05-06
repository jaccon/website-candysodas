<?php
global $CONFIG;

if (CMS::getSiteConfigurationData("whatsappWidget") == "enabled") {
?>

<style>
      .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 100px;
            right: 20px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 40px;
            z-index: 100;
      }

      a.float {
            padding: 9px;
      }

      @keyframes blink {
            0% {
                  background-color: #25d366;
            }
            50% {
                  background-color: #17aa4e;
            }
            100% {
                  background-color: #25d366;
            }
      }

      .blinking-div {
            animation: blink 1s infinite; /* 1s duration, infinite loop */
      }

</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<a href="https://api.whatsapp.com/send?phone=<?= CMS::getSiteConfigurationData("whatsappnumber"); ?>&text=Peguei seu contato no site" class="float blinking-div" target="_blank">
      <i class="fa fa-whatsapp my-float"></i>
</a>

<?php } ?>