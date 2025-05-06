<?php 
include(__DIR__ . '/../../config.inc.php');
include(__DIR__ . '/../../core/featureflags/featureflags.inc.php');

Configurations::checkFeatureStatus('regUserStatus');

global $CONFIG;
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <title> <?= PAGE_TITLE; ?> </title>
        <meta charset="utf-8"/>
        <meta name="description" content="SGIX Content Management System, fast, secure"/>
        <meta name="keywords" content="SGIX CMS, SGIX Content Management System, Secure, Flexible"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="SGIX CMS | Powerful CMS" />
        <meta property="og:url" content="https://www.sgix.com.br"/>
        <meta property="og:site_name" content="SGIX CMS | Powerful CMS" />
        <link rel="canonical" href="basic.html"/>
        <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
        <script>
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
   
    <body  id="kt_body"  class="app-blank" >
    <script>
      var defaultThemeMode = "light";
      var themeMode;

      if ( document.documentElement ) {
        if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
          themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
          if ( localStorage.getItem("data-bs-theme") !== null ) {
            themeMode = localStorage.getItem("data-bs-theme");
          } else {
            themeMode = defaultThemeMode;
          }			
        }

        if (themeMode === "system") {
          themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
      }            
    </script>
        
<div class="d-flex flex-column flex-root" id="kt_app_root">
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <div class="d-flex flex-row-fluid flex-column text-center p-5 p-lg-10 pt-lg-20">          
                
                <h1 class="d-none d-lg-block fw-bold text-white fs-2qx pb-5 pb-md-10">
                  <img alt="Logo" src="assets/media/logos/default.png" class="" width="120"/>  <br/><br/> 
                  <?= WELCOME_MESSAGE; ?>   
                </h1>
             
                <p class="d-none d-lg-block fw-semibold fs-2 text-white">
                  <?= WELCOME_MESSAGE_TXT2; ?>
                </p>
            </div>
           
            <div class="d-none d-lg-block d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" 
                style="background-image: url(../../assets/media/illustrations/sketchy-1/17.png)"> 
            </div>
        </div>
    </div>
 
    <div class="d-flex flex-column flex-lg-row-fluid py-10">
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <div class="w-lg-600px p-10 p-lg-15 mx-auto">

              <form action="" method="POST" class="form w-100">

                <div class="mb-10 text-center">
                    <h1 class="text-gray-900 mb-3">
                        <?= REGISTER_TXT_1; ?>
                    </h1>
                  
                    <div class="text-gray-500 fw-semibold fs-4">

                        <?= REGISTER_TXT_2; ?>

                        <a href="index.html" class="link-primary fw-bold">
                            <?= REGISTER_TXT_3; ?> 
                        </a>
                    </div>
                </div>
               
                <?php if (LOGIN_GOOGLE): ?>

                    <button type="button" class="btn btn-light-primary fw-bold w-100 mb-10">
                        <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3"/>     
                        <?= REGISTER_TXT_4; ?>
                    </button>

                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-semibold text-gray-500 fs-7 mx-2">
                          <?= FORM_OR; ?>
                        </span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div> 
                
                    <?php endif; ?>
                
                <div class="row fv-row mb-7">
                    <div class="col-xl-12">                           
                        <label class="form-label fw-bold text-gray-900 fs-6">
                          <?= FORM_TXT_01; ?>
                        </label>
                        <input 
                          class="form-control form-control-lg form-control-solid" 
                          type="text" 
                          placeholder="" 
                          id="name"
                          name="name" 
                          autocomplete="off" 
                        />
                    </div>
                </div>
               
                <div class="fv-row mb-7">
                    <label class="form-label fw-bold text-gray-900 fs-6"> Phone </label>
                    <input 
                      class="form-control form-control-lg form-control-solid" 
                      type="text" 
                      placeholder="" 
                      name="phone"
                      id="phone" 
                      autocomplete="off" />
                </div>

                <input type="hidden" id="uuid" name="uuid" value="">

                <div class="fv-row mb-7">
                    <label class="form-label fw-bold text-gray-900 fs-6">Email</label>
                    <input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" />
                </div>
               
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <div class="mb-1">
                        <label class="form-label fw-bold text-gray-900 fs-6">
                          <?= FORM_TXT_03; ?>
                        </label> 
                     
                        <div class="position-relative mb-3">    
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off"/>
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="ki-duotone ki-eye-slash fs-2"></i>                    
                                <i class="ki-duotone ki-eye fs-2 d-none"></i>                
                              </span>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                    </div>
                    
                    <div class="text-muted">
                        <?= FORM_TXT_04; ?>
                    </div>
                </div>
                
                <div class="fv-row mb-5">
                    <label class="form-label fw-bold text-gray-900 fs-6">
                      <?= FORM_TXT_05; ?>
                    </label>
                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" autocomplete="off" />
                </div>
               
                <div class="fv-row mb-10">
                    <label class="form-check form-check-custom form-check-solid form-check-inline">
                        <input class="form-check-input" type="checkbox" name="toc" value="1"/>
                        <span class="form-check-label fw-semibold text-gray-700 fs-6">
                            <?= FORM_TXT_07; ?> </a>.
                        </span>
                    </label>
                </div>
               
                <div class="text-center">
                        
                        <button 
                            type="submit" 
                            class="btn btn-lg btn-primary"
                        >
                        <span class="indicator-label">
                          <?= FORM_TXT_08; ?> </a>
                        </span>

                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>  
                          
                    </button>
                </div>
            </form>
            </div>
        </div>
        <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
            <div class="d-flex flex-center fw-semibold fs-6">
                <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
            </div>
        </div>
    </div>
</div>
        </div>
        
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <script src="assets/js/custom/authentication/sign-up/general.js"></script>

        <script>
          async function fetchUuid() {
              try {
                  const response = await fetch('https://www.uuidgenerator.net/api/version1');
                  if (!response.ok) {
                      throw new Error('Erro ao buscar UUID');
                  }
                  const uuid = await response.text();
                  document.getElementById('uuid').value = uuid;
                  console.log(uuid);
              } catch (error) {
                  console.error(error);
                  alert('Erro ao obter UUID');
              }
          }
        window.onload = fetchUuid;
    </script>

    <script>
        async function submitForm(event) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);

            const userData = {
                uuid: formData.get('uuid'),
                email: formData.get('email'),
                password: formData.get('password'),
                confirm_password: formData.get('confirm-password'),
                name: formData.get('name'),
                phone: formData.get('phone'),
            };

            try {
                const response = await fetch('/api/register-user', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(userData),
                });

                const result = await response.json();

                if (response.ok) {
                    // Alerta de sucesso
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: result.message || 'Usuário registrado com sucesso.',
                    }).then(() => {
                        // Redirecionar após o clique no botão "OK"
                        window.location.href = window.location.href; // Redireciona para a mesma página
                    });
                } else {
                    // Alerta de erro
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: result.error || 'Ocorreu um erro ao registrar o usuário.',
                    }).then(() => {
                        // Redirecionar após o clique no botão "OK"
                        window.location.href = window.location.href; // Redireciona para a mesma página
                    });
                }
            } catch (error) {
                // Alerta de erro no envio
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Erro ao enviar dados. Tente novamente mais tarde.',
                }).then(() => {
                    // Redirecionar após o clique no botão "OK"
                    window.location.href = window.location.href; // Redireciona para a mesma página
                });
                console.error('Erro ao enviar dados:', error);
            }
        }
        
        document.querySelector('form').addEventListener('submit', submitForm);
    </script>

    </body>
</html>