<?php 
include(__DIR__ . '../../../../core/featureflags/featureflags.inc.php');
if (ENABLE_MYACCOUNT_RESUME != 0):
?>
<div class="card mb-5 mb-xl-10">
  <div class="card-body pt-9 pb-0">
      
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        
        <div class="me-7 mb-4">
            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
              <img src="https://preview.keenthemes.com/oliver-html-pro/assets/media/avatars/300-1.jpg" alt="image" />
              <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
            </div>
        </div>
        
        
        <div class="flex-grow-1">
            
            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
              
              <div class="d-flex flex-column">
                  
                  <div class="d-flex align-items-center mb-2">
                    <span class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"> 
                      <?= $name; ?> 
                    </span>
                    <i class="ki-duotone ki-verify fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
                  </div>
                  
                  <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                    <span href="settings.html#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                    <i class="ki-duotone ki-profile-circle fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                                
                      <?= $usergroup; ?> 
                    </span>
                    <a href="settings.html#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                      <i class="ki-duotone ki-sms fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>                               
                      <?= $login ; ?>
                    </a>
                  </div>
              </div>
            </div>
            
            
            <div class="d-flex flex-wrap flex-stack">
              
              <div class="d-flex flex-column flex-grow-1 pe-8">
                  
                  <div class="d-flex flex-wrap">
                    
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        <div class="d-flex align-items-center">
                          <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500">0</div>
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500"> Posts </div>
                    </div>
                    
                    
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        
                        <div class="d-flex align-items-center">
                          <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="75">0</div>
                        </div>
                        
                        
                        <div class="fw-semibold fs-6 text-gray-500"> Pages </div>
                        
                    </div>
                    
                    
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                        
                        <div class="d-flex align-items-center">
                          <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                    
                          <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
                        </div>
                        
                        
                        <div class="fw-semibold fs-6 text-gray-500">Success Rate</div>
                        
                    </div>
                    
                  </div>
                  
              </div>
              
              <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                  <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                    <span class="fw-semibold fs-6 text-gray-500"> Profile Compleation </span>
                    <span class="fw-bold fs-6">
                      50%
                    </span>
                  </div>
                  <div class="h-5px mx-3 w-100 bg-light mb-3">
                    <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>

<?php endif; ?>