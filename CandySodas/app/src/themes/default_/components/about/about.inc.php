<?php 
global $CONFIG;
$metadataId = "ac392262-dd91-11ed-b5ea-0242ac120002";
$siteUrl = $CONFIG['CONF']['siteUrl'];
$aboutCompanyTitle = CMS::isComponent($metadataId,"title");
$aboutCompanyDescription = CMS::isComponent($metadataId,"description");

$metaId = "650660fe-01d0-11ee-be56-0242ac120002";
$data= CMS::isComponent($metaId,"images");

?>

<!--SOBRE NÓS -->
<section class="about-section">
<div class="container">
	<!-- Business Section -->
	<div class="inner-container">
		<div class="row clearfix">
			<!-- Image Column -->
			<div class="image-column col-lg-6 col-md-5 col-sm-12">
				<div class="inner-column">
					<div class="image">
						<img src="assets/images/resource/about.jpg" alt="img" >
						<div class="experience-counter">
							<div class="experience-counter-inner">
								<p>Anos de Experiência</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Content Column -->
			<div class="content-column col-lg-6 col-md-7 col-sm-12 px-lg-0" id="sobrenos">
				<div class="inner-column">
					<!-- Title Box -->
					<div class="title-box">
						<!--<div class="title">Sobre nós</div>-->
					<h1>O Legado </h1>
						<p> 
						Hoje, a SAFY SISTEMAS Soluções Integradas é referência no mercado de segurança e tecnologia. A Safy  não é apenas uma empresa, mas um legado de inovação, confiança e qualidade. 
						Ela provou que, com visão, dedicação e uma parceria sólida, é possível transformar ideias em realidade.
						A história da Safy é a prova de que, quando segurança e tecnologia caminham juntas, o futuro é mais seguro, inteligente e sustentável.
						</p>

					</div>
					<!-- End Title Box -->
					
					<!-- Feature Block -->
					<div class="work-list d-md-flex align-items-center justify-content-between">
						<ul>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img"> Análise das Necessidades do Cliente </li>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img">  Projetos Personalizados </li>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img"> Instalação do Sistema </li>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img"> Treinamento do Cliente </li>
						</ul>
						<ul>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img"> Manutenção e Suporte </li>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img"> Soluções Personalizadas </li>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img"> Qualidade e Durabilidade </li>
							<li><img src="/assets/images/icons/chevron-right.png" alt="img"> Conformidade com Normas </li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</section>		
<!--FIM SOBRE NÓS-->