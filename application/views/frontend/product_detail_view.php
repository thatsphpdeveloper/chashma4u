		<?php $this->load->viewF('inc/header.php'); ?>	
	<style type="text/css">
     .rgnUpper{
        height: 100% !important;
     }
     span.offer-ratio {
        color: #ea6e11;
    }
    </style>
	
	
	
				
		<div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="<?=BASEURL?>">Home</a></li>
                   
                    <li><a href="javascript:" class="active"><?=$productData->productName;?></a></li>
                </ul>
            </div>
        </div>


        <?php
            $variableHtml = array();
             $sliderHtml = $sliderZoom = ''; 

            if(isset($variableData) && !empty($variableData)){
                foreach ($variableData as $key => $variable) {
                    if (!isset($variableHtml[$variable->color]))
                        $variableHtml[$variable->color] = array();

                    array_push($variableHtml[$variable->color], array('rgn'=>$variable->rgn, 'actualPrice'=>$variable->actualPrice, 'salePrice'=>$variable->salePrice, 'variableId'=>$variable->variableId, 'variableTitle'=>$variable->variableTitle));


                    if(isset($variable->img) && !empty($variable->img))
                        $sliderHtml .= '<a href="#" id="variable-img-'.$variable->variableId.'"  data-value="image" data-image="'.UPLOADPATH.'/images/'.$variable->img.'" data-zoom-image="'.UPLOADPATH.'/images/'.$variable->img.'"><img src="'.getResizedImg($variable->img,'148_122').'" alt="variable"></a>';
                    if(empty($sliderZoom) && isset($variable->img) && !empty($variable->img))
                        $sliderZoom = '<img class="zoom" src="'.UPLOADPATH.'/images/'.$variable->img.'" data-zoom-image="'.UPLOADPATH.'/images/'.$variable->img.'" alt="Gallery" />';
                }
            }
         
		     if(isset($galleryData) && !empty($galleryData)){
		     foreach ($galleryData as $key => $gallery) {
		     	if(isset($gallery->img) && !empty($gallery->img))
		   	  		$sliderHtml .= '<a href="#" data-value="image" data-image="'.UPLOADPATH.'/images/'.$gallery->img.'" data-zoom-image="'.UPLOADPATH.'/images/'.$gallery->img.'"><img src="'.getResizedImg($gallery->img,'148_122').'" alt="Gallery"></a>';
			   	if(empty($sliderZoom) && isset($gallery->img) && !empty($gallery->img))
			     	$sliderZoom = '<img class="zoom" src="'.UPLOADPATH.'/images/'.$gallery->img.'" data-zoom-image="'.UPLOADPATH.'/images/'.$gallery->img.'" alt="Gallery" />';
		   	 }}
		?>
        <div class="holder mt-0">
            <div class="container ">
                <div class="row prd-block prd-block--mobile-image-first js-prd-gallery" id="prdGallery100">
                    <div class="col-md-8 col-12 border border-light shadow-lg" style="">
                        <div class="prd-block_info js-prd-m-holder mb-2 mb-md-0"></div><!-- Product Gallery -->
                        <div class="prd-block_main-image main-image--slide js-main-image--slide  shadow">
                            <div class="prd-block_main-image-holder js-main-image-zoom" data-zoomtype="inner">
                                <div class="prd-block_main-image-video js-main-image-video"><video loop muted preload="metadata" controls="controls">
                                        <source src="#"></video>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-has-loader">
                                    <div class="gdw-loader"></div>
                                   <?=$sliderZoom?>
                                </div>
                                <div class="prd-block_main-image-next slick-next js-main-image-next">NEXT</div>
                                <div class="prd-block_main-image-prev slick-prev js-main-image-prev">PREV</div>
                            </div>
                        </div>
                        <div class="product-previews-wrapper" style="">
                            <div class="product-previews-carousel" id="previewsGallery100">
                            	<?=$sliderHtml?>
                          </div>
                        </div>
                        <!-- /Product Gallery -->
                    </div>
                    
                   <div class="col-md-4 border-left" >
                       <!--<h3 class="text-center">Product Description</h3><div class="dropdown-divider"></div>-->
						<p class="text-inner"> <?=$productData->description?></p>
                    	<div class="optionchoose">
                    		<div class="swatches">
                    			<?=(($productData->brandName)?'<div class="swatch clearfix" data-option-index="0"> <div class="header d-flex justify-content-start"><span>Brand : &nbsp; &nbsp; &nbsp; </span><span class="font-weight-bold">'.$productData->brandName.'</span></div> </div>':'')?>
                    			<?=(($productData->shapeName)?'<div class="swatch clearfix  py-2" data-option-index="0"> <div class="header  d-flex justify-content-start"><span>Shape : &nbsp; &nbsp; &nbsp; &nbsp</span><span class="font-weight-bold ">'.$productData->shapeName.'</span></div> </div>':'')?>
                    		
                    		
                    		
                                                <!--</div>':'<div class="price-new">₹ '.$product->actualPrice.' actualPrice.</div>';?>-->                                                                                                                                                                                     
                                            
                    		<?=(($productData->actualPrice)?'<div class="swatch clearfix" data-option-index="0"> <div class="header  d-flex justify-content-start" ><span>Special Price :&nbsp; &nbsp; &nbsp; <b>₹</b></span> <span class="font-weight-bold"> '.$productData->salePrice.'</span>  <span class="font-weight-bold ml-1"> <del>'.$productData->actualPrice.'₹</del></span><span class="offer-ratio"> &nbsp;&nbsp;&nbsp;You save ₹'.(round($productData->actualPrice - $productData->salePrice)).'</span></div> </div>':'')?>
                

                    		
                    			
        	                	<div class="order-total border-top ">
                                    <span><img src="<?=FRONTSTATIC?>/images/ship-01.png" width="190px"></span>
                                 
                                           
                                </div>
                                            
                                            <div class="order-total border-top">
                                                <span>COD </span>
                                              <span class="font-weight-bold product-shipping">(Cash On Delivery Available)</span>
                                                       
                                            </div>
                    			
                    			
                        <?php
                            $categoryIds = array();
                            if(isset($productData->categoryIds) && !empty($productData->categoryIds))
                                $categoryIds = explode(',', $productData->categoryIds);

                        ?>
                    			
                    			<div class="swatch clearfix" data-option-index="0">
                    				<!-- <div class="header hide">Size</div> -->
                    				<?php
                    				$colorHtml = $numberHtml = '';
                    				$i = 0;
                    					if($variableHtml){
                                            $colorHtml .='<div class="swatch clearfix color-box" id="color-box" data-option-index="1"> <div class="header">Color</div>';
                    						foreach ($variableHtml as $color => $variable) {
                                                $colorHtml .='<div class="swatch-element color-item color '.$color.' available" data-value="'.$color.'" data-type="'.((in_array(4, $categoryIds))?'reading':'other').'"> <input quickbeam="color" id="swatch-1-'.$color.'" type="radio" name="variable" value="'.$variable[0]['variableId'].'" '.(($productData->variableId == $variable[0]['variableId'])?'checked':'').' data-price="'.(($variable[0]['salePrice'] > 0)?$variable[0]['salePrice']:$variable[0]['actualPrice']).'" /> <label for="swatch-1-blue" style="border-color: '.$color.';"> <span style="background-color: '.$color.';"></span> </label> </div>';

                                                
                                                $numberOption = '';
                                                $isShown = 0;
                								foreach ($variable as $key => $item) {
                									$numberOption .='<option value="'.$item['variableId'].'" '.(($productData->variableId == $item['variableId'])?'selected':'').'  data-price="'.(($item['salePrice'] > 0)?$item['salePrice']:$item['actualPrice']).'">'.$item['rgn'].'</option>';
                                                    $isShown = (($productData->variableId == $item['variableId'])?1:$isShown);
                								}
                                                if($numberOption)
                                                    $numberHtml .='<div class="reading-eyewear-box number-box-'.$color.' '.((!in_array(4, $categoryIds))?'hide':(($isShown == 0)?'hide':'')).'">
                                                    <div class="form-group">
                                                    <label>Select number</label>
                                                    <select class="form-control rgnUpper" name="rgnUpper">
                                                    <option value="">Select number</option>
                                                    '.$numberOption.'
                                                        </select>
                                                    </div>
                                                </div>';
                								// $colorHtml .='</div>';
                    							
                    							$i++;
                    						}

                                                $colorHtml .='</div>';
                    					}

                    				?>

                    			</div>
                    			<?=$colorHtml?>

                    		</div>
                    	</div>



                    	<div class="d-flex ">
    						<div class="m-1 <?=(in_array(1, $categoryIds))?'':'hide'?>">
    							<div class="prd-block_actions topline ">
    								<div class="btn-wrap"><button class="btn btn--add-to-cart" onclick="buyFrameOnly(this, event)"><i class="icon icon-handbag"></i><span>FRAME ONLY</span></button></div>
    							</div>
    						</div>
    						<div class="m-1">
    						<div class="prd-block_actions topline <?=(in_array(1, $categoryIds))?'':'hide'?>">
    							<div class="btn-wrap"><button class="btn btn--add-to-cart button-withlens" onclick="buyFrameWithLens(this, event)"><span>BUY WITH LENS</span>
    							</button></div></div>
    						</div>
                        </div>
                        <?=$numberHtml?>
                       
                        <div class="mt-2 <?=(in_array(4, $categoryIds) || in_array(3, $categoryIds) || in_array(2, $categoryIds))?'':'hide'?>">
                            <div class="prd-block_actions topline">
                                <div class="btn-wrap"><button class="btn btn--add-to-cart" onclick="buyReadingEyewear(this, event)"><i class="icon icon-handbag"></i><span>Buy Now</span></button></div>
                            </div>
                        </div>
                   </div>
                </div>
               
                <div class="row  prd-block prd-block--creative mt-5 prd-block--mobile-image-first ">
                    <div class="col-md-12 col-lg-8 col-xl-9 aside">
                    	<form onsubmit="addUpdateCart(this, event)" enctype="multipart/form-data">
	                        <div class="pres-wrap d-none">
		                        <div class="select-wrap">
                                    <ul class="pres-type">
                                        <li class="frame-only hide"> <label for="frame-only" class="radio-wrap" >
                                            
                                             <input type="radio" id="frame-only" name="prescription_type" value="frame-only"  checked> <span></span> </label> <div class="text"> <div class="text-inner"> <span class="single-t">Frame Only</span> </div>
                                             </div> </li>
									   <?php 
									     
									    $lensHtml = ''; 
									    if(isset($lensCategoryData) && !empty($lensCategoryData) && (in_array(1, $categoryIds))){

										    foreach ($lensCategoryData as $key => $lensCategory) {
										   	  	echo '<li class=" py-2 ' .$lensCategory->slug.'"> <label for="'.$lensCategory->slug.'" class="radio-wrap"> <input type="radio" id="'.$lensCategory->slug.'" name="prescription_type" value="'.$lensCategory->slug.'" > <span></span> </label> <div class="text"> '.(($lensCategory->img)?'<img src="'.UPLOADPATH.'/category_images/'.$lensCategory->img.'" alt=""> <div class="text-inner">':'').' <span class="single-t">'.$lensCategory->categoryName.'</span> </div> </div> </li>';
										   	  	$lensData = $this->Common_model->exequery("SELECT * FROM ch_lens WHERE status = 0 AND categoryId = '".$lensCategory->categoryId."' order by lensId desc");
										   	  	if($lensData){
										   	  		foreach ($lensData as $key => $lens) {
										   	  			$lensHtml .= '<tr class="lens-'.$lensCategory->slug.'" data-id="lens-'.$lens->lensId.'" data-name="'.$lens->name.'" data-price="'.(($lens->salePrice > 0)?$lens->salePrice:$lens->actualPrice).'"> <th scope="row">'.$lens->name.'<input type="radio" id="lens-'.$lens->lensId.'" name="lens-option" value="'.$lens->lensId.'"></th>  <td>'.$lens->lensIndex.'</td> <td>'.(($lens->scratchResistant)?'Yes':'No').'</td> <td>'.$lens->antiReflectiveCoating.'</td> <td>'.(($lens->waterDustRepellent)?'Yes':'No').'</td> <td>'.(($lens->uv400Protection)?'Yes':'No').'</td> <td>'.(($lens->blueLightBlocker)?'Yes':'No').'</td> <td>'.(($lens->salePrice > 0)?'Rs. '.$lens->salePrice.'/- <del>'.$lens->actualPrice.'/-</del>':'Rs. '.$lens->actualPrice.'/-').'</td> </tr>';
										   	  		}
										   	  	}
										   	}

										}

									?>
		                            </ul>
                                </div>
		                          
		                          
                                <div class="lens-wrap d-none">
                                    <div class="table-responsive">
                                        <table c="" class="table table-bordered table-hover text-center table_Lens">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Lens</th>
                                                    <th scope="col">Index</th>
                                                    <th scope="col" class="info" onmouseover="document.querySelcetor('.sc').style.display='block'">Scratch Resistant <i class="fa fa-info-circle" aria-hidden="true"></i></th>
                                                    <th scope="col" class="info" onmouseover="document.querySelcetor('.an').style.display='block'">Anti Reflective Coating <i class="fa fa-info-circle" aria-hidden="true"></i></th>
                                                    <th scope="col" class="info" onmouseover="document.querySelcetor('.water').style.display='block'">Water &amp; Dust Repellent <i class="fa fa-info-circle" aria-hidden="true"></i></th>
                                                    <th scope="col">UV 400 - Protection</th>
                                                    <th scope="col">Blue Light Blocker <i class="fa fa-info-circle" aria-hidden="true"></i></th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody class="lens-body">
                                                <?=$lensHtml?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

		                        <div class="single-vision d-none ">
                                    <?php $this->load->viewF('inc/single-vision-options.php', array('zeroPowerLenses'=>@$zeroPowerLenses)); ?>
                                </div>
		                        <div class="zero-vision d-none">
                                    <?php $this->load->viewF('inc/zero-vision'); ?>
                                </div>
		                        <div class="Progressive-vision d-none">
                                    <?php $this->load->viewF('inc/Progressive-vision'); ?>
                                </div>

	                        
	                       </div>
                             <div class="prd-block_actions topline <?=(in_array(4, $categoryIds) || in_array(3, $categoryIds) || in_array(2, $categoryIds))?'hide':''?>">
	                            <div class="btn-wrap"><button class="btn btn--add-to-cart buy-btn <?=(in_array(1, $categoryIds))?'hide':''?>" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Buy Now</span></button></div>
	                            <input type="hidden" name="action" value="addProductToCart">
	                            <input type="hidden" name="productId" id="productId" value="<?=$productData->productId;?>">
                                <input type="hidden" name="variableId" id="variableId" value="<?=$productData->variableId;?>">
	                        </div>

	                        
	                        <div class="msg"></div>
                        </form>
                    </div>
                    <?php
                    $actualPrice = $productData->actualPrice;
					$salePrice = $productData->salePrice;
                    ?>
                    <div class="col-md-12 col-lg-4 col-xl-3  fixed-col fixed aside js-product-fixed-col" style="min-height:90px">
                        <div class="fixed-col_container" >
                            <div class="fstart"></div>
                            <div class="fixed-wrapper ">
                                <div class="fixed-scroll sticky-top" >
                                    <div class="fixed-col_content d-none">
                                        <div class="prd-block_info bg-light ">
                                               <div class="alert bg-dark"><strong>ORDER SUMMARY</strong> </div>
                                            <div class="frame-price-wrap px-2 mt-0" >
                                             <div class="order-frame bg-light">
                                                 <div class="product-sku">
                                                        <span class="name">SKU:</span>
                                                        <span class="len-price"><?=$productData->sku?> </span>
                                                </div>
                                                 <h4 class="mb-1">FRAME</h4>
                                                 <ul class="lenses-list">
                                                    <li >
                                                        <span class="name">Price :</span>
                                                        <span class="product-price">₹ <?=$price = ($salePrice > 0)?$salePrice:$actualPrice;?></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="order-lens border-top d-none">
                                                 <h4 class="mb-1">LENSES</h4>
                                                <ul class="lenses-list">
                                                    <li>
                                                        <span class="name">No Lens</span>
                                                        <span class="len-price">₹ 0.00</span>
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="order-total border-top">
                                                <span>GST</span>
                                              <span class="font-weight-bold product-tax">₹ 
                                                <?php
                                                    if((in_array(1, $categoryIds) || in_array(4, $categoryIds)))
                                                        $taxPer = 12;
                                                    else
                                                        $taxPer = 18;

                                                    echo $tax = round((($price*$taxPer)/100), 2);
                                                ?>

                                              </span>
                                                       
                                            </div>
                                            <div class="order-total border-top">
                                                <span>Shipping</span>
                                              <span class="font-weight-bold product-shipping">Free</span>
                                                       
                                            </div>
                                            <div class="order-total border-top">
                                                <span>TOTAL</span>
                                              <span class="font-weight-bold product-total">₹ <?=round($price+$tax);?></span>
                                                       
                                            </div>
                                        </div>                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
							<!-- end -->

                               </div>


                               <div class="fend"></div>
                     
                    </div>
                </div>
                <div class="ymax"></div>
            </div>
        </div>
      


      

    </div>


		<?php $this->load->viewF('inc/footer.php'); ?>


		<script type="text/javascript">
            const taxPer = <?=$taxPer?>;
            var price = <?=$price?>;
            var tax = <?=$tax?>;
            var total = <?=$price+$tax?>;
            var lensPrice = 0;
			$(document).ready(function(){
                $(".slick-slide.slick-active").click(function(){$(this).dblclick()});
				$("tbody.lens-body tr").click(function(){
                    $(this).addClass("selected").siblings().removeClass("selected");
                    // $(".prescrip").removeClass("d-none").addClass('d-block');
                    $(".lens-options-show").removeClass("d-none").addClass('d-block');
                    $(this).find('input[name=lens-option]').prop('checked', true).trigger('change');
                });
                $("button.button-withlens").click(function(){
                    $("div.pres-wrap").removeClass("d-none").addClass('d-block');
                });
			    $("input#single-vision").click(function (){
			        $(".lens-body tr").addClass("d-none");
			        $(".lens-body tr.lens-single-vision").removeClass("d-none");
			        $("div.single-vision").removeClass("d-none").addClass("d-block");
			        $("div.bifocal-progressive").removeClass("d-block").addClass("d-none"); 
			        $("div.zero-power").removeClass("d-block").addClass("d-none");
			        $("div.lens-wrap, div.order-lens").removeClass("d-none").addClass("d-block");
			        $(".progressive-vision-visible").removeClass("d-block").addClass("d-none");
                    $(".pd-box").addClass("hide");
			    });
			    $("input#bifocal-progressive").click(function (){

			        $(".lens-body tr").addClass("d-none");
			        $(".lens-body tr.lens-bifocal-progressive").removeClass("d-none");
			        $("div.single-vision").removeClass("d-none").addClass("d-block");
			        $("div.bifocal-progressive").removeClass("d-none").addClass("d-block"); 
			        $("div.zero-power").removeClass("d-block").addClass("d-none");
			        $("div.lens-wrap, div.order-lens").removeClass("d-none").addClass("d-block");
			        $(".progressive-vision-visible").removeClass("d-none").addClass("d-block");
                    $(".pd-box").removeClass("hide");
			    });
			    $("input#zero-power").click(function (){
			        $(".lens-body tr").addClass("d-none");
			        $(".lens-body tr.lens-zero-power").removeClass("d-none");
			        $("div.single-vision").removeClass("d-block").addClass("d-none");
			        $("div.zero-power").removeClass("d-none").addClass("d-block");
			         $("div.bifocal-progressive").removeClass("d-block").addClass("d-none"); 
			        $("div.lens-wrap, div.order-lens").removeClass("d-block").addClass("d-block");
                    $(".pd-box").addClass("hide");
			    });

			    $("input[name=lens-option]").change(function(){
			    	if($(this).is(':checked')){
			    		$("div.order-lens").removeClass("d-none").addClass("d-block");
			    		$("div.order-lens").find('.len-price').text('₹ '+$(this).closest('tr').data('price'));
                        lensPrice = parseFloat($(this).closest('tr').data('price'));
                        var priceTotal = price+lensPrice;
                        var taxTotal =((priceTotal)*taxPer)/100;
                        $(".product-tax").text('₹ '+(taxTotal.toFixed(0)));
                        $(".product-total").text('₹ '+((priceTotal+taxTotal).toFixed(0)));
			    		$("div.order-lens").find('.name').text($(this).closest('tr').data('name'));
			    	}else
			    		$("div.order-lens").removeClass("d-block").addClass("d-none");
			    });

			    //variable logics
			    $(".color-item").click(function (){
			    	$(this).find("input[name=variable]").prop('checked', true).trigger('change');
                    if($(this).data('type') == 'reading'){
                        $('.reading-eyewear-box').addClass('hide');
                        $('.number-box-'+$(this).data('value')).removeClass('hide');
                        $(".rgnUpper").val('');
                    }else{
                        $('#variableId').val($(this).find("input[name=variable]").val());
                        price = parseFloat($(this).find("input[name=variable]").data('price'));
                        $("#variable-img-"+$('#variableId').val()).trigger('click');
                    }
                    var priceTotal = price+lensPrice;
                    var taxTotal =((priceTotal)*taxPer)/100;
                    $(".product-price").text('₹ '+(price.toFixed(0)));
                    $(".product-tax").text('₹ '+(taxTotal.toFixed(0)));
                    $(".product-total").text('₹ '+((priceTotal+taxTotal).toFixed(0)));
			    });
                $(".rgnUpper").change(function (){
                    $('#variableId').val($(this).val());
                    price = parseFloat($(this).children("option:selected").data('price'));
                    $("#variable-img-"+$('#variableId').val()).trigger('click');
                    var priceTotal = price+lensPrice;
                    var taxTotal =((priceTotal)*taxPer)/100;
                    $(".product-price").text('₹ '+(price.toFixed(0)));
                    $(".product-tax").text('₹ '+(taxTotal.toFixed(0)));
                    $(".product-total").text('₹ '+((priceTotal+taxTotal).toFixed(0)));
                });
			    // $(".size-item label").click(function (){
			    // 	$(this).closest('.size-item').find("input[name=size]").prop('checked', true).trigger('change');
			    // 	$('.optionchoose').find('.color-box').addClass('hide');
			    // 	$('.optionchoose').find('#color-box-'+$(this).closest('.size-item').data('value')).removeClass('hide');

			    // });

			});

			function buyFrameOnly(obj, e){
				$(document).find('#frame-only').prop('checked', true);
				$(document).find('.buy-btn').trigger('click');
			}
            function buyReadingEyewear(obj, e){
                // $(document).find('#rgn').val($(document).find('#rgnUpper').val());
                $(document).find('.buy-btn').trigger('click');
            }

			function buyFrameWithLens(obj, e){
                $("#single-vision").trigger('click');
                $(".fixed-col_content").removeClass("d-none").addClass("d-block");
                $(".buy-btn").removeClass('hide');
				$('html, body').animate({
			      scrollTop: ($(".buy-btn").offset().top-(($(window).width() < 700)?380:220))
			    }, 1000);

			} 

		</script>
	
	</body>
</html>