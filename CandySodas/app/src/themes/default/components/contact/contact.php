<section class="contact-page pad-tb bg-gradient5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="niwax23form shadow">
            <div class="common-heading text-l">
              <p class="mb50 mt10"> 
                Entraremos em contato assim que recebermos sua mensagem dentro de nosso horário de 
                expediente: Segunda a Sexta-feira, das 9h às 18h
              </p>
            </div>
            <div class="contact-form-card-pr contact-block-sw m0 iconin">
              <div class="form-block niwaxform">
                <form 
                  method="post" 
                  pagefai-form="true"
                  class="frm-show-form contact-me-form" 
                  id="pagefai-form"
                >
                  <div class="fieldsets row">
                    <div class="col-md-6 form-group floating-label">
                      <div class="formicon"><i class="fas fa-user"></i></div>
                      <input 
                        type="text" 
                        required="required" 
                        id="name" 
                        class="floating-input" 
                        name="name"
                        pagefai-form="true"
                      >
                      <label>Nome Completo *</label>
                      <div class="error-label"></div>
                    </div>
                    <div class="col-md-6 form-group floating-label">
                      <div class="formicon"><i class="fas fa-phone-alt"></i></div>
                      <input 
                        type="tel" 
                        required="required" 
                        id="phone" 
                        class="floating-input" 
                        name="phone"
                        pagefai-form="true"
                      >
                      <label>Telefone*</label>
                      <div class="error-label"></div>
                    </div>
                  </div>
                  <div class="fieldsets row">
                    <div class="col-md-6 form-group floating-label">
                      <div class="formicon"><i class="fas fa-envelope"></i></div>
                      <input 
                        type="email" 
                        placeholder="" 
                        required="required" 
                        id="email" 
                        class="floating-input" 
                        name="email"
                        pagefai-form="true"
                      >
                      <label>Endereço de E-mail *</label>
                      <div class="error-label"></div>
                    </div>
                    <div class="col-md-6 form-group floating-label">
                      <div class="formicon"><i class="fas fa-file-alt"></i></div>
                      <select 
                        required="required" 
                        id="interested_in" 
                        class="floating-select" 
                        name="interested_in"
                        pagefai-form="true"
                      >
                        <option value="">&nbsp;</option>
                        <option value="comercial"> Contato comercial </option>
                        <option value="financeiro"> Contato Financeiro </option>
                        <option value="reclamação"> Reclamações </option>
                        <option value="outros"> Outros </option>
                      </select>
                      <label>Interesse em*</label>
                      <div class="error-label"></div>
                    </div>
                  </div>
                  <div class="fieldsets row textareax">
                    <div class="col-md-12 form-group floating-label">
                      <div class="formicon"><i class="fas fa-comment-dots"></i></div>
                      <textarea 
                        placeholder=" " 
                        required="required" 
                        id="message" 
                        class="floating-input" 
                        name="message"
                        pagefai-form="true"
                      ></textarea>
                      <label> Descreva sua mensagem *</label>
                      <div class="error-label"></div>
                      <input 
                      name="id" 
                      id="id"
                      type="hidden"
                      pagefai-form="true"
                      value="31dea076-0eb0-11f0-9cd2-0242ac120002">
                    </div>
                  </div>
                  <div class="custom-control custom-checkbox ctmsetsw">
                    <input 
                      type="checkbox" 
                      class="custom-control-input ctminpt" 
                      id="lgpd" 
                      name="lgpd" 
                      pagefai-form="true"
                    >
                    <label class="custom-control-label ctmlabl" for="agree"> Ao clicar em "Enviar" você concorda com nossos  <a href="javascript:void(0)"> Termos &amp; Condições </a>.</label>
                  </div>
                  <div class="fieldsets mt20"> 
                    <!-- <button type="submit" name="submit" class="btn btn-main bg-btn w-fit mb20">
                      <span>Enviar <i class="fas fa-chevron-right fa-icon"></i></span> 
                      <span class="loader"></span>
                    </button>  -->

                    <button 
                      class="btn btn-main bg-btn w-fit mb20"
                      id="pagefai-submit-form"
                    >
                        Enviar <span class="arrow-right"></span>
                        <span class="loader"></span>
                    </button>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
        async function handleSubmit(event) {
            event.preventDefault();
            const formElements = document.querySelectorAll('[pagefai-form="true"]');
            const formElementsArray = Array.from(formElements);
            
            const formData = {};
            formElementsArray.forEach(element => {
                formData[element.name] = element.value;
            });
            
            formData.timestamp = new Date().toISOString();
            
            const formDataJSON = JSON.stringify(formData);
            document.cookie = `pagefai-contact-form=${encodeURIComponent(formDataJSON)}; path=/`;

            try {
                const response = await fetch('/sendmail.html', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(formData) 
                });

                if (response.status === 200) {
                    alert('Mensagem enviada com sucesso!');
                    window.location.reload();
                } else {
                    console.error('Erro ao enviar o e-mail');
                }
            } catch (error) {
                console.error(error);
            }
        }

        const submitButton = document.getElementById('pagefai-submit-form');
        submitButton.addEventListener('click', handleSubmit);
    </script>