<?php $this->load->viewF('inc/header.php'); ?>
<div class="page-content">
        <!-- BN Slider 1 -->
        <?php $this->load->viewF('inc/slider.php'); ?>
        <!-- //BN Slider 1 -->
<!--         <?php  //if (isset($frontPageCategoryData) && !empty($frontPageCategoryData)) { ?>
        <div class="holder fullboxed bgcolor mt-0 py-2 py-sm-3">
            <div class="container">
                    <?php 

                    //  echo '<div class="row bnr-grid">';
                    // foreach ($frontPageCategoryData as $categoryKey=>$category) {
                    //     if($category->img){

                    //         echo '<div class="col-md"><a href="'.BASEURL.'/'.$category->slug.'" class="bnr-wrap img-thumbnail shadow"> <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="'.FRONTSTATIC.'/images/placeholder.png" data-src="'.getResizedImg($category->img,'350_220').'" alt="'.$category->subcategoryName.'" class="lazyload"></div> </a></div>';
                    //         if((($categoryKey+1)%3) == 0)
                    //             echo '</div><div class="row bnr-grid">';
                    //     }
                    // }
                    // echo '</div>';
                    ?>

            </div>
        </div>
    <?php //} ?> -->
    <div class="holder fullboxed bgcolor mt-0 py-2 py-sm-3">
    <div class="container">
        <div class="row bnr-grid">

            <div class="col-md"><a href="<?=BASEURL.'/men-eyeglasses'?>" class="bnr-wrap img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic5.jpg" alt="Banner" class="lazyload"></div>
            </a></div>
            <div class="col-md"><a href="<?=BASEURL.'/women-eyeglasses'?>" class="bnr-wrap img-thumbnail shadow img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic6.jpg" alt="Banner" class="lazyload"></div>
            </a></div>
            <div class="col-md"><a href="<?=BASEURL.'/kids-eyeglasses'?>" class="bnr-wrap  img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic7.jpg" alt="Banner" class="lazyload"></div>
            </a></div>

        </div>



        <div class="row bnr-grid">

            <div class="col-md"><a href="<?=BASEURL.'/men-sunglasses'?>" class="bnr-wrap img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic9.jpg" alt="Banner" class="lazyload"></div>
            </a></div>
            <div class="col-md"><a href="<?=BASEURL.'/women-sunglasses'?>" class="bnr-wrap img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic10.jpg" alt="Banner" class="lazyload"></div>
            </a></div>

            <div class="col-md"><a href="<?=BASEURL.'/kids-sunglasses'?>" class="bnr-wrap  img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic11.jpg" alt="Banner" class="lazyload"></div>
            </a></div>

        </div>


        <div class="row bnr-grid">




        </div>



        <div class="row bnr-grid">
            <div class="col-md"><a href="#" class="bnr-wrap  img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic12.jpg" alt="Banner" class="lazyload"></div>
            </a></div>
            <div class="col-md"><a href="<?=BASEURL.'/sports-sunglasses'?>" class="bnr-wrap img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic13.jpg" alt="Banner" class="lazyload"></div>
            </a></div>
            <div class="col-md"><a href="<?=BASEURL.'/sports-sunglasses'?>" class="bnr-wrap img-thumbnail shadow">
                <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="<?=FRONTSTATIC?>/images/placeholder.png" data-src="<?=FRONTSTATIC?>/images/slider/pic14.jpg" alt="Banner" class="lazyload"></div>
            </a></div>


        </div>







    </div>
</div>
    <?php 
    if (isset($frontData) && !empty($frontData)){
        $frontDataArr = (array) $frontData;
        $frontData = $frontDataArr;
    }
    $products = '';
    for ($i=1; $i < 10; $i++) {
        $frontDataArr['product_slider_'.$i.'_product_arr'] = array();
        $frontDataArr['product_slider_'.$i.'_product_html'] = '';
        if(isset($frontDataArr['product_slider_'.$i.'_product']) && !empty($frontDataArr['product_slider_'.$i.'_product'])){
            $products .=($products)?','.$frontDataArr['product_slider_'.$i.'_product']:$frontDataArr['product_slider_'.$i.'_product'];
            $frontDataArr['product_slider_'.$i.'_product_arr'] = explode(',', $frontDataArr['product_slider_'.$i.'_product']);
        }
    }


    $productData = ($products)?$this->Common_model->exequery("SELECT pd.productId, (CASE WHEN productType = 1 THEN (SELECT actualPrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.actualPrice END ) as actualPrice, (CASE WHEN productType = 1 THEN (SELECT salePrice FROM ch_product_variable WHERE status = 0 AND productId = pd.productId order by actualPrice asc limit 0, 1) ELSE pd.salePrice END ) as salePrice, pd.isSameDayDelivery, pd.productName, pd.slug, (SELECT avg(ch_review.rating) FROM `ch_review` WHERE ch_review.productId = pd.productId) as rating, (SELECT count(*) FROM `ch_review` WHERE ch_review.productId = pd.productId) as totalReview, (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pd.featuredImageId ) as img FROM ch_product as pd inner join ".tablePrefix."product_variable as pv on (pv.status =0 AND pv.variableId =(SELECT variableId FROM ch_product_variable WHERE status = 0 AND qty > 0 AND productId = pd.productId order by actualPrice asc limit 0, 1)) where pd.status = 0 and FIND_IN_SET(pd.productId,'".$products."') HAVING img !=''"):array();

    if(!empty($productData)){
        foreach ($productData as $key => $product) {
            $productHtml = '<div class="collection-carousel-item"><a href="'.$product->slug.'"><img src="'.FRONTSTATIC.'/images/placeholder.png" data-src="'.getResizedImg($product->img,'290_295').'" class="lazyload" alt=""></a></div>';
            if(in_array($product->productId, $frontDataArr['product_slider_2_product_arr']))
                $frontDataArr['product_slider_2_product_html'] .= $productHtml;
                // 
            if(in_array($product->productId, $frontDataArr['product_slider_1_product_arr']))
                $frontDataArr['product_slider_1_product_html'] .= $productHtml;
           
            if(in_array($product->productId, $frontDataArr['product_slider_3_product_arr']))
                $frontDataArr['product_slider_3_product_html'] .= $productHtml;
            if(in_array($product->productId, $frontDataArr['product_slider_4_product_arr']))
                $frontDataArr['product_slider_4_product_html'] .= $productHtml;
            if(in_array($product->productId, $frontDataArr['product_slider_5_product_arr']))
                $frontDataArr['product_slider_5_product_html'] .= $productHtml;
            if(in_array($product->productId, $frontDataArr['product_slider_6_product_arr']))
                $frontDataArr['product_slider_6_product_html'] .= $productHtml;
            if(in_array($product->productId, $frontDataArr['product_slider_7_product_arr']))
                $frontDataArr['product_slider_7_product_html'] .= $productHtml;
            if(in_array($product->productId, $frontDataArr['product_slider_8_product_arr']))
                $frontDataArr['product_slider_8_product_html'] .= $productHtml;
            if(in_array($product->productId, $frontDataArr['product_slider_9_product_arr']))
                $frontDataArr['product_slider_9_product_html'] .= $productHtml;

        }
    }

    for ($i=1; $i < 10; $i++) {
        if(isset($frontDataArr['product_slider_'.$i.'_product_html']) && !empty($frontDataArr['product_slider_'.$i.'_product_html'])){ ?>
            <div class="row py-4 border-bottom"> 
                 <div class="col-lg-12">

                    <?=($frontDataArr['product_slider_'.$i.'_title'])?'<div class="title-wrap text-center"> <h2 class="h1-style">'.$frontDataArr['product_slider_'.$i.'_title'].'</h2> </div>':''?>
                     
                     <div class="holder  full-nopad mt-0">
                        <div class="container">
                            <div class="collection-carousel data-slick slick-arrows-squared" data-slick='{"slidesToShow": 4, "autoplay": true,  "responsive": [{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 480,"settings": {"slidesToShow": 1}}]}'>
                                <?=$frontDataArr['product_slider_'.$i.'_product_html']?>
                            </div>
                        </div>
                    </div>
                 </div>
                 <?=($frontDataArr['product_slider_'.$i.'_btn_title'])?'<div class="container"> <div class="row align-items-center justify-content-center mt-2"> <div clas="col-lg-12"> <a href="'.$frontDataArr['product_slider_'.$i.'_btn_url'].'" class="btn btn--lg">'.$frontDataArr['product_slider_'.$i.'_btn_title'].'</a> </div> </div> </div>':''?>

            </div>
        <?php }
    }








    ?>




<?php if (isset($frontData->trending_title) && !empty($frontData->trending_title) && isset($frontData->trending_product) && !empty($frontData->trending_product)) {


    if (!empty($trendingData)) {  ?>
        <div class="trending-now">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="now">
                            <h2><?=$frontData->trending_title?></h2>
                            <?php if (isset($frontData->trending_btn_url) && !empty($frontData->trending_btn_url) && isset($frontData->trending_btn_title) && !empty($frontData->trending_btn_title))
                                    echo '<a href="'.$frontData->trending_btn_url.'">'.$frontData->trending_btn_title.'</a>';
                            ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="responsive-carousel1">
                            <?php foreach ($trendingData as $product) { ?>
                            <li onclick="window.location.href='<?=BASEURL.'/'.$product->slug;?>';">
                                <img src="<?=getResizedImg($product->img,'200_200');?>" alt="<?=$product->productName;?>">
                                <div class="same-delivary">
                                    <h3><?=$product->productName;?></h3>
                                    <h4><?=($product->salePrice > 0 && $product->actualPrice > $product->salePrice  )?'<b>₹'.$product->salePrice.'</b><del>'.$product->actualPrice.'</del>':'<b>₹'.$product->actualPrice.'</b>';?></h4>
                                    
                                    <h5 class="raiting">
                                        <span class="fa fa-star <?=($product->rating >= 1)?'checked':'';?>"></span>
                                        <span class="fa fa-star <?=($product->rating >= 2)?'checked':'';?>"></span>
                                        <span class="fa fa-star <?=($product->rating >= 3)?'checked':'';?>"></span>
                                        <span class="fa fa-star <?=($product->rating >= 4)?'checked':'';?>"></span>
                                        <span class="fa fa-star <?=($product->rating == 5)?'checked':'';?>"></span>
                                        <?=$product->totalReview; ?> Reviews
                                    </h5>
                                    <a href="<?=BASEURL.'/'.$product->slug;?>">Buy Now</a>
                                </div>
                                <?=($product->isSameDayDelivery)?'<div class="same-day-delivery"><h6>Same Day Delivery</h6></div>':''; ?> 
                            </li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
        <span class="social-statistics hide"></span>
            <?php //$this->load->viewF('inc/homeproducts.php'); ?>

        <?php  if (isset($frontData->sale_banner_title) && !empty($frontData->sale_banner_title) && !empty($frontData->sale_banner_img)) { ?>
        <!-- Recommended Product -->
        <div class="holder fullwidth full-nopad bgcolor bgcolor-1">
            <div class="container">
                <div class="row no-gutters align-items-center">
                    <div class="col-md">
                        <a href="<?=($frontData->sale_banner_btn_url)?$frontData->sale_banner_btn_url:BASEURL?>" class="bnr bnr--style-2 bnr--center bnr--middle" data-fontratio="9.52">
                            <span class="bnr-caption">
                                <span class="bnr-text-wrap">
                                    <?=($frontData->sale_banner_title)?'<span class="bnr-text1">'.$frontData->sale_banner_title.'</span>':''?>
                                    <?=($frontData->sale_banner_text1)?'<span class="bnr-text2">'.$frontData->sale_banner_text1.'</span>':''?>
                                    <?=($frontData->sale_banner_text2)?'<span class="bnr-text3">'.$frontData->sale_banner_text2.'</span>':''?>
                                    <?=($frontData->sale_banner_btn_text)?'<span class="btn-decor bnr-btn btn-decor--whiteline">'.$frontData->sale_banner_btn_text.'<span class="btn-line"></span></span>':''?>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="col-md d-none d-md-block"><a href="<?=($frontData->sale_banner_btn_url)?$frontData->sale_banner_btn_url:BASEURL?>" class="bnr bnr--left bnr--middle"><img src="<?php echo FRONTSTATIC; ?>/images/placeholder.png" data-src="<?=UPLOADPATH.'/setting_images/'.$frontData->sale_banner_img?>" alt="Banner" class="lazyload"></a></div>
                </div>
            </div>
        </div>

    <?php } ?>    

<div class="row section-component" attribute-index="4">
    <section class="col-sm-12 col-md-12 col-lg-12 bannerStatic" style="padding-bottom:10px" id="idf_banner-0">
        <div>
            <div class="stripmn">
                <div class="container">
                    <div class="strip text-center">
                        <h3><span></span>GUIDES<div class="dropdown-divider"></div>
Stuck somewhere in your purchase journey? Take help from our interactive guides below.<span></span></h3>
                    </div>
                    <div class="accessories row" >
                        <a href="# " class="col-lg-4">
                            <div class="accessories_item">
                                <div class="accessories_item_img">
                                    <img src="<?php echo FRONTSTATIC; ?>/images/1.jpg">
                                </div>
                                <!--<h2>Size Guide</h2>-->
                                <!--<p>pleasure and praising pain was born I will give you a complete account of the system, and expound actual teachings great.</p>-->
                                <!--<div class="button_shop">SHOP</div>-->
                            </div>
                        </a>
                     
                       
                        
                        <a href="#" class="col-lg-4">
                            <div class="accessories_item">
                                <div class="accessories_item_img">
                                    <img src="<?php echo FRONTSTATIC; ?>/images/2.jpg">
                                </div>
<!--                                <h2>PRESCRIPTION GUIDE</h2>-->
<!--                                <p>-->
<!--pleasure and praising pain was born I will give you a complete account of the system, and expound actual teachings great.</p>-->
<!--                                <div class="button_shop">SHOP</div>-->
                            </div>
                        </a>
                        <a href="#" class="col-lg-4">
                            <div class="accessories_item">
                                <div class="accessories_item_img">
                                    <img src="<?php echo FRONTSTATIC; ?>/images/3.jpg">
                                </div>
                                <!--<h2>Face Shape Guide</h2>-->
                                <!--<p>pleasure and praising pain was born I will give you a complete account of the system, and expound actual teachings great.</p>-->
                                <!--<div class="button_shop">SHOP</div>-->
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <style></style>
        </div>
    </section>
</div>
 
    </div>
		<?php $this->load->viewF('inc/footer.php'); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				// getFrontPagehtml();
			});

		</script>

	</body>
</html>