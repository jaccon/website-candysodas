<?php 
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];

$metaId = "ac392262-dd91-11ed-b5ea-0242ac120002";

$text2 = CMS::isComponent($metaId,"text2");
$description = CMS::isComponent($metaId,"description");
$text1 = CMS::isComponent($metaId,"text1");
$videoSrc = CMS::isComponent($metaId,"videoSrc");

$sliderImages = CMS::isComponent('650660fe-01d0-11ee-be56-0242ac120002','images');
$whatsappNumber = "5511941004004";

?>

<section class="main-slider p-0">
	<div class="main-slider-carousel owl-carousel owl-theme">
		
					<div class="slide" style="background-image: url('/assets/images/slider/slide01.jpg');">
						<div class="container">
							<div class="row clearfix">
								<!-- Content Column -->
								<div class="content-column col-xl-7 col-lg-7 col-md-10 col-sm-12">
									<div class="inner-column">
										<div class="title" style="color: #fff;"> Conheça a Safy Segurança e Sistemas </div>
										<h1 style="color: #fff;">Converta suas ideias em<br><span><font color="#FFFFFF">Grandes Oportunidades!</span></h1></font>
										<div class="text"><font color="#FFFFFF">Aproveite o nosso time de engenharia e arquitetura para um projeto 360º.</font></div>
										
											<div class="button-box d-flex flex-wrap">
												<a href="https://api.whatsapp.com/send?phone=<?= $whatsappNumber; ?>&text=Ol%C3%A1,%20Dealer%20Shop.%20%0AVim%20pelo%20site%20e%20preciso%20de%20atendimento!" class="btn" target="_blank">
													<span class="btn-wrap">
														<span class="text-one"> Fale Agora </span>
														<span class="text-two"> Fale Agora  </span>
													</span>
												</a>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="slide" style="background-image: url('../assets/images/slider/2.jpg');">
						<div class="container">
							<div class="row clearfix">
								<!-- Content Column -->
								<div class="content-column col-xl-7 col-lg-7 col-md-10 col-sm-12">
									<div class="inner-column">
										<div class="title"></div>
									  <h1>#SAFYSISTEMAS <br><font color="#fab700"> CFTV </font></h1>
										<div class="text">  instalação, configuração e manutenção adequada dos <br/> sistemas de vigilância</div>
										<div class="options-box">
											<!-- Button Box -->
											<div class="button-box d-flex flex-wrap">
												<a href="index.html#contato" class="btn">
													<span class="btn-wrap">
														<span class="text-one"> Solicite Orçamento  </span>
														<span class="text-two"> Solicite Orçamento </span>
													</span>
												</a>
												<!--<a href="index.html#" class="btn btn-two">
													<span class="btn-wrap">
														<span class="text-one">Get Service</span>
														<span class="text-two">Get Service</span>
													</span>
												</a>-->
											</div>
											
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="slide" style="background-image: url('../assets/images/slider/controle-de-acesso.jpg');">
						<div class="container">
							<div class="row clearfix">
								<!-- Content Column -->
								<div class="content-column col-xl-7 col-lg-7 col-md-10 col-sm-12">
									<div class="inner-column">
										<div class="title"></div>
										<h4> Mais segurança para seu <br/> estabelecimento e residência </h4>
										<h1> <font color="#fab700"> Controle de Acesso </font></h1> <br/><br/> 
										<div class="options-box">
											<!-- Button Box -->
											<div class="button-box d-flex flex-wrap">
												<a href="index.html#contato" class="btn">
													<span class="btn-wrap">
														<span class="text-one"> Solicite Orçamento  </span>
														<span class="text-two"> Solicite Orçamento </span>
													</span>
												</a>
												<!--<a href="index.html#" class="btn btn-two">
													<span class="btn-wrap">
														<span class="text-one">Get Service</span>
														<span class="text-two">Get Service</span>
													</span>
												</a>-->
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="slide" style="background-image: url('../assets/images/slider/instalacao-alarmes.jpg');">
						<div class="container">
							<div class="row clearfix">
								<!-- Content Column -->
								<div class="content-column col-xl-7 col-lg-7 col-md-10 col-sm-12">
									<div class="inner-column">
										<div class="title"></div>
										<h4> Proteja Seu Espaço com Segurança </h4>
										<h1> <font color="#fab700"> Instalação de Alarmes </font></h1> <br/><br/> 
										<div class="options-box">
											<!-- Button Box -->
											<div class="button-box d-flex flex-wrap">
												<a href="index.html#contato" class="btn">
													<span class="btn-wrap">
														<span class="text-one"> Solicite Orçamento  </span>
														<span class="text-two"> Solicite Orçamento </span>
													</span>
												</a>
												<!--<a href="index.html#" class="btn btn-two">
													<span class="btn-wrap">
														<span class="text-one">Get Service</span>
														<span class="text-two">Get Service</span>
													</span>
												</a>-->
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
</section>