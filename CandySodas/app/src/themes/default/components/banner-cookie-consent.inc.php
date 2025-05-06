<?php 
global $CONFIG;
if (CMS::getSiteConfigurationData("consentWidget") == "enabled") { ?>

<style>
#cookie-banner {
    display: block;
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 140px;
    background-color: #fff;
    text-align: center;
    z-index: 9998;
    padding: 30px;
}

#cookie-button {
    background-color: #333;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}
</style>

<div class="row">
  <div class="col-md-12">
    <div id="cookie-banner">
      <p> <?= CMS::getSiteConfigurationData("consentWidgetMessage"); ?> </p>
      <button 
        id="cookie-button" 
        class="as-btn"> 
        Aceitar 
      </button>
    </div>
  </div>
</div>

<script>
  
      var cookieBanner = document.getElementById("cookie-banner");
      var cookieButton = document.getElementById("cookie-button");
      
      cookieButton.onclick = function() {
        cookieBanner.style.display = "none";
        $.cookie('cookieConsentCommerce', 'accepted');
        window.location.reload();
      }
      
      // console.log($.cookie('cookieConsentCommerce'));

      window.onload = function() {
        if($.cookie('cookieConsentCommerce') === "accepted") {
          cookieBanner.style.display = "none";
        }
      }
</script>

<?php } ?>
