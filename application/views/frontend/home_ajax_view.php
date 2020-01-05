<?php 
	if (isset($frontPageSettingData->value) && !empty($frontPageSettingData->value)){
	    $frontDataArr = unserialize($frontPageSettingData->value);
	    $frontData = (object) $frontDataArr;
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
			if(in_array($product->productId, $frontDataArr['product_slider_1_product_arr']))
				$frontDataArr['product_slider_1_product_html'] .= $productHtml;
			if(in_array($product->productId, $frontDataArr['product_slider_2_product_arr']))
				$frontDataArr['product_slider_2_product_html'] .= $productHtml;
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








		