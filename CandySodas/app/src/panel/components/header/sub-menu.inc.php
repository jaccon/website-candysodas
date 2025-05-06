<div class="app-header-secondary "
          >
          <div class="app-container  container-xxl d-flex align-items-stretch overflow-x-auto " id="kt_app_header_secondary_container">
              <div class="app-content-menu menu menu-rounded min-w-700px align-items-center">
                
                <div class="menu-item">
                    <strong class="text-uppercase"> <?= CMS::getSiteConfigurationData("defaultPageTitle"); ?> </strong> 
                    <span class="text-gray-500"> 
                       >
                      <?= date("l, d/m/Y H:i:s"); ?> >  
                      logged from: <span class="fw-bolder"> <?= Auth::getUserData($_SESSION['user'], "email"); ?> </span>
                    </span> 
                </div>
              
              </div>
          </div>
</div>