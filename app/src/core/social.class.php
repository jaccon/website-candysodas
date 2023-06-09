<?php 
class Social {

  // Share with Whatsapp
  static public function shareWhatsapp($whatsnumber,$string,$link){
    return "https://api.whatsapp.com/send?phone=".$whatsnumber."&text=".$string." ".$link;
  }

  // Share with Facebook
  static public function shareFacebook($link){
    return "https://www.facebook.com/sharer/sharer.php?u=".$link;
  }

}
?>