<?php
$metaId = "7884bde4-0282-11ee-be56-0242ac120002";
$data= CMS::isComponent($metaId,"images");
?>
<div class="section-full p-tb40 bg-white square_shape4 border-top-gray">
                <div class="container">
                    <div class="section-content">
                    
                        <div class="section-content">
                            <div class="row">
                            	<div class="col-md-4 col-sm-12">
                                    <div class="text-left">
                                        <h2 class="text-uppercase font-36 text-dark"> Nossos <br/> Clientes </h2>
                                        <div class="wt-separator-outer">
                                            <div class="wt-separator bg-dark"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-8 col-sm-12">
                                    <div class="section-content bg-dark p-tb10">
                                        <div class="owl-carousel home-client-carousel owl-btn-center-v">
                                            <?php 
                                                foreach ($data as $key => $value) {
                                                    $count++;
                                                    $featuredImage = CMS::getImage($value);
                                            ?>
                                              <div class="item">
                                                  <div class="ow-client-logo">
                                                      <div class="client-logo client-logo-media">
                                                      <a href="javascript:void(0);"><img src="<?= $featuredImage; ?>" alt=""></a></div>
                                                  </div>
                                              </div>
                                            <?php } ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>