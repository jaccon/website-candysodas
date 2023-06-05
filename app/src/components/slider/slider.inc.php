<?php
global $CONFIG;
$siteUrl = $CONFIG['CONF']['siteUrl'];

$metaId = "67f0861c-c848-11ed-afa1-0242ac120002";

// Sliders Content
$slider1Img=CMS::getImage(CMS::isComponent($metaId,"slider1Img"));
$slider1Txt=CMS::isComponent($metaId,"slider1Txt");
$slider1Desc=CMS::isComponent($metaId,"slider1Desc");

$slider2Img=CMS::getImage(CMS::isComponent($metaId,"slider2Img"));
$slider2Txt=CMS::isComponent($metaId,"slider2Txt");
$slider2Desc=CMS::isComponent($metaId,"slider2Desc");

$slider3Img=CMS::getImage(CMS::isComponent($metaId,"slider3Img"));
$slider3Txt=CMS::isComponent($metaId,"slider3Txt");
$slider3Desc=CMS::isComponent($metaId,"slider3Desc");

?>
<div id="welcome_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="goodnews-header" data-source="gallery" style="background:#eeeeee;padding:0px;">
                <div id="welcome" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.3.1">
                    <ul>
                      <li data-index="rs-902" 
                          data-transition="fadethroughdark" 
                          data-slotamount="default" 
                          data-hideafterloop="0" 
                          data-hideslideonmobile="off"  
                          data-easein="default" 
                          data-easeout="default" 
                          data-masterspeed="default"  
                          data-thumb="images/main-slider/slider1/slide1.jpg"  
                          data-rotate="0"  data-fstransition="fade" 
                          data-fsmasterspeed="300" data-fsslotamount="7" 
                          data-saveperformance="off"  data-title="" 
                          data-param1="" data-param2="" data-param3="" 
                          data-param4="" data-param5="" data-param6="" 
                          data-param7="" data-param8="" data-param9="" 
                          data-param10="" data-description="">
                            <img src="<?= $slider1Img; ?>"  alt=""  data-lazyload="<?= $slider1Img; ?>" data-bgposition="center center" 
                            data-bgfit="cover" data-bgparallax="4" class="rev-slidebg" data-no-retina>
                            <div class="tp-caption tp-shape tp-shapewrapper " 
                                    id="rrzb_902-1" 
                                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                    data-width="full"
                                    data-height="full"
                                    data-whitespace="nowrap"
                                    data-type="shape" 
                                    data-basealign="slide" 
                                    data-responsive_offset="off" 
                                    data-responsive="off"
                                    data-frames='[
                                    {"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},
                                    {"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}
                                    ]'
                                    data-textAlign="['left','left','left','left']"
                                    data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]"
                                    data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]"
                                    
                                    style="z-index: 4;background-color:rgba(0, 0, 0, 0.2);border-color:rgba(0, 0, 0, 0);border-width:0px;"> 
                                </div>                               
                            
                            <div id="rrzb_902" class="rev_row_zone rev_row_zone_middle" style="z-index: 7;">
                            	<!-- Content Block -->
                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption  " 
                                    id="slide-902-layer-1" 
                                    data-x="['left','left','left','left']" data-hoffset="['100','100','100','100']" 
                                    data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" 
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-type="row" 
                                    data-columnbreak="3" 
                                    data-responsive_offset="on" 
                                    data-responsive="off"
                                    data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                    {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-margintop="[0,0,0,0]"
                                    data-marginright="[0,0,0,0]"
                                    data-marginbottom="[50,60,40,50]"
                                    data-marginleft="[0,0,0,0]"
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[150,130,80,50]"
                                    data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[150,130,80,50]"
                                    style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;">
                                		
                                        <!-- LAYER NR. 2 -->
                                        <div class="tp-caption  " 
                                            id="slide-902-layer-2" 
                                            data-x="['left','left','left','left']" data-hoffset="['0','0','100','100']" 
                                            data-y="['top','top','top','top']" data-voffset="['0','0','100','100']" 
                                            data-width="none"
                                            data-height="none"
                                            data-whitespace="nowrap"
                                            data-type="column" 
                                            data-responsive_offset="on" 
                                            data-responsive="off"
                                            data-frames='[{"delay":"+0","speed":750,"sfxcolor":"#fff","sfx_effect":"","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                            {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power4.easeInOut"}]'
                                            data-columnwidth="100%"
                                            data-verticalalign="top"
                                            data-margintop="[0,0,0,0]"
                                            data-marginright="[0,0,0,0]"
                                            data-marginbottom="[0,0,0,0]"
                                            data-marginleft="[0,0,0,0]"
                                            data-textAlign="['center','center','center','center']"
                                            data-paddingtop="[50,50,50,50]"
                                            data-paddingright="[0,0,30,30]"
                                            data-paddingbottom="[50,50,50,50]"
                                            data-paddingleft="[0,0,30,30]"
                                            style="z-index: 8; width: 100%;">
                                            <!-- LAYER NR. 3 -->
                                            <div class="tp-caption   tp-resizeme" 
                                                id="slide-902-layer-3" 
                                                data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','bottom','bottom','bottom']" data-voffset="['0','260','250','190']" 
                                                data-width="none"
                                                data-height="none"
                                                data-whitespace="['normal','nowrap','nowrap','nowrap']"
                                                data-type="text" 
                                                data-basealign="slide" 
                                                data-responsive_offset="off" 
                                                data-frames='[{"delay":"+490","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['center','inherit','inherit','inherit']"
                                                data-paddingtop="[5,5,5,5]"
                                                data-paddingright="[5,5,5,5]"
                                                data-paddingbottom="[5,5,5,5]"
                                                data-paddingleft="[5,5,5,5]"
                                                style="z-index: 10; white-space: normal; font-size: 18px; line-height: 15px; font-weight: 700; color: #fff; letter-spacing: 3px; display: inline-block;">
                                                <?= $slider1Txt; ?>  
                                             </div>
                            
                                            <!-- LAYER NR. 4 -->
                                            <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" 
                                                id="slide-902-layer-4" 
                                                data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" 
                                                data-width="full"
                                                data-height="15"
                                                data-whitespace="normal"
                                                data-type="shape" 
                                                data-responsive_offset="on" 
                                                data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[0,0,0,0]"
                                                data-paddingbottom="[0,0,0,0]"
                                                data-paddingleft="[0,0,0,0]"
                                                style="z-index: 13; display: block;background-color:rgba(0, 0, 0, 0);"> 
                                           </div>
                            
                                            <!-- LAYER NR. 5 -->
                                            <div class="tp-caption   tp-resizeme  tp-linkmod" 
                                                id="slide-902-layer-5" 
                                                data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','bottom','bottom','bottom']" data-voffset="['0','170','140','120']" 
                                                data-fontsize="['60','60','60','40']"
                                                data-lineheight="['60','60','60','40']"
                                                data-width="['900','700','100%','100%']"
                                                data-height="none"
                                                data-whitespace="normal"
                                     
                                                data-type="text" 
                                                data-actions=''
                                                data-basealign="slide" 
                                                data-responsive_offset="off" 
                                    
                                                data-frames='[{"delay":"+590","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},
                                                {"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['center','center','center','center']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[5,5,5,5]"
                                                data-paddingbottom="[10,10,10,10]"
                                                data-paddingleft="[5,5,5,5]"
                                    
                                                style="z-index: 11; white-space: normal; font-weight: 600; color: #fff; letter-spacing: 2px; display: inline-block;cursor:pointer;
                                                text-decoration: none; text-transform:capitalize; font-size: 60px;"> 
                                                <?= $slider1Desc; ?> 
                                              </div>
                            
                                            <!-- LAYER NR. 6 -->
                                            <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" 
                                                id="slide-902-layer-6" 
                                    
                                                data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" 
                                                data-width="full"
                                                data-height="15"
                                                data-whitespace="normal"
                                     
                                                data-type="shape" 
                                                data-responsive_offset="on" 
                                    
                                                data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[0,0,0,0]"
                                                data-paddingbottom="[0,0,0,0]"
                                                data-paddingleft="[0,0,0,0]"
                                    
                                                style="z-index: 9; display: block;background-color:rgba(0, 0, 0, 0);"> </div>
                            
                                            <!-- LAYER NR. 7 -->
                                            <div class="tp-caption   tp-resizeme" 
                                                 id="slide-902-layer-7" 
                                                 data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                 data-y="['top','bottom','bottom','bottom']" data-voffset="['0','100','80','70']" 
                                                 data-width="['none','460','100%','100%']"
                                                data-height="none"
                                                data-whitespace="normal"
                                     
                                                data-type="text" 
                                                data-basealign="slide" 
                                                data-responsive_offset="off" 
                                    
                                                data-frames='[{"delay":"+690","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['center','center','center','center']"
                                                data-paddingtop="[5,5,5,5]"
                                                data-paddingright="[5,5,5,5]"
                                                data-paddingbottom="[5,5,5,5]"
                                                data-paddingleft="[5,5,5,5]"
                                    
                                                style="z-index: 12; white-space: normal; font-size: 16px; line-height: 22px;
                                                font-weight: 400; color: #fff; letter-spacing: 0px; display: inline-block;">
                                                <!-- Botão para Interna Aqui  -->
                                          </div>
                                       </div>
                                            
                                </div>
                                
                            </div>
                            <div class="tp-caption tp-shape tp-shapewrapper " 
                                id="slide-902-layer-8" 
                                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                data-width="full"
                                data-height="full"
                                data-whitespace="nowrap"
                                data-visibility="['on','on','off','off']"
                     
                                data-type="shape" 
                                data-basealign="slide" 
                                data-responsive_offset="off" 
                                data-responsive="off"
                                data-frames='[{"delay":50,"speed":100,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power3.easeIn"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"
                    
                                style="z-index: 5;background-color:rgba(0, 0, 0, 0);border-color:rgb(255,255,255);border-style:solid;border-width:0px 80px 80px 80px;"> </div>
     
                        </li>
                        
                      <li data-index="rs-903" 
                          data-transition="fadethroughdark" 
                          data-slotamount="default" 
                          data-hideafterloop="0" 
                          data-hideslideonmobile="off"  
                          data-easein="default" 
                          data-easeout="default" 
                          data-masterspeed="default"  
                          data-thumb="images/main-slider/slider1/slide2.jpg"  
                          data-rotate="0"  data-fstransition="fade" 
                          data-fsmasterspeed="300" data-fsslotamount="7" 
                          data-saveperformance="off"  data-title="" data-param1="" 
                          data-param2="" data-param3="" data-param4="" data-param5="" 
                          data-param6="" data-param7="" data-param8="" data-param9="" 
                          data-param10="" data-description="">
                            <img src="<?= $slider2Img; ?>"  alt=""  data-lazyload="<?= $slider2Img; ?>" data-bgposition="center center" 
                            data-bgfit="cover" data-bgparallax="4" class="rev-slidebg" data-no-retina>
                           
                          <div class="tp-caption tp-shape tp-shapewrapper " 
                                            id="rrzb_903-1" 
                                            data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                            data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                            data-width="full"
                                            data-height="full"
                                            data-whitespace="nowrap"
                                            data-type="shape" 
                                            data-basealign="slide" 
                                            data-responsive_offset="off" 
                                            data-responsive="off"
                                            data-frames='[
                                            {"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},
                                            {"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}
                                            ]'
                                            data-textAlign="['left','left','left','left']"
                                            data-paddingtop="[0,0,0,0]"
                                            data-paddingright="[0,0,0,0]"
                                            data-paddingbottom="[0,0,0,0]"
                                            data-paddingleft="[0,0,0,0]"
                                            
                                            style="z-index: 4;background-color:rgba(0, 0, 0, 0.2);border-color:rgba(0, 0, 0, 0);border-width:0px;"> 
                                        </div>                               
                                    
                                    <div id="rrzb_903" class="rev_row_zone rev_row_zone_middle" style="z-index: 7;">
                                          <!-- Content Block -->
                                            <!-- LAYER NR. 1 -->
                                            <div class="tp-caption  " 
                                                id="slide-903-layer-1" 
                                                data-x="['left','left','left','left']" data-hoffset="['100','100','100','100']" 
                                                data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" 
                                                data-width="none"
                                                data-height="none"
                                                data-whitespace="nowrap"
                                                data-type="row" 
                                                data-columnbreak="3" 
                                                data-responsive_offset="on" 
                                                data-responsive="off"
                                                data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[50,60,40,50]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[150,130,80,50]"
                                                data-paddingbottom="[0,0,0,0]"
                                                data-paddingleft="[150,130,80,50]"
                                                style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;">
                                                
                                                    <!-- LAYER NR. 2 -->
                                                    <div class="tp-caption  " 
                                                        id="slide-903-layer-2" 
                                                        data-x="['left','left','left','left']" data-hoffset="['0','0','100','100']" 
                                                        data-y="['top','top','top','top']" data-voffset="['0','0','100','100']" 
                                                        data-width="none"
                                                        data-height="none"
                                                        data-whitespace="nowrap"
                                                        data-type="column" 
                                                        data-responsive_offset="on" 
                                                        data-responsive="off"
                                                        data-frames='[{"delay":"+0","speed":750,"sfxcolor":"#fff","sfx_effect":"","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                        {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power4.easeInOut"}]'
                                                        data-columnwidth="100%"
                                                        data-verticalalign="top"
                                                        data-margintop="[0,0,0,0]"
                                                        data-marginright="[0,0,0,0]"
                                                        data-marginbottom="[0,0,0,0]"
                                                        data-marginleft="[0,0,0,0]"
                                                        data-textAlign="['center','center','center','center']"
                                                        data-paddingtop="[50,50,50,50]"
                                                        data-paddingright="[0,0,30,30]"
                                                        data-paddingbottom="[50,50,50,50]"
                                                        data-paddingleft="[0,0,30,30]"
                                                        style="z-index: 8; width: 100%;">
                                                        <!-- LAYER NR. 3 -->
                                                        <div class="tp-caption   tp-resizeme" 
                                                            id="slide-903-layer-3" 
                                                            data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                            data-y="['top','bottom','bottom','bottom']" data-voffset="['0','260','250','190']" 
                                                            data-width="none"
                                                            data-height="none"
                                                            data-whitespace="['normal','nowrap','nowrap','nowrap']"
                                                            data-type="text" 
                                                            data-basealign="slide" 
                                                            data-responsive_offset="off" 
                                                            data-frames='[{"delay":"+490","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                            {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                            data-margintop="[0,0,0,0]"
                                                            data-marginright="[0,0,0,0]"
                                                            data-marginbottom="[0,0,0,0]"
                                                            data-marginleft="[0,0,0,0]"
                                                            data-textAlign="['center','inherit','inherit','inherit']"
                                                            data-paddingtop="[5,5,5,5]"
                                                            data-paddingright="[5,5,5,5]"
                                                            data-paddingbottom="[5,5,5,5]"
                                                            data-paddingleft="[5,5,5,5]"
                                                            style="z-index: 10; white-space: normal; font-size: 18px; line-height: 18px; font-weight: 700; color: #fff; letter-spacing: 3px; display: inline-block;">
                                                            <?= $slider1Txt; ?> 
                                                        </div>
                                        
                                                        <!-- LAYER NR. 4 -->
                                                        <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" 
                                                            id="slide-903-layer-4" 
                                                            data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" 
                                                            data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" 
                                                            data-width="full"
                                                            data-height="15"
                                                            data-whitespace="normal"
                                                            data-type="shape" 
                                                            data-responsive_offset="on" 
                                                            data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                            {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                            data-margintop="[0,0,0,0]"
                                                            data-marginright="[0,0,0,0]"
                                                            data-marginbottom="[0,0,0,0]"
                                                            data-marginleft="[0,0,0,0]"
                                                            data-textAlign="['inherit','inherit','inherit','inherit']"
                                                            data-paddingtop="[0,0,0,0]"
                                                            data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]"
                                                            data-paddingleft="[0,0,0,0]"
                                                            style="z-index: 13; display: block;background-color:rgba(0, 0, 0, 0);"> 
                                                      </div>
                                        
                                                        <!-- LAYER NR. 5 -->
                                                        <div class="tp-caption   tp-resizeme  tp-linkmod" 
                                                            id="slide-903-layer-5" 
                                                            data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                            data-y="['top','bottom','bottom','bottom']" data-voffset="['0','170','140','120']" 
                                                            data-fontsize="['60','60','60','40']"
                                                            data-lineheight="['60','60','60','40']"
                                                            data-width="['900','700','100%','100%']"
                                                            data-height="none"
                                                            data-whitespace="normal"
                                                
                                                            data-type="text" 
                                                            data-actions=''
                                                            data-basealign="slide" 
                                                            data-responsive_offset="off" 
                                                
                                                            data-frames='[{"delay":"+590","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                            {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},
                                                            {"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);"}]'
                                                            data-margintop="[0,0,0,0]"
                                                            data-marginright="[0,0,0,0]"
                                                            data-marginbottom="[0,0,0,0]"
                                                            data-marginleft="[0,0,0,0]"
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[0,0,0,0]"
                                                            data-paddingright="[5,5,5,5]"
                                                            data-paddingbottom="[10,10,10,10]"
                                                            data-paddingleft="[5,5,5,5]"
                                                
                                                            style="z-index: 11; white-space: normal; font-weight: 600; color: #fff; letter-spacing: 2px; display: inline-block;cursor:pointer;
                                                            text-decoration: none; text-transform:capitalize">
                                                              <?= $slider2Desc; ?>
                                                          </div>
                                        
                                                        <!-- LAYER NR. 6 -->
                                                        <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" 
                                                            id="slide-903-layer-6" 
                                                
                                                            data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" 
                                                            data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" 
                                                            data-width="full"
                                                            data-height="15"
                                                            data-whitespace="normal"
                                                
                                                            data-type="shape" 
                                                            data-responsive_offset="on" 
                                                
                                                            data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                            {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                            data-margintop="[0,0,0,0]"
                                                            data-marginright="[0,0,0,0]"
                                                            data-marginbottom="[0,0,0,0]"
                                                            data-marginleft="[0,0,0,0]"
                                                            data-textAlign="['inherit','inherit','inherit','inherit']"
                                                            data-paddingtop="[0,0,0,0]"
                                                            data-paddingright="[0,0,0,0]"
                                                            data-paddingbottom="[0,0,0,0]"
                                                            data-paddingleft="[0,0,0,0]"
                                                
                                                            style="z-index: 9; display: block;background-color:rgba(0, 0, 0, 0);"> </div>
                                        
                                                        <!-- LAYER NR. 7 -->
                                                        <div class="tp-caption   tp-resizeme" 
                                                            id="slide-903-layer-7" 
                                                            data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                            data-y="['top','bottom','bottom','bottom']" data-voffset="['0','100','80','70']" 
                                                            data-width="['none','460','100%','100%']"
                                                            data-height="none"
                                                            data-whitespace="normal"
                                                
                                                            data-type="text" 
                                                            data-basealign="slide" 
                                                            data-responsive_offset="off" 
                                                
                                                            data-frames='[{"delay":"+690","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                            {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                            data-margintop="[0,0,0,0]"
                                                            data-marginright="[0,0,0,0]"
                                                            data-marginbottom="[0,0,0,0]"
                                                            data-marginleft="[0,0,0,0]"
                                                            data-textAlign="['center','center','center','center']"
                                                            data-paddingtop="[5,5,5,5]"

                                                            data-paddingright="[5,5,5,5]"
                                                            data-paddingbottom="[5,5,5,5]"
                                                            data-paddingleft="[5,5,5,5]"
                                                
                                                            style="z-index: 12; white-space: normal; font-size: 16px; line-height: 22px;
                                                            font-weight: 400; color: #fff; letter-spacing: 0px; display: inline-block;">
                                                            <!-- Botão aqui -->
                                                      </div>
                                                  </div>
                                                        
                                            </div>
                                            
                                        </div>
                                        <!-- LAYER NR. 8 -->
                                        <!-- Border Part -->
                                        <div class="tp-caption tp-shape tp-shapewrapper " 
                                            id="slide-903-layer-8" 
                                            data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                            data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                            data-width="full"
                                            data-height="full"
                                            data-whitespace="nowrap"
                                            data-visibility="['on','on','off','off']"
                                
                                            data-type="shape" 
                                            data-basealign="slide" 
                                            data-responsive_offset="off" 
                                            data-responsive="off"
                                            data-frames='[{"delay":50,"speed":100,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power3.easeIn"}]'
                                            data-textAlign="['inherit','inherit','inherit','inherit']"
                                            data-paddingtop="[0,0,0,0]"
                                            data-paddingright="[0,0,0,0]"
                                            data-paddingbottom="[0,0,0,0]"
                                            data-paddingleft="[0,0,0,0]"
                                
                                            style="z-index: 5;background-color:rgba(0, 0, 0, 0);border-color:rgb(255,255,255);border-style:solid;border-width:0px 80px 80px 80px;"> </div>
                
                                    </li>
                                    
                                    <!-- SLIDE 3 -->
                        
                      <li data-index="rs-904" 
                          data-transition="fadethroughdark" 
                          data-slotamount="default" 
                          data-hideafterloop="0" 
                          data-hideslideonmobile="off"  
                          data-easein="default" 
                          data-easeout="default" 
                          data-masterspeed="default"  
                          data-thumb="images/main-slider/slider1/slide3.jpg"  
                          data-rotate="0"  data-fstransition="fade" 
                          data-fsmasterspeed="300" 
                          data-fsslotamount="7" 
                          data-saveperformance="off"  
                          data-title="" data-param1="" 
                          data-param2="" data-param3="" 
                          data-param4="" data-param5="" 
                          data-param6="" data-param7="" 
                          data-param8="" data-param9="" 
                          data-param10="" 
                          data-description="">
                                        <!-- MAIN IMAGE -->
                                        <img src="<?= $slider3Img; ?>"  alt=""  data-lazyload="<?= $slider3Img; ?>" data-bgposition="center center" 
                                        data-bgfit="cover" data-bgparallax="4" class="rev-slidebg" data-no-retina>
                                        <!-- LAYERS -->
                                
                                        <!-- BACKGROUND VIDEO LAYER -->
                                        <div class="tp-caption tp-shape tp-shapewrapper " 
                                              id="rrzb_904-1" 
                                              data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                              data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                              data-width="full"
                                              data-height="full"
                                              data-whitespace="nowrap"
                                              data-type="shape" 
                                              data-basealign="slide" 
                                              data-responsive_offset="off" 
                                              data-responsive="off"
                                              data-frames='[
                                              {"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},
                                              {"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}
                                              ]'
                                              data-textAlign="['left','left','left','left']"
                                              data-paddingtop="[0,0,0,0]"
                                              data-paddingright="[0,0,0,0]"
                                              data-paddingbottom="[0,0,0,0]"
                                              data-paddingleft="[0,0,0,0]"
                                              
                                              style="z-index: 4;background-color:rgba(0, 0, 0, 0.2);border-color:rgba(0, 0, 0, 0);border-width:0px;"> 
                                          </div>                               
                                      
                                        <div id="rrzb_904" class="rev_row_zone rev_row_zone_middle" style="z-index: 7;">
                            	<!-- Content Block -->
                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption  " 
                                    id="slide-904-layer-1" 
                                    data-x="['left','left','left','left']" data-hoffset="['100','100','100','100']" 
                                    data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']" 
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-type="row" 
                                    data-columnbreak="3" 
                                    data-responsive_offset="on" 
                                    data-responsive="off"
                                    data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                    {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-margintop="[0,0,0,0]"
                                    data-marginright="[0,0,0,0]"
                                    data-marginbottom="[50,60,40,50]"
                                    data-marginleft="[0,0,0,0]"
                                    data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[150,130,80,50]"
                                    data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[150,130,80,50]"
                                    style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;">
                                		
                                        <!-- LAYER NR. 2 -->
                                        <div class="tp-caption  " 
                                            id="slide-904-layer-2" 
                                            data-x="['left','left','left','left']" data-hoffset="['0','0','100','100']" 
                                            data-y="['top','top','top','top']" data-voffset="['0','0','100','100']" 
                                            data-width="none"
                                            data-height="none"
                                            data-whitespace="nowrap"
                                            data-type="column" 
                                            data-responsive_offset="on" 
                                            data-responsive="off"
                                            data-frames='[{"delay":"+0","speed":750,"sfxcolor":"#fff","sfx_effect":"","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                            {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power4.easeInOut"}]'
                                            data-columnwidth="100%"
                                            data-verticalalign="top"
                                            data-margintop="[0,0,0,0]"
                                            data-marginright="[0,0,0,0]"
                                            data-marginbottom="[0,0,0,0]"
                                            data-marginleft="[0,0,0,0]"
                                            data-textAlign="['center','center','center','center']"
                                            data-paddingtop="[50,50,50,50]"
                                            data-paddingright="[0,0,30,30]"
                                            data-paddingbottom="[50,50,50,50]"
                                            data-paddingleft="[0,0,30,30]"
                                            style="z-index: 8; width: 100%;">
                                            <!-- LAYER NR. 3 -->
                                            <div class="tp-caption   tp-resizeme" 
                                                id="slide-904-layer-3" 
                                                data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','bottom','bottom','bottom']" data-voffset="['0','260','250','190']" 
                                                data-width="none"
                                                data-height="none"
                                                data-whitespace="['normal','nowrap','nowrap','nowrap']"
                                                data-type="text" 
                                                data-basealign="slide" 
                                                data-responsive_offset="off" 
                                                data-frames='[{"delay":"+490","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['center','inherit','inherit','inherit']"
                                                data-paddingtop="[5,5,5,5]"
                                                data-paddingright="[5,5,5,5]"
                                                data-paddingbottom="[5,5,5,5]"
                                                data-paddingleft="[5,5,5,5]"
                                                style="z-index: 10; white-space: normal; font-size: 18px; line-height: 18px; font-weight: 700; color: #fff; letter-spacing: 3px; display: inline-block;">
                                                <?= $slider2Txt; ?> 
                                             </div>
                            
                                            <!-- LAYER NR. 4 -->
                                            <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" 
                                                id="slide-904-layer-4" 
                                                data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" 
                                                data-width="full"
                                                data-height="15"
                                                data-whitespace="normal"
                                                data-type="shape" 
                                                data-responsive_offset="on" 
                                                data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[0,0,0,0]"
                                                data-paddingbottom="[0,0,0,0]"
                                                data-paddingleft="[0,0,0,0]"
                                                style="z-index: 13; display: block;background-color:rgba(0, 0, 0, 0);"> 
                                           </div>
                            
                                            <!-- LAYER NR. 5 -->
                                            <div class="tp-caption   tp-resizeme  tp-linkmod" 
                                                id="slide-904-layer-5" 
                                                data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','bottom','bottom','bottom']" data-voffset="['0','170','140','120']" 
                                                data-fontsize="['60','60','60','40']"
                                                data-lineheight="['60','60','60','40']"
                                                data-width="['900','700','100%','100%']"
                                                data-height="none"
                                                data-whitespace="normal"
                                     
                                                data-type="text" 
                                                data-actions=''
                                                data-basealign="slide" 
                                                data-responsive_offset="off" 
                                    
                                                data-frames='[{"delay":"+590","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},
                                                {"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['center','center','center','center']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[5,5,5,5]"
                                                data-paddingbottom="[10,10,10,10]"
                                                data-paddingleft="[5,5,5,5]"
                                    
                                                style="z-index: 11; white-space: normal; font-weight: 600; color: #fff; letter-spacing: 2px; display: inline-block;cursor:pointer;
                                                text-decoration: none; text-transform:capitalize">
                                                <?= $slider3Desc; ?>
                                              </div>
                            
                                            <!-- LAYER NR. 6 -->
                                            <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" 
                                                id="slide-904-layer-6" 
                                    
                                                data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']" 
                                                data-y="['top','top','top','top']" data-voffset="['0','0','0','0']" 
                                                data-width="full"
                                                data-height="15"
                                                data-whitespace="normal"
                                     
                                                data-type="shape" 
                                                data-responsive_offset="on" 
                                    
                                                data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                                data-paddingtop="[0,0,0,0]"
                                                data-paddingright="[0,0,0,0]"
                                                data-paddingbottom="[0,0,0,0]"
                                                data-paddingleft="[0,0,0,0]"
                                    
                                                style="z-index: 9; display: block;background-color:rgba(0, 0, 0, 0);"> </div>
                            
                                            <!-- LAYER NR. 7 -->
                                            <div class="tp-caption   tp-resizeme" 
                                                 id="slide-904-layer-7" 
                                                 data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" 
                                                 data-y="['top','bottom','bottom','bottom']" data-voffset="['0','100','80','70']" 
                                                 data-width="['none','460','100%','100%']"
                                                data-height="none"
                                                data-whitespace="normal"
                                     
                                                data-type="text" 
                                                data-basealign="slide" 
                                                data-responsive_offset="off" 
                                    
                                                data-frames='[{"delay":"+690","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                                data-margintop="[0,0,0,0]"
                                                data-marginright="[0,0,0,0]"
                                                data-marginbottom="[0,0,0,0]"
                                                data-marginleft="[0,0,0,0]"
                                                data-textAlign="['center','center','center','center']"
                                                data-paddingtop="[5,5,5,5]"
                                                data-paddingright="[5,5,5,5]"
                                                data-paddingbottom="[5,5,5,5]"
                                                data-paddingleft="[5,5,5,5]"
                                    
                                                style="z-index: 12; white-space: normal; font-size: 16px; line-height: 22px;
                                                font-weight: 400; color: #fff; letter-spacing: 0px; display: inline-block;">
                                                <!-- Botão aqui -->
                                          </div>
                                       </div>
                                            
                                </div>
                                
                            </div>
                            <!-- LAYER NR. 8 -->
                            <!-- Border Part -->
                            <div class="tp-caption tp-shape tp-shapewrapper " 
                                 id="slide-904-layer-8" 
                                 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                                 data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                                            data-width="full"
                                data-height="full"
                                data-whitespace="nowrap"
                                data-visibility="['on','on','off','off']"
                     
                                data-type="shape" 
                                data-basealign="slide" 
                                data-responsive_offset="off" 
                                data-responsive="off"
                                data-frames='[{"delay":50,"speed":100,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power3.easeIn"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"
                    
                                style="z-index: 5;background-color:rgba(0, 0, 0, 0);border-color:rgb(255,255,255);border-style:solid;border-width:0px 80px 80px 80px;"> </div>
     
                        </li>
                        
                    </ul>
                </div>
            </div>