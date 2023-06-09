<?php 
global $CONFIG;
$metaId = "d9faf138-070a-11ee-be56-0242ac120002";
$recomendations= CMS::isComponent($metaId,"itens");
?>
<div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today"> Recomendamos pra você </h5>
                        <p class="mt-1 text-content"> Recomendamos estes produtos para você </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">

                            <?php 
                                foreach ($recomendations as $value) {
                                    $id = Commerce::productSearch($value,"id");
                                    $title = Commerce::getProductDetail($id, 'title'); 
                                    $featuredImage = Commerce::normalizeFeatureImage(Commerce::getProductDetail($id, 'featuredImage')); 
                                    $weight = Commerce::getProductDetail($id, 'weight'); 
                                    $permLink = "/p/".$id.".html"; 
                            ?>
                                <li class="list-1">
                                    <div class="deal-offer-contain">
                                        <a href="<?= $permLink; ?>" class="deal-image">
                                            <img src="<?= $featuredImage; ?>" 
                                                class="blur-up lazyload"
                                                alt="">
                                        </a>

                                        <a href="<?= $permLink; ?>" class="deal-contain">
                                            <h5> <?= $title; ?> </h5>
                                            <h6> 
                                                R$ Consulte <span> <?= $weight; ?> </span>
                                            </h6>
                                        </a>
                                    </div>
                                </li>
                            <?php 
                                } 
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>