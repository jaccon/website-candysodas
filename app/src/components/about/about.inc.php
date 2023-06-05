<?php 
global $CONFIG;
$metadataId = "ac392262-dd91-11ed-b5ea-0242ac120002";
$siteUrl = $CONFIG['CONF']['siteUrl'];
$aboutCompanyTitle = CMS::isComponent($metadataId,"title");
$aboutCompanyDescription = CMS::isComponent($metadataId,"description");

$metaId = "650660fe-01d0-11ee-be56-0242ac120002";
$data= CMS::isComponent($metaId,"images");

?>
<div class="section-full p-t90 border-top-gray bg-gray pb-40">
                <div class="container">
                    <div class="section-content">
                    	<div class="row">
                    		<div class="col-md-5 col-sm-12 text-uppercase text-black">
                                <h2 class="font-40">
                                  <?= $aboutCompanyTitle; ?>
                                </h2>
                                <p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general</p>
                                <p> <?= $aboutCompanyDescription; ?> </p>
                                <a href="<?= $siteUrl; ?>/sobre.html" class="btn-half site-button button-lg m-b15"><span> Leia Mais </span><em></em></a>
                            </div>
                            
                        	<div class="col-md-7 col-sm-12">
                            	<div class="m-carousel-1 m-l100">
                            		<div class="owl-carousel home-carousel-1 owl-btn-vertical-center">

                                        <?php 
                                          foreach ($data as $key => $value) {
                                              $count++;
                                              $featuredImage = CMS::getImage($value);
                                        ?>
                                        
                                          <div class="item">
                                              <div class="ow-img wt-img-effect zoom-slow">
                                                  <a href="javascript:void(0);"><img src="<?= $featuredImage; ?>" alt=""></a>
                                              </div>
                                          </div>

                                        <?php } ?>
                                   </div>
                               </div>
                            </div>
                        </div>
                        <div class="hilite-title p-lr20 m-tb20 text-right text-uppercase bdr-gray bdr-right">
                        	<strong> Design </strong>
                            <span class="text-black"> Sofisticação </span>
                        </div>
                    </div>
                </div>
            </div>  