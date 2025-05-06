<?php 
include(__DIR__ . '../../../../core/featureflags/featureflags.inc.php');
if (ENABLE_FLOATBUTTONS != 0):
?>
<div class="engage-toolbar d-flex position-fixed px-5 fw-bold zindex-2 top-50 end-0 transform-90 mt-5 mt-lg-20 gap-2">
    
    <a 
      class="engage-help-toggle btn engage-btn shadow-sm px-5 rounded-top-0" 
      title="Learn & Get Inspired" 	
      data-bs-toggle="tooltip" 
      data-bs-custom-class="tooltip-inverse" 
      data-bs-placement="left" 
      data-bs-dismiss="click"
      href="https://www.sgix.com.br/help.html"	
      target="_blank"
      data-bs-trigger="hover">	
      Help
    </a>
    <!--end::Help drawer toggle-->        
    <!--begin::Purchase link-->
    <a 
      href="https://www.sgix.com.br"	
      target="_blank"
      class="engage-purchase-link btn engage-btn px-5 shadow-sm rounded-top-0">
      Buy SGIX 
    </a>
</div>
<?php endif; ?>