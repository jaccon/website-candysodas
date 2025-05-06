<?php 
  global $CONFIG;
  include('../../core/featureflags/featureflags.inc.php');
  session_start();
  Auth::loginSession();
  $userId = Auth::getUserData($_SESSION['user'], "id");
  $usergroup = Auth::getUserData($_SESSION['user'], "usergroup");
  $name = Auth::getUserData($_SESSION['user'], "name");
  $avatar = Auth::getUserData($_SESSION['user'], "avatar");
  $thumbnail = Auth::getAvatar($avatar);
  $login = Auth::getUserData($_SESSION['user'], "email");
?>
<style>
.app-header-primary {
    background: #006AE6 !important;
}
</style>
<div class="app-header-primary "
  data-kt-sticky="true" data-kt-sticky-name="app-header-primary-sticky" data-kt-sticky-offset="{default: 'false', lg: '300px'}"                  
  >
  <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between " id="kt_app_header_primary_container">
      <div class="d-flex flex-grow-1 flex-lg-grow-0">
        <div class="d-flex align-items-center me-7" id="kt_app_header_logo_wrapper">
            <button class="d-lg-none btn btn-icon btn-color-white btn-active-color-primary ms-n3 me-2" id="kt_app_header_menu_toggle">
            <i class="ki-duotone ki-abstract-14 fs-1"><span class="path1"></span><span class="path2"></span></i>        </button>
            <a href="home.html" class="d-flex align-items-center mb-1 mb-lg-0 pt-lg-1">
            <img alt="Logo" src="assets/media/logos/logotipo-white.svg" class="" width="40"/>             
            </a>
        </div>
        <div 
            class="app-header-menu app-header-mobile-drawer align-items-lg-end p-2 p-lg-0"
            data-kt-drawer="true"
            data-kt-drawer-name="app-header-menu"
            data-kt-drawer-activate="{default: true, lg: false}"
            data-kt-drawer-overlay="true"
            data-kt-drawer-width="250px"
            data-kt-drawer-direction="start"
            data-kt-drawer-toggle="#kt_app_header_menu_toggle"
            data-kt-swapper="true"
            data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}"
            >
            <div 
              class="menu            
              menu-active-bg 
              menu-state-primary 
              menu-rounded 
              menu-column 
              menu-lg-row 
              menu-title-gray-700 
              menu-icon-gray-500 
              menu-arrow-gray-500 
              menu-bullet-gray-500 
              align-items-stretch fw-semibold px-2 px-lg-0
              "         
              id="kt_app_header_menu"
              data-kt-menu="true"
              >
              <div  class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
                  <span class="menu-link"  >
                    <span  class="menu-title" > <a href="home.html"> Home </a> </span>
                  </span>
              </div>

              <?php if(Configurations::settings($CONFIG['CONF']['systemConfigurationId'],'postStatus') === '1') { ?>
                <div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
                      <span class="menu-link"  ><span  class="menu-title" > 
                        
                      <?= MENU_POSTS; ?>

                      </span><span  class="menu-arrow d-lg-none" ></span></span>
                      
                      <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px" >
                        
                        <div  class="menu-item" >
                            <a class="menu-link"  href="posts.html"  >
                                <span  class="menu-bullet" >
                                  <span class="bullet bullet-dot"></span>
                                </span>
                                <span  class="menu-title" > Posts </span>
                              </a>
                        </div>

                        <div  class="menu-item" >
                          <a class="menu-link"  href="pages.html"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Pages </span>
                            </a>
                      </div>
                        
                      <div  class="menu-item" >
                          <a class="menu-link"  href="categories-list.html"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Categories </span>
                            </a>
                      </div>

                      <div  class="menu-item" >
                            <a class="menu-link"  href="components.html"  >
                                <span  class="menu-bullet" >
                                  <span class="bullet bullet-dot"></span>
                                </span>
                                <span  class="menu-title" > Components </span>
                              </a>
                        </div>
                        <div  class="menu-item" >
                            <a class="menu-link"  href="slideshows.html"  >
                                <span  class="menu-bullet" >
                                  <span class="bullet bullet-dot"></span>
                                </span>
                                <span  class="menu-title" > Slideshow Manager </span>
                              </a>
                        </div>

                      <div  class="menu-item" >
                          <a class="menu-link"  href="#"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Change History </span>
                            </a>
                      </div>

                      <div  class="menu-item" >
                            <a class="menu-link"  href="#"  >
                                <span  class="menu-bullet" >
                                  <span class="bullet bullet-dot"></span>
                                </span>
                                <span  class="menu-title" > Import / Export </span>
                              </a>
                        </div>
                      </div>
                </div>
              <?php } ?>

              <?php if(Configurations::settings($CONFIG['CONF']['systemConfigurationId'],'omStatus') === '1') { ?>
                <div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
                      <span class="menu-link"  ><span  class="menu-title" > 
                        
                      CRM

                      </span><span  class="menu-arrow d-lg-none" ></span></span>
                      
                      <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px" >
                        
                        <div  class="menu-item" >
                            <a class="menu-link"  href="forms.html"  >
                                <span  class="menu-bullet" >
                                  <span class="bullet bullet-dot"></span>
                                </span>
                                <span  class="menu-title" > Forms </span>
                              </a>
                        </div>

                        <div  class="menu-item" >
                          <a class="menu-link"  href="#"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Leads </span>
                            </a>
                        </div>
                        
                      <div  class="menu-item" >
                          <a class="menu-link"  href="#"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Message Diagnostic </span>
                            </a>
                      </div>

                      <div  class="menu-item" >
                            <a class="menu-link"  href="#"  >
                                <span  class="menu-bullet" >
                                  <span class="bullet bullet-dot"></span>
                                </span>
                                <span  class="menu-title" > Import / Export </span>
                              </a>
                        </div>
                      </div>

                </div>
              <?php } ?>

              <?php if(Configurations::settings($CONFIG['CONF']['systemConfigurationId'],'ecomStatus') === '1') { ?>
                <div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2" >
                    
                  <span class="menu-link"  ><span  class="menu-title" > 
                    <?= MENU_ECOMM; ?>
                  </span>
                  <span  class="menu-arrow d-lg-none" ></span></span>

                    <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px" >
                      <div  class="menu-item" >
                          <a class="menu-link"  href="catalog.html"  >
                            <span  class="menu-bullet" >
                              <span class="bullet bullet-dot"></span>
                            </span>
                            <span  class="menu-title" > Catalog </span></a>
                      </div>
                      <div  class="menu-item" >
                          <a class="menu-link"  href="#"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Orders </span>
                            </a>
                      </div>
                      <div  class="menu-item" >
                          <a class="menu-link"  href="#"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Coupons </span>
                            </a>
                      </div>
                      <div  class="menu-item" >
                          <a class="menu-link"  href="catalog-import.html"  >
                              <span  class="menu-bullet" >
                                <span class="bullet bullet-dot"></span>
                              </span>
                              <span  class="menu-title" > Import </span>
                            </a>
                      </div>
                    </div>
                </div>
              <?php } ?>

              <?php if(Configurations::settings($CONFIG['CONF']['systemConfigurationId'],'customStatus') === '1') { ?>
                <div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2" >
                    <span class="menu-link"  ><span  class="menu-title" > 
                      <?= MENU_CUSTOM; ?>  
                    </span>
                    <span  class="menu-arrow d-lg-none" ></span></span>
                    <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px" >

                      <div  class="menu-item">
                        <a class="menu-link"  href="projects.html" 
                          title="Check out over 200 in-house components, plugins and ready for use solutions" 
                          data-bs-toggle="tooltip" 
                          data-bs-trigger="hover" 
                          data-bs-dismiss="click" 
                          data-bs-placement="right">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-element-8 fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                              </i>
                            </span>
                            <span  class="menu-title" > Projetos </span>
                          </a>
                      </div>

                      <div  class="menu-item">
                        <a class="menu-link"  href="customers.html" 
                          data-bs-trigger="hover">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-element-8 fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                              </i>
                            </span>
                            <span  class="menu-title" > Clientes </span>
                          </a>
                      </div>

                      <div  class="menu-item">
                        <a class="menu-link"  href="customers.html" 
                          data-bs-trigger="hover">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-element-8 fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                              </i>
                            </span>
                            <span  class="menu-title" > Fornecedores </span>
                          </a>
                      </div>

                      <div  class="menu-item">
                        <a class="menu-link"  href="reports.html" 
                          data-bs-trigger="hover">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-element-8 fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                              </i>
                            </span>
                            <span  class="menu-title" > Relatórios </span>
                          </a>
                      </div>
                      
                    </div>
                </div>
              <?php } ?>

              
              <?php if(Configurations::settings($CONFIG['CONF']['systemConfigurationId'],'addOnStatus') === '1') { ?>
                <?php 
                  if( Auth::getUserData($_SESSION['user'], "usergroup") === "admin" ) {
                ?>
                  <div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2" >
                      <span class="menu-link"  ><span  class="menu-title" > Add-Ons </span>
                      <span  class="menu-arrow d-lg-none" ></span></span>
                      <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px" >

                        <?php if(Configurations::settings($CONFIG['CONF']['systemConfigurationId'],'fmStatus') === '1') { ?>
                          <div  class="menu-item" >
                              <a class="menu-link"  href="file-manager.html">
                                <span  class="menu-icon" >
                                  <i class="ki-duotone ki-code fs-2"><span class="path1"></span>
                                  <span class="path2"></span><span class="path3"></span>
                                  <span class="path4"></span></i></span>
                                  <span  class="menu-title" >File Manager </span></a>
                          </div>

                          <div  class="menu-item" >
                              <a class="menu-link"  href="calendar.html">
                                <span  class="menu-icon" >
                                  <i class="ki-duotone ki-code fs-2"><span class="path1"></span>
                                  <span class="path2"></span><span class="path3"></span>
                                  <span class="path4"></span></i></span>
                                  <span  class="menu-title" > Calendar </span></a>
                          </div>
                          
                        <?php } ?>

                        

                      </div>
                  </div>
                <?php } ?>
              <?php } ?>

              <?php 
                if( Auth::getUserData($_SESSION['user'], "usergroup") === "admin" ) {
              ?>
                <div  data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"  class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2" >
                    <span class="menu-link"  ><span  class="menu-title" > <?= MENU_SYS; ?>   </span>
                    <span  class="menu-arrow d-lg-none" ></span></span>
                    <div  class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px" >
                      <div  class="menu-item" >
                          <a class="menu-link"  href="users.html" title="Check out over 200 in-house components, plugins and ready for use solutions" 
                          data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right"  >
                          <span  class="menu-icon" ><i class="ki-duotone ki-element-8 fs-1"><span class="path1"></span><span class="path2"></span></i></span>
                          <span  class="menu-title" > Users </span></a>
                      </div>

                      <div  class="menu-item" >
                          <a class="menu-link"  href="site-configuration.html">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-code fs-2"><span class="path1"></span>
                              <span class="path2"></span><span class="path3"></span>
                              <span class="path4"></span></i></span>
                              <span  class="menu-title" > Site Configuration </span></a>
                      </div>

                      <div  class="menu-item" >
                          <a class="menu-link"  href="login-history.html">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-code fs-2"><span class="path1"></span>
                              <span class="path2"></span><span class="path3"></span>
                              <span class="path4"></span></i></span>
                              <span  class="menu-title" > Login History </span></a>
                      </div>

                      <div  class="menu-item" >
                          <a 
                            class="menu-link"  
                            href="documentation.html" 
                            title="A SGIX Documentation" 
                            data-bs-toggle="tooltip" 
                            data-bs-trigger="hover" 
                            data-bs-dismiss="click" 
                            data-bs-placement="right">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-switch fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                              <span  class="menu-title" > Documentation </span>
                            </a>
                      </div>

                      <div  class="menu-item" >
                          <a 
                            class="menu-link"  
                            href="system-status.html" 
                            title="A System Status Informations" 
                            data-bs-toggle="tooltip" 
                            data-bs-trigger="hover" 
                            data-bs-dismiss="click" 
                            data-bs-placement="right">
                            <span  class="menu-icon" >
                              <i class="ki-duotone ki-switch fs-2"><span class="path1"></span><span class="path2"></span></i></span>
                              <span  class="menu-title" > System Status </span>
                            </a>
                      </div>


                    </div>
                </div>
              <?php } ?>

            </div>
        </div>
      </div>

      <div class="app-navbar flex-shrink-0">
        <div class="app-navbar-item align-items-stretch ms-1 ms-lg-3">
            <div 
              id="kt_header_search" 
              class="header-search d-flex align-items-stretch" 
              data-kt-search-keypress="true"
              data-kt-search-min-length="2"
              data-kt-search-enter="enter"     
              data-kt-search-layout="menu"
              data-kt-menu-trigger="auto" 
              data-kt-menu-overflow="false" 
              data-kt-menu-permanent="true" 
              data-kt-menu-placement="bottom-end" 
              >
              
                <div class="d-flex align-items-center">
                  <a href="search.html">
                    <div class="btn btn-icon btn-color-white">
                      <i class="ki-duotone ki-magnifier fs-1"><span class="path1"></span><span class="path2"></span></i>                    
                    </div>
                  </a>
                </div>

            </div>
        </div>
        
        <div class="app-navbar-item ms-1 ms-lg-3">
        </div>
          <div class="app-navbar-item ms-5 me-4" id="kt_header_user_menu_toggle">
              <div class="cursor-pointer symbol symbol-35px"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" 
                data-kt-menu-attach="parent" 
                data-kt-menu-placement="bottom-end"
                >
                <img class="symbol symbol-35px" src="<?= $thumbnail; ?>" alt="user"/>             
              </div>

              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                      <div class="symbol symbol-50px me-5">
                          <img alt="Logo" src="<?= $thumbnail; ?>"/>
                      </div>
                      <div class="d-flex flex-column">
                          <div class="fw-bold d-flex align-items-center fs-5">
                            <?= $name; ?>
                          </div>
                          <a href="projects.html#" class="fw-semibold text-muted text-hover-primary fs-7">
                            <?= $login; ?>  
                            <?= $_SESSION['language']; ?>
                          </a>
                      </div>
                    </div>
                </div>
            
                <div class="separator my-2"></div>
              
                <div class="menu-item px-5">
                    <a href="my-account.html" class="menu-link px-5">
                      <?= SUBMENU_MYACCOUNT; ?>
                    </a>
                </div>
              
                
              
                <div class="separator my-2"></div>

                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                    <span class="menu-title position-relative">
                      Mode 
                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                    <i class="ki-duotone ki-night-day theme-light-show fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>                        <i class="ki-duotone ki-moon theme-dark-show fs-2"><span class="path1"></span><span class="path2"></span></i>                    </span>
                    </span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                      <div class="menu-item px-3 my-0">
                          <a href="projects.html#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                          <span class="menu-icon" data-kt-element="icon">
                          <i class="ki-duotone ki-night-day fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>            </span>
                          <span class="menu-title">
                          Light
                          </span>
                          </a>
                      </div>
                      <div class="menu-item px-3 my-0">
                          <a href="projects.html#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                          <span class="menu-icon" data-kt-element="icon">
                          <i class="ki-duotone ki-moon fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                          <span class="menu-title">
                          Dark
                          </span>
                          </a>
                      </div>
                    
                      <div class="menu-item px-3 my-0">
                          <a href="projects.html#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                          <span class="menu-icon" data-kt-element="icon">
                          <i class="ki-duotone ki-screen fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>            </span>
                          <span class="menu-title">
                            System
                          </span>
                          </a>
                      </div>
                    </div>
                </div>
                <div class="menu-item px-5">
                    <a href="logout.html" class="menu-link px-5">
                      Logout
                    </a>
                </div>
              </div>
          </div>
        </div>
      </div>
      </div>

<!-- Sub Menu Navigation -->
<?php
 if(ENABLE_SUBMENU == 1) {
  include(__DIR__.'/sub-menu.inc.php');
 }