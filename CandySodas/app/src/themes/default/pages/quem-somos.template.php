<?php 
include('../../../config.inc.php');
$baseUrl = $CONFIG['CONF']['siteUrl'];
$pageTitle = "Quem Somos";
// load seo content
$title = Cms::getSiteConfigurationData('defaultPageTitle')." | ".$pageTitle;
$autor = Cms::getSiteConfigurationData('author');
$description = Cms::getSiteConfigurationData('description');
$keywords = Cms::getSiteConfigurationData('keywords');
$keywords = Cms::getSiteConfigurationData('keywords');
$image = Cms::getSiteConfigurationData('favicon');
$published = date('Y-m-d');
$siteUrl = $CONFIG['CONF']['siteUrl'];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <?php 
         Seo::seoRenderAttributes([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'image' => $image,
            'published' => $published,
            'author' => $autor,
            'type' => 'Article',
            'breadcrumbs' => [
               ['name' => 'Home', 'url' => $siteUrl],
               ['name' => 'Contato', 'url' => $siteUrl.'/contato.html'],
               ['name' => 'Produtos', 'url' => $siteUrl.'/produtos.html']
            ],
            'index' => true
            ]);
    ?>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="images/favicon.png" rel="icon">
   <link href="<?= $baseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $baseUrl; ?>/assets/css/plugin.min.css" rel="stylesheet">   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/<?= $baseUrl; ?>/assets/css/all.min.css" rel="stylesheet">   
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
	<link href="<?= $baseUrl; ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?= $baseUrl; ?>/assets/css/responsive.css" rel="stylesheet">
	<link href="<?= $baseUrl; ?>/assets/css/darkmode.css" rel="stylesheet">
 </head>
 <body>      
		
    <?php include('../components/header/header.php'); ?>
		
  <section class="breadcrumb-area banner-1" data-background="<?= $baseUrl;?>/assets/images/banner/9.jpg">
    <div class="text-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 v-center">
            <div class="bread-inner">
              <div class="bread-title">
                <h2> <?= $pageTitle; ?> </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--End Breadcrumb Area-->
  <!--Start About-->
  <section class="about-agency pad-tb block-1">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 v-center">
          <div class="about-image">
            <img src="<?= $baseUrl; ?>/assets/images/about/company-about.png" alt="about us" class="img-fluid"/>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="common-heading text-l ">
            <h2>Fundada em 2003,</h2>
            <p>
            a Balboa iniciou sua trajetória com a
            importação e distribuição de produtos Italianos,
            principalmente do ramo de gastronomia e bebidas.
            Chegou a representar mais de 22 empresas desses
            segmentos, sempre focados nos públicos das classes A e B.
            </p>
            <br/>
            <br/>

            <h4>Cases de Sucesso</h4>
            <p> 
              Entre vários cases de sucesso, Balboa foi a grande responsável pelo
              lançamento e solidificação dos famosos chocolates Ferrero, Kit Kat e
              Arizona Tea no Brasil.
            </p>

            <br/>
            <br/>

            <h4> Atuação no mercado </h4>
            <p>
              Nossa atuação não se limita apenas da importação
              e distribuição. Realizamos em conjunto com nossos
              parceiros, todo estudo de marketing e aplicação
              logística diferenciada e individualizada, sempre
              buscando a melhor solução para cada produto.
              Com a expansão das importações na área de
              bebidas e doces, foi criada a Balboa Candy Sodas.
            </p>

            <p>
              No mercado Norte Americano, iniciamos nossas
              operações em meados de 2007, importando e
              distribuindo uma ampla variedade de produtos
              exclusivos, como Trident, Skittles, M&M'S, Pringles,
              Coca-Cola e Fanta, todos devidamente
              autorizados e homologados pela Anvisa e pelo
              Ministério da Agricultura.
            </p>

            <p> 
              Atendemos diversos segmentos comerciais, incluindo
              lojas de conveniência, empórios, padarias,
              supermercados, bombonieres e farmácias.
              Comprometidos com a qualidade e inovação,
              buscamos conectar marcas internacionais ao
              mercado brasileiro, proporcionando experiências
              únicas aos nossos consumidores.
            </p>

          </div>
          
        </div>
      </div>
    </div>
  </section>
  
  <?php include('../components/brands/brands.php'); ?>

  <section class="about-agencys pad-tb block-1">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 v-center">
            <div class="image-block upset bg-shape wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
              <img src="<?= $baseUrl; ?>/assets/images/armazenagem-balbao.png" alt="about us Niwax" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-7">
            <div class="common-heading text-l">
              <h2 class="mb0"> Armazenagem </h2>
              <p class="pt20">
                <i class="fas fa-quote-left"></i> 
                  Na armazenagem, contamos com
                  depósitos climatizados,
                  higienizados e dedetizados,
                  garantindo a qualidade dos
                  produtos.
                <i class="fas fa-quote-right"></i> 
              </p>

              <br/>
              <br/>

              <h2 class="mb0"> Transporte </h2>

              <p> 
                No transporte, todos são embalados
                em caixas apropriadas, além de suas
                caixas originais, mantendo a qualidade
                e originalidade dos produtos.
              </p>

                <a href="<?= $baseUrl; ?>/orcamento.html" class="btn-main bg-btn5 lnk mt40"> 
                  Solicitar Orçamento <i class="fas fa-chevron-right fa-icon"></i><span class="circle"></span>
                </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include('../components/listenyou/listenyou.php'); ?>
    <?php include('../components/footer/footer.php'); ?>

<script src="<?= $baseUrl; ?>/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/jquery.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/bootstrap.bundle.min.js"></script> 
<script src="<?= $baseUrl; ?>/assets/js/plugin.min.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/dark-mode.js"></script>
<script src="<?= $baseUrl; ?>/assets/js/main.js"></script>
</body>
</html>