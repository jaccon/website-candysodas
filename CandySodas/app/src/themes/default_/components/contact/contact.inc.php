<?php
// include('../config.inc.php');
global $CONFIG;
$pageId="66c44126-5a96-11ee-8c99-0242ac120002";

$title = CMS::isPage($pageId, "slug");
$featuredImage = CMS::isPage($pageId, "featuredImage");

// Site Configuration
$siteUrl = $CONFIG['CONF']['siteUrl'];

// SEO
$metaIdSeo = "0ff54848-c781-11ed-afa1-0242ac120002";
$pgTitle = Seo::isSeo($metaIdSeo, "defaultPageTitle")." - ".$title;
$siteDescription = Seo::isSeo($metaIdSeo, "description");
$siteAuthor = Seo::isSeo($metaIdSeo, "author");
$keywords = Seo::isSeo($metaIdSeo, "keywords");
$favicon = Seo::isSeo($metaIdSeo, "favicon");

?>

<style>
input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea.form-control:focus {
    background-color: var(--color-five);
    border-color: var(--main-color);
    color: #000 !important;
    outline: none;
    outline-offset: 0px;
    box-shadow: none;
    transition: all 0.5s ease-in-out;
}
</style>

<section class="contact-section home" id="contato">
  <div class="container">
    <div class="contact-form default-form mt-0">
      <div class="row">
        <div class="col-lg-7 col-md-8 offset-lg-5 offset-md-4">

            <form 
              class="pgCustomForm" 
              id="pagefai-form" 
              pagefai-form="true">

            <div class="sec-title">
              <div class="title">FALE CONOSCO</div>
              <h1>Vamos fazer negócio juntos?</h1>
              <div class="separator"></div>
            </div>
            <p><div class="text">Complete os dados abaixo e um especialista entrará em contato. <br>
            </div></p>
            <br>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <input 
                    type="text" 
                    name="nome" 
                    class="form-control" 
                    placeholder="Nome:" 
                    pagefai-form="true"
                    required>
                </div>
              </div>
              <div class="col-lg-6">
                
                <div class="form-group">
                  <input 
                    type="text" 
                    name="empresa" 
                    class="form-control" 
                    placeholder="Empresa:" 
                    pagefai-form="true"
                    required>
                </div>
                
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input 
                    type="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="E-mail:" 
                    pagefai-form="true"
                    required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input 
                  type="text" 
                  name="telefone" 
                  class="form-control" 
                  placeholder="Whatsapp:" 
                  pagefai-form="true"
                  required>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <textarea 
                  name="mensagem" 
                  required="" 
                  class="form-control" 
                  pagefai-form="true"
                  required 
                  placeholder="Insira sua Mensagem..."></textarea>
                </div>

                <input 
                  class="form-control" 
                  name="id" 
                  id="id"
                  type="hidden"
                  pagefai-form="true"
                  value="40e01410-c781-11ed-afa1-0242ac120002">
                                
              </div>
              <div class="col-lg-12">
                <div class="form-group mb-0">

                  <span 
                    class="btn-submit dark" 
                    id="pagefai-submit-form"
                  > Enviar </span>
                    
                </div>
              </div>
            </div>
          </form>

          <div id="pagefai-form-success" style="display: none; text-align: center; color: #000">
              <h3> A mensagem foi enviada com sucesso </h3>
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
        // Enviar os dados do formulário via POST para o arquivo PHP
        const response = await fetch('/sendmail.html', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(formData) // Converte os dados do formulário para um formato URL-encoded
        });

        if (response.status === 200) {
            // Exibe um alerta informando que a mensagem foi enviada com sucesso
            alert('Mensagem enviada com sucesso!');

            // Atualiza a página após o OK no alerta
            window.location.reload();
        } else {
            // Caso contrário, mostre uma mensagem de erro
            console.error('Erro ao enviar o e-mail');
        }
    } catch (error) {
        console.error(error);
    }
}

// Adiciona o evento ao botão de envio
const submitButton = document.getElementById('pagefai-submit-form');
submitButton.addEventListener('click', handleSubmit);


</script>
