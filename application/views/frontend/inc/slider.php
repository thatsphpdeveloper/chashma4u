 

<?php  if (isset($frontPageSliderData) && !empty($frontPageSliderData)) { ?>
            
 <div class="holder fullwidth full-nopad mt-0">
            <div class="container">
                <div class="bnslider-wrapper">
                    <div class="bnslider bnslider--lg bnslider--darkarrows keep-scale" id="bnslider-001" data-slick='{"arrows": true, "dots": true}' data-autoplay="true" data-speed="5000" data-start-width="1920" data-start-height="515" data-start-mwidth="480" data-start-mheight="578">
                    <?php foreach ($frontPageSliderData as $slider) { 
                        if ($slider->position ==1) {

                        ?>
                        <!-- <?=($slider->btnUrl)?'onclick="window.location.href=\''.$slider->btnUrl.'\'"':''?> -->
                        <div class="bnslider-slide bnslide-fashion-3">
                            <div class="bnslider-image-mobile" style="background-image: url('<?=UPLOADPATH.'/slider_images/'.$slider->img ?>');"></div>
                            <div class="bnslider-image" style="background-image: url('<?=UPLOADPATH.'/slider_images/'.$slider->img ?>');"></div>

                            <div class="bnslider-text-wrap bnslider-overlay">
                                <div class="bnslider-text-content txt-middle txt-center">
                                    <div class="bnslider-text-content-flex container">
                                        <div class="bnslider-vert border-half" data-animation="zoomIn" data-animation-delay="0s">

                                            <?=($slider->title)?'<div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay=".5s">'.$slider->title.'</div>':''?>
                                            <?=($slider->text1)?'<div class="bnslider-text bnslider-text--sm text-center text-white" data-animation="fadeInUp" data-animation-delay="1s" style="color: #000;">'.$slider->text1.'</div>':''?>
                                            <?=($slider->text2)?'<div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1.5s">'.$slider->text2.'</div>':''?>
                                            <?=($slider->btnText)?'<div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="'.$slider->btnUrl.'" class="btn-decor">'.$slider->btnText.'<span class="btn-line" style="background-color: #fff;"></span></a></div>':''?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }elseif ($slider->position ==2) {

                        ?>
                        <div class="bnslider-slide bnslide-fashion-4" <?=($slider->btnUrl)?'onclick="window.location.href=\''.$slider->btnUrl.'\'"':''?>>
                            <div class="bnslider-image-mobile" style="background-image: url('<?=UPLOADPATH.'/slider_images/'.$slider->img ?>');"></div>
                            <div class="bnslider-image" style="background-image: url('<?=UPLOADPATH.'/slider_images/'.$slider->img ?>');"></div>

                            <div class="bnslider-text-wrap bnslider-overlay">
                                <div class="bnslider-text-content txt-middle txt-right">
                                    <div class="bnslider-text-content-flex">
                                        <div class="bnslider-vert w-50 mx-0">
                                            <?=($slider->title)?'<div class="bnslider-text bnslider-text--lg text-center" data-animation="popIn" data-animation-delay=".8s" style="color: #ffc501;">'.$slider->title.'</div>':''?>
                                            <?=($slider->text1)?'<div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #000; font-weight: 300;">'.$slider->text1.'</div>':''?>
                                            <?=($slider->text2)?'<div class="bnslider-text bnslider-text--xs text-center" data-animation="zoomIn" data-animation-delay="1.6s" style="color: #ffc501;">'.$slider->text2.'</div>':''?>
                                            <?=($slider->btnText)?'<div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="'.$slider->btnUrl.'" class="btn-decor" style="color: #000;">'.$slider->btnText.'<span class="btn-line" style="background-color: #ffc501;"></span></a></div>':''?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{

                        ?>
                        <div class="bnslider-slide bnslide-fashion-2" <?=($slider->btnUrl)?'onclick="window.location.href=\''.$slider->btnUrl.'\'"':''?>>
                            <div class="bnslider-image-mobile" style="background-image: url('<?=UPLOADPATH.'/slider_images/'.$slider->img ?>');"></div>
                            <div class="bnslider-image" style="background-image: url('<?=UPLOADPATH.'/slider_images/'.$slider->img ?>');"></div>

                            <div class="bnslider-text-wrap bnslider-overlay">
                                <div class="bnslider-text-content txt-middle txt-left">
                                    <div class="bnslider-text-content-flex container">
                                        <div class="bnslider-vert w-50 mx-0" data-animation="fadeIn" data-animation-delay="0.5s">

                                            <?=($slider->title)?'<div class="bnslider-text bnslider-text--md text-center" data-animation="pulsate" data-animation-delay="0.8s" style="font-weight: 700">'.$slider->title.'</div>':''?>
                                            <?=($slider->text1)?'<div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1s" style="font-weight: 300">'.$slider->text1.'</div>':''?>
                                            <?=($slider->text2)?'<div class="bnslider-text bnslider-text--sm text-center" data-animation="fadeInUp" data-animation-delay="1.6s" style="color: #f9f600;">'.$slider->text2.'</div>':''?>
                                            <?=($slider->btnText)?'<div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="'.$slider->btnUrl.'" class="btn-decor">'.$slider->btnText.'<span class="btn-line" style="background-color: #f9f600;"></span></a></div>':''?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                     ?>
                    </div>
                    <!-- <div class="bnslider-loader hide">
                        <div class="loader-wrap">
                            <div class="dots">
                                <div class="dot one"></div>
                                <div class="dot two"></div>
                                <div class="dot three"></div>
                            </div>
                        </div>
                    </div> -->
                    <div class="bnslider-arrows container-fluid">
                        <div></div>
                    </div>
                    <div class="bnslider-dots vert-dots container-fluid"></div>
                </div>
            </div>
        </div>

        <?php } ?>



