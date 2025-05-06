<div id="kt_app_footer" class="app-footer  align-items-center justify-content-center justify-content-md-between flex-column flex-md-row py-3 py-lg-6 " >
          <div class="text-gray-900 order-2 order-md-1">
              <span class="text-muted fw-semibold me-1"><?= date('Y'); ?> &copy;</span>
              <a href="https://www.sgix.com.br" target="_blank" class="text-gray-800 text-hover-primary"> 
                <?= PAGE_TITLE ?> </a>
                - Release <?= $CONFIG['CONF']['appVersion']; ?> 
          </div>
         
          <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
              <li class="menu-item"> <?= PAGE_TITLE_FOOTER; ?> </li>
          </ul>
</div>