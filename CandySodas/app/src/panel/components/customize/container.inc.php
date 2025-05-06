
         <div
         id="kt_app_layout_builder"
         class="bg-body"
         data-kt-drawer="true"
         data-kt-drawer-name="app-settings"
         data-kt-drawer-activate="true"
         data-kt-drawer-overlay="true"
         data-kt-drawer-width="{default:'300px', 'lg': '380px'}"
         data-kt-drawer-direction="end"
         data-kt-drawer-toggle="#kt_app_layout_builder_toggle"
         data-kt-drawer-close="#kt_app_layout_builder_close">
         <!--begin::Card-->
         <div class="card border-0 shadow-none rounded-0 w-100">
            <!--begin::Card header-->
            <div 
               class="card-header bgi-position-y-bottom bgi-position-x-end bgi-size-cover bgi-no-repeat rounded-0 border-0 py-4" 
               id="kt_app_layout_builder_header"
               style="background-image:url('../assets/media/misc/layout/customizer-header-bg.jpg')">
               <!--begin::Card title-->
               <h3 class="card-title fs-3 fw-bold text-dark flex-column m-0 dark">
                  SGIX Shortcuts
               </h3>
               <!--end::Card title-->
               <!--begin::Card toolbar-->
               <div class="card-toolbar">
                  <button 
                     type="button" 
                     class="btn btn-sm btn-icon btn-color-white p-0 w-20px h-20px rounded-1" 
                     id="kt_app_layout_builder_close"
                     >
                  <i class="ki-duotone ki-cross-square fs-2"><span class="path1"></span><span class="path2"></span></i>        </button>
               </div>
               <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body position-relative" id="kt_app_layout_builder_body">
               <!--begin::Content-->
               <div id="kt_app_settings_content"
                  class="position-relative scroll-y me-n5 pe-5"
                  data-kt-scroll="true"
                  data-kt-scroll-height="auto"
                  data-kt-scroll-wrappers="#kt_app_layout_builder_body"
                  data-kt-scroll-dependencies="#kt_app_layout_builder_header, #kt_app_layout_builder_footer"
                  data-kt-scroll-offset="5px">
                  <!--begin::Form-->
                  <form class="form" method="POST" id="kt_app_layout_builder_form" action="https://preview.keenthemes.com/oliver-html-pro/index.php">
                     <input type="hidden" id="kt_app_layout_builder_action" name="layout-builder[action]"/>
                     <!--begin::Card body-->
                     <div class="card-body p-0">
                        <!--begin::Form group-->
                        <div class="form-group">
                           <!--begin::Heading-->
                           <div class="mb-6">
                              <h4 class="fw-bold text-gray-900">Theme Mode</h4>
                           </div>
                           <!--end::Heading-->  
                           <!--begin::Options-->
                           <div class="row " data-kt-buttons="true" data-kt-buttons-target=".form-check-image,.form-check-input">
                              <!--begin::Col-->
                              <div class="col-6">
                                 <!--begin::Option-->
                                 <label class="form-check-image form-check-success">
                                    <!--begin::Image--> 
                                    <div class="form-check-wrapper border-gray-200 border-2">
                                       <img src="assets/media/preview/light.png" class="mw-100 mh-250px" alt=""/>                  
                                    </div>
                                    <!--end::Image--> 
                                    <!--begin::Check--> 
                                    <div class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                       <input 
                                          class="form-check-input" 
                                          type="radio" 
                                          value="light" 
                                          name="theme_mode" 
                                          id="kt_layout_builder_theme_mode_light"/>
                                       <!--begin::Label--> 
                                       <div class="form-check-label text-gray-700">
                                          Light						
                                       </div>
                                       <!--end::Label--> 
                                    </div>
                                    <!--end::Check--> 
                                 </label>
                                 <!--end::Option-->             
                              </div>
                              <!--end::Col-->
                              <!--begin::Col-->
                              <div class="col-6">
                                 <!--begin::Option-->
                                 <label class="form-check-image form-check-success">
                                    <!--begin::Image--> 
                                    <div class="form-check-wrapper border-gray-200 border-2">
                                       <img src="assets/media/preview/dark.png" class="mw-100 mh-250px" alt=""/>                  
                                    </div>
                                    <!--end::Image--> 
                                    <!--begin::Check--> 
                                    <div class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                       <input 
                                          class="form-check-input" 
                                          type="radio" 
                                          value="dark" 
                                          name="theme_mode" 
                                          id="kt_layout_builder_theme_mode_dark"/>
                                       <!--begin::Label--> 
                                       <div class="form-check-label text-gray-700">
                                          Dark						
                                       </div>
                                       <!--end::Label--> 
                                    </div>
                                    <!--end::Check--> 
                                 </label>
                                 <!--end::Option-->             
                              </div>
                              <!--end::Col-->
                           </div>
                           <!--end::Options-->            
                        </div>
                        <!--end::Form group-->		
                        <div class="separator separator-dashed my-5"></div>
                       
                        <div class="separator separator-dashed my-5"></div>
                        <!--begin::Form group-->
                        <div class="form-group ">
                           <!--begin::Heading-->     
                           <div class="d-flex flex-column mb-4">
                              <h4 class="fw-bold text-gray-900"> AI Creation Content </h4>
                           </div>
                           <!--end::Heading-->
                           <!--begin::Options-->
                           <div class="d-flex flex-stack gap-3 " data-kt-buttons="true" data-kt-buttons-target=".form-check-image,.form-check-input">
                              <!--begin::Option-->
                              <label class="form-check-image form-check-success w-100 parent-active parent-hover active">
                                 <!--begin::Image--> 
                                 <div class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                    <i class="ki-duotone ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"><span class="path1"></span><span class="path2"></span></i>	
                                    <span class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Duotone</span>			                 
                                 </div>
                                 <!--end::Image--> 
                                 <!--begin::Check--> 
                                 <div style="visibility: hidden; height: 0 !important; width: 0 !importnat; overflow:hidden">
                                    <input 
                                       class="form-check-input" 
                                       type="radio" 
                                       value="duotone" 
                                       checked 
                                       name="layout-builder[layout][app][general][icons]"/>
                                 </div>
                                 <!--end::Check--> 
                              </label>
                              <!--end::Option-->   
                              <!--begin::Option-->
                              <label class="form-check-image form-check-success w-100 parent-active parent-hover ">
                                 <!--begin::Image--> 
                                 <div class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                    <i class="ki-outline ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"></i>	
                                    <span class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Outline</span>			                 
                                 </div>
                                 <!--end::Image--> 
                                 <!--begin::Check--> 
                                 <div style="visibility: hidden; height: 0 !important; width: 0 !importnat; overflow:hidden">
                                    <input 
                                       class="form-check-input" 
                                       type="radio" 
                                       value="outline" 
                                       name="layout-builder[layout][app][general][icons]"/>
                                 </div>
                                 <!--end::Check--> 
                              </label>
                              <!--end::Option-->   
                              <!--begin::Option-->
                              <label class="form-check-image form-check-success w-100 parent-active parent-hover ">
                                 <!--begin::Image--> 
                                 <div class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                    <i class="ki-solid ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"></i>	
                                    <span class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Solid</span>			                 
                                 </div>
                                 <div style="visibility: hidden; height: 0 !important; width: 0 !importnat; overflow:hidden">
                                    <input 
                                       class="form-check-input" 
                                       type="radio" 
                                       value="solid" 
                                       name="layout-builder[layout][app][general][icons]"/>
                                 </div>
                              </label>
                           </div>
                        </div>
                        
                     </div>
                  </form>
               </div>
            </div>
            <div class="card-footer border-0 d-flex gap-3 pb-9 pt-0" id="kt_app_layout_builder_footer">
               <a href="<?= $CONFIG['CONF']['siteUrl']; ?>" class="btn btn-primary flex-grow-1 fw-semibold">
                  <span class="indicator-label">
                  Preview Website </span>
               </a>
            </div>
         </div>
      </div>