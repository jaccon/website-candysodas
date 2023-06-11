<?php
$metaId = "7884bde4-0282-11ee-be56-0242ac120002";
$data= CMS::isComponent($metaId,"images");
?>
<section class="newsletter-section section-b-space">
        <div class="container-fluid-lg">
            <div class="newsletter-box newsletter-box-2">
                <div class="newsletter-contain py-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                <div class="newsletter-detail">
                                    <h2> Assine a nossa newsletter e ganhe...</h2>
                                    <h5> cupons de desconto e as novidades diretamente em seu e-mail </h5>
                                    <div class="input-box">
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            id="email"
                                            name="email"
                                            placeholder="Entre com seu e-mail aqui...">
                                        <button class="sub-btn  btn-animation" id="button-submit">
                                            <span class="d-sm-block d-none"> Assine </span>
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>

        document.getElementById("button-submit").onclick = function(e) {sendForm(e)};

        function sendForm(e) {
            
            e.preventDefault();

            alert('Adicionamos o seu email em nossa base de dados!');

            var email = $('#email').val();

            var data = [{
                email : email, 
            }]

            jQuery.ajax({
                type: "POST",
                url: "https://dash-api-v1.pagefai.com/newsletter/signup/NjJjYjFlZDYyMDk3MmYwMDIxNTdlM2Vi",
                data: JSON.stringify({ data }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data){
                    if(data = 1){
                        $("#contact-form-2").css("display", "none");
                        $("#contact-form-message").css("display", "block");
                        console.log(data)
                    }
                }
            });
            return false;
        }
</script>