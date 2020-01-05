<?php $this->load->viewF('inc/header.php'); ?>

    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
							<li><a href="<?=BASEURL?>">Home</a></li>

							<?php 
							if(isset($descriptionData->subcategoryItemSlug)){
								echo (isset($descriptionData->categoryName) && !empty($descriptionData->categoryName))?'<li><a href="'.BASEURL.'/'.$descriptionData->categorySlug.'">'.$descriptionData->categoryName.'</a></li>':'';
								echo (isset($descriptionData->subcategoryName) && !empty($descriptionData->subcategoryName))?'<li><a href="'.BASEURL.'/'.$descriptionData->subcategorySlug.'">'.$descriptionData->subcategoryName.'</a></li>':'';
								echo (isset($descriptionData->subcategoryItemName) && !empty($descriptionData->subcategoryItemName))?'<li><a href="javascript:" class=active>'.$descriptionData->subcategoryItemName.'</a></li>':'';
							}else if(isset($descriptionData->subcategorySlug)){
								echo (isset($descriptionData->categoryName) && !empty($descriptionData->categoryName))?'<li><a href="'.BASEURL.'/'.$descriptionData->categorySlug.'">'.$descriptionData->categoryName.'</a></li>':'';
								echo (isset($descriptionData->subcategoryName) && !empty($descriptionData->subcategoryName))?'<li><a href="javascript:" class=active>'.$descriptionData->subcategoryName.'</a></li>':'';
							}else{
								echo (isset($descriptionData->categoryName) && !empty($descriptionData->categoryName))?'<li><a href="javascript:" class=active>'.$descriptionData->categoryName.'</a></li>':'';
							}	?> 
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <!-- Two columns -->
                <!-- Page Title -->
                <div class="page-title text-center d-none d-lg-block">
                    <div class="title">
                        <h1><?=(isset($descriptionData->title) && !empty($descriptionData->title))?$descriptionData->title:'' ?></h1>
                    </div>
                </div>
                <!-- /Page Title -->
                <div class="row">
                    <!-- Left column -->
                   <?php $this->load->viewF('inc/left-side-filter'); ?>
                    <!-- /Left column -->
                    <!-- Center column -->
                    <div class="col-lg aside">
                        <div class="prd-grid-wrap">
                            <!-- Filter Row -->
                            <div class="filter-row invisible">
                                <div class="row row-1 d-lg-none align-items-center">
                                    <div class="col">
                                        <h1 class="category-title"><?=(isset($descriptionData->title) && !empty($descriptionData->title))?$descriptionData->title:'' ?></h1>
                                    </div>
                                    <div class="col-auto ml-auto">
                                        <div class="view-in-row d-md-none"><span data-view="data-to-show-sm-1"><i class="icon icon-view-1"></i></span> <span data-view="data-to-show-sm-2"><i class="icon icon-view-2"></i></span></div>
                                        <div class="view-in-row d-none d-md-inline"><span data-view="data-to-show-md-2"><i class="icon icon-view-2"></i></span> <span data-view="data-to-show-md-3"><i class="icon icon-view-3"></i></span></div>
                                    </div>
                                </div>
                                <div class="row row-2">
                                    <div class="col-left d-flex align-items-center">
                                        <div class="sort-by-holder">
                                            <div class="select-label d-none d-lg-inline">Sort by:</div>
                                            <div class="select-wrapper-sm d-none d-lg-inline-block">
                                                <select class="form-control input-sm" name="filterShortBy" id="filterShortBy">
                                                    <option value="featured">Featured</option>
                                                    <option value="rating">Rating</option>
                                                    <option value="price">Price</option>
                                                </select>
                                            </div>
                                            <div class="select-directions d-none d-lg-inline">
                                                <span><i class="icon icon-arrow-down"></i></span>
                                                <span><i class="icon icon-arrow-up active"></i></span></div>
                                            <div class="dropdown d-flex d-lg-none align-items-center justify-content-center"><span class="select-label">Sort By</span>
                                                <div class="select-wrapper-sm">
                                                    <select class="form-control input-sm" name="filterShortByMob" onchange="$('#filterShortBy').val($(this).val()).trigger('change');">
                                                        <option value="featured">Featured</option>
                                                        <option value="rating">Rating</option>
                                                        <option value="price">Price</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="filter-button d-lg-none"><a href="#" class="fixed-col-toggle">FILTER</a></div>

                                        <input type="hidden" name="filterSearchCond"  id="filterSearchCond" value="<?=isset($filterSearchCond)?$filterSearchCond:''?>">
                                    </div>
                                    <div class="col col-center d-none d-lg-flex align-items-center justify-content-center">
                                        <div class="view-label">View:</div>
                                        <div class="view-in-row"><span data-view="data-to-show-3"><i class="icon icon-view-3"></i></span> <span data-view="data-to-show-4"><i class="icon icon-view-4"></i></span></div>
                                    </div>
                                    <div class="col-right ml-auto d-none d-lg-flex align-items-center">
                                        <div class="items-count"> <?=(isset($searchData) && !empty($searchData))?count($searchData):0 ?> item(s)</div>
                                        <div class="show-count-holder">
                                            <div class="select-label">Show:</div>
                                            <div class="select-wrapper-sm">
                                                <select class="form-control input-sm" id="itemLimit" name="itemLimit">
                                                    <option value="12">12</option>
                                                    <option value="36">36</option>
                                                    <option value="100">100</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter Row -->
                            <!-- Products Grid -->
                            <div class="prd-grid product-listing data-to-show-3 data-to-show-md-3 data-to-show-sm-2 js-category-grid mb-5 filter-data">
                            <?php $wishlistUrl = ($this->session->userdata(PREFIX.'userRoleId') > 0)?'javascript:':BASEURL."/login"?>
                                <?php if (isset($searchData) && !empty($searchData)) {  ?>
							<?php foreach ($searchData as $product) {

                                    $gallery = $this->Common_model->exequery("SELECT pi.*, (case when pi.imageId > 0 then (SELECT imageName FROM ".tablePrefix."images  WHERE imageId = pi.imageId ) else '' end) as img FROM ".tablePrefix."product_images as pi WHERE pi.status = 0 AND pi.productId = ".$product->productId." having img !='' order by productImageId desc",1);

                                    $variableHtml = '';
                                    $variableData = $this->Common_model->exequery("SELECT pv.color FROM ".tablePrefix."product_variable as pv WHERE pv.status = 0 AND pv.productId = ".$product->productId." limit 0, 5");
                                    if($variableData){
                                        foreach ($variableData as $key => $variable) {
                                            $variableHtml .= '<div class="prd-color-item" style="background-color:'.$variable->color.'"></div>';
                                        }
                                    }
                                    
                                ?>
                                <div class="prd prd-has-loader product-item">
                                    <div class="prd-inside">
                                        <div class="prd-img-area">
                                            <a href="<?=BASEURL.'/'.$product->slug;?>" class="prd-img">
                                                <img src="<?=FRONTSTATIC?>/images/products/product-placeholder.png" data-srcset="<?=getResizedImg($product->img,'345_270');?>" alt="<?=$product->productName;?>" class="js-prd-img lazyloaded" srcset="<?=getResizedImg($product->img,'345_270');?>" srcalt="<?=(isset($gallery->img) && !empty($gallery->img))?getResizedImg($gallery->img,'345_270'):'';?>" hovered="0">                  
                                            </a><a href="<?=$wishlistUrl?>" onclick="addRemoveFromWishlist(this, event, <?=$product->productId?>)" class="label-wishlist icon-heart  <?=(isset($product->isWishlisted) && $product->isWishlisted > 0)?'active':''?>"></a>
                                            <!-- <ul class="list-options color-swatch prd-hidemobile">
                                                <li data-image="images/products/product-09.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" src="images/products/product-09.jpg" class="lazyload" alt="Color Name"></a></li>
                                                <li data-image="images/products/product-09-2.jpg"><a href="#" class="js-color-toggle"><img src="images/products/product-placeholder.png" src="images/products/product-09-2.jpg" class="lazyload" alt="Color Name"></a></li>
                                            </ul> -->
                                            <div class="gdw-loader"></div>
                                        </div>
                                        <div class="prd-info">
                                            <div class="prd-tag prd-hidemobile"><a href="javascript:"><?=$product->brandName;?></a></div>
                                            <h2 class="prd-title"><a href="<?=BASEURL.'/'.$product->slug;?>"><?=$product->productName;?></a></h2>

                                            <div class="prd-color-box prd-hidemobile"><?=$variableHtml;?></div>

                                            <!--<div class="prd-rating prd-hidemobile"><i class="icon-star <?=($product->rating >= 1)?'fill':'';?>"></i><i class="icon-star  <?=($product->rating >= 2)?'fill':'';?>"></i><i class="icon-star  <?=($product->rating >= 3)?'fill':'';?>"></i><i class="icon-star  <?=($product->rating >= 4)?'fill':'';?>"></i><i class="icon-star  <?=($product->rating == 5)?'fill':'';?>"></i></div>-->
                                            <div class="prd-price">
                                                
                                                <?=($product->salePrice > 0 && $product->actualPrice > $product->salePrice  )?'<div class="price-new">₹ '.$product->salePrice.'</div><div class="price-old">₹ '.$product->actualPrice.'</div><div class="price-comment">You save ₹ '.($product->actualPrice-$product->salePrice).'</div>':'<div class="price-new">₹ '.$product->actualPrice.'</div>';?>
                                            </div>
                                            <div class="prd-hover">
                                                <div class="prd-action">
                                                    <form action="<?=BASEURL.'/'.$product->slug;?>" method="post"> <button type="submit" class="btn"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                                    <!-- <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form> -->
                                                    <div class="prd-links"><a href="<?=BASEURL.'/'.$product->slug;?>" class="icon-eye"></a></div>
                                                    <!-- <div class="prd-links"><a href="<?=BASEURL.'/'.$product->slug;?>" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div> -->
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
						<?php }else{ 
								echo '<span class="alert alert-danger mt-3" style="width: 100%;">Sorry! No product available now.</span>';
							}

							?>
                              
                            </div>
                            <div class="loader-wrap">
                                <div class="dots">
                                    <div class="dot one"></div>
                                    <div class="dot two"></div>
                                    <div class="dot three"></div>
                                </div>
                            </div>
                            <!-- /Products Grid -->
                            <div class="show-more d-flex mt-4 mt-md-6 justify-content-center align-items-start hide"><a href="#" class="btn btn--alt js-product-show-more">show more</a>
                                <ul class="pagination mt-0">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Center column -->
                </div>
                <!-- /Two columns -->
            </div>
        </div>
    </div>

	<?php $this->load->viewF('inc/footer.php'); ?>
    <script type="text/javascript">
        var isNoProductRemains = 0;
        var bannerImg = "<?=(isset($descriptionData->bannerImg))?$descriptionData->bannerImg:''?>";
        if(bannerImg != '')
            $('.product-banner').css("background-image", "url('"+UPLOADPATH+"/category_images/"+bannerImg+"')");

        $(window).scroll(function () {
            if($(window).scrollTop() + $(window).height() > $(document).height() - 1000 && isNoProductRemains < 4) {
                ajaxScrollProduct(1);
            }
        });

        $(document).on('click', '.selected-filters li', function() {
            $('li.'+$(this).attr('class')).removeClass('active');
            $(this).remove();
            showhidefilteringItems();
        });
        $(document).on('click', '.select-directions span', function() {
            $('.select-directions').find('i.active').removeClass('active');
            $(this).find('i').addClass('active');

            ajaxScrollProduct(0);
        });
        $(document).on('click', '.clear-filters', function() {
            $('.filtering-item').removeClass('active');
            $('.selected-filters').html('');
            $('.selected-filters-box').addClass('hide');
            $('.selected-label').text('(0) FILTERS');
            ajaxScrollProduct(0);
        });

        $(document).on('click', '.filtering-item', function() {
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $('.selected-filters').find('li.'+$(this).data('name')+'-'+$(this).data('value')).remove();

                $('li.'+$(this).data('name')+'-'+$(this).data('value')).removeClass('active');

            }else{
                if($(this).hasClass('filtering-item-price') && $('.filtering-item-price.active').length){
                    $('.selected-filters').find('li.'+$('.filtering-item-price.active').data('name')+'-'+$('.filtering-item-price.active').data('value')).remove();
                    $('.filtering-item-price.active').removeClass('active');
                }
                $(this).addClass('active');
                $('.selected-filters').append('<li class="'+$(this).data('name')+'-'+$(this).data('value')+'"><a href="javascript:">'+$(this).data('text')+'</a><input type="hidden" name="'+$(this).data('name')+'[]" value="'+$(this).data('value')+'"></li>');
                
            }
            showhidefilteringItems();
        });

        $(document).on('change', '#itemLimit, #filterShortBy', function() {        
            ajaxScrollProduct(0);
        });


        function showhidefilteringItems() {
            $('.selected-label').text('('+$('.selected-filters').find('li').length+') FILTERS');
            if($('.selected-filters').find('li').length){
                $('.selected-filters-box').removeClass('hide');
            }
            else{
                $('.selected-filters-box').addClass('hide');
            }

            ajaxScrollProduct(0);
        }

        function ajaxScrollProduct(isScroll) {
            addLoader();
            if(!isScroll){
                isNoProductRemains = 0;
                $('.filter-data').html('');
            }
            var formData = new FormData();
            formData.append('action', 'ajaxScrollProduct');
            formData.append('productCount', (isScroll)?parseInt($('.product-item').length):0);
            formData.append('filterShortBy', $('#filterShortBy').val());
            formData.append('filterSearchCond', $('#filterSearchCond').val());
            formData.append('filterShortAsc', $('.select-directions').find('i:eq(0)').hasClass('active'));
            $('.selected-filters').find('input').each(function(i) {
                formData.append($(this).attr('name'), $(this).val());
            });
            
            $.ajax({
                url: FRONTAJAX,
                type: "POST",
                data: formData,
                async: false,
                contentType: false,
                cache: false,
                processData:false,
                success: function (response) {

                    if(isScroll){
                        if (response.valid) {
                            $(".filter-data").append(response.filterData);
                            $(".items-count").text(parseInt($('.product-item').length)+' ITEM(S)');
                        }else{
                            isNoProductRemains++;
                        }                    
                    }else{
                        $('.filter-data').html(response.filterData);
                        $(".items-count").text(parseInt($('.product-item').length)+' ITEM(S)');
                    }
                    if (!response.valid)
                        $(document).find('.loader-box').remove();

                },
                error : function(d) {
                    $(document).find('.loader-box').remove();

                },
                beforeSend: function(){
                },
                complete: function(){
                    removeLoader()
                },

            });

        }
        function addLoader(){
            $( ".filter-data" ).after(function() {
                return '<button class="loader-box btn btn-primary" type="button" disabled> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading... </button>';
            });
        }
        function removeLoader(){
            // if(parseInt($('.filterCount').text()) == parseInt($('.filter-data li').length))
                $(document).find('.loader-box').remove();
        }
        addLoader();

        // $(document).find(".product-item").hover(
        //     function () {
        //         $(this).find(".prd-img").fadeIn();
        //     },
        //     function () {
        //         $("#colorImageID").fadeOut();
        //     });

        $(document).on("mouseover", ".prd-inside",function(){
            event.stopPropagation();
            if(parseInt($(this).find('img').attr('hovered')) == 0 && $(this).find('img').attr('srcalt') != ''){
                    var old_src=$(this).find('img').attr("srcset");
                    var new_src=$(this).find('img').attr("srcalt");
                    $(this).find('img').attr('srcset',new_src);
                    $(this).find('img').attr('srcalt',old_src);
                    $(this).find('img').attr('hovered', 1);
                    var obj = $(this);
                    setTimeout(function(){ 

                    if(parseInt(obj.find('img').attr('hovered')) == 1 && obj.find('img').attr('srcalt') != ''){
                        var old_src=obj.find('img').attr("srcset");
                        var new_src=obj.find('img').attr("srcalt");
                        obj.find('img').attr('srcset',old_src);
                        obj.find('img').attr('srcalt',new_src);
                        obj.find('img').attr('hovered', 0);
                    
                    }

                    }, 1000);
                    
            }
            
        });
        // $(document).on("mouseout", ".prd-inside",function(){
        //     event.stopPropagation();
        //     if(parseInt($(this).find('img').attr('hovered')) == 1 && $(this).find('img').attr('srcalt') != ''){
        //             var old_src=$(this).find('img').attr("srcset");
        //             var new_src=$(this).find('img').attr("srcalt");
        //             $(this).find('img').attr('srcset',old_src);
        //             $(this).find('img').attr('srcalt',new_src);
        //             $(this).find('img').attr('hovered', 0);
                    
        //     }
            
        // });


   </script>


	</body>

</html>




