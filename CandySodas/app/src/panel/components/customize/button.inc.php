<?php 
include(__DIR__ . '../../../../core/featureflags/featureflags.inc.php');

if (ENABLE_CUSTOMIZE_DARKMODE != 0):
?>
  <button 
      id="kt_app_layout_builder_toggle" 
      class="btn btn-dark app-layout-builder-toggle lh-1 py-4 " 
      title="Oliver HTML Pro Builder" 
      data-bs-custom-class="tooltip-inverse" 
      data-bs-toggle="tooltip" 
      data-bs-placement="left" 
      data-bs-dismiss="click" 
      data-bs-trigger="hover"
      >
  <i class="ki-duotone ki-setting-4 fs-4 me-1"></i> Shortcuts
  </button>
<?php 
  endif;
?>