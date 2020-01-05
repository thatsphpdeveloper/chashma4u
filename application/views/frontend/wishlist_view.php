<?php $this->load->viewF('inc/header.php'); ?>

    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
					<li><a href="<?=BASEURL?>">Home</a></li>
					<li><span>Wish Lists</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside aside--left">
                    	<?php $this->load->viewF('user/sidebar.php'); ?>
                    </div>
                    <div class="col-md-9 aside">
                        <h2>My Wishlist</h2>
                        <div class="cart-table cart-table--wishlist">


								<?php if (isset($productData) && !empty($productData)) {  ?>
								<?php foreach ($productData as $product) {?>
									<div class="cart-table-prd">
		                                <div class="cart-table-prd-image"><a href="<?=BASEURL.'/'.$product->slug;?>"><img src="<?=getResizedImg($product->img,'200_200');?>" alt="<?=$product->productName;?>"></a></div>
		                                <div class="cart-table-prd-name">
		                                    <h5><a href="<?=BASEURL.'/'.$product->slug;?>"><?=$product->brandName;?></a></h5>
		                                    <h2><a href="<?=BASEURL.'/'.$product->slug;?>"><?=$product->productName;?></a></h2>
		                                </div>
		                                <div class="cart-table-prd-price"><span>price:</span> <b>₹ <?=($product->actualPrice > $product->salePrice && $product->salePrice > 0)?$product->salePrice.' <del>₹'.$product->actualPrice.'</del>':$product->actualPrice;?></b></div>
		                                <div class="cart-table-addtocart"><a href="<?=BASEURL.'/'.$product->slug;?>" class="btn">Add To Cart</a> <a href="javascript:" onclick="removeWishlistItem(this, <?=$product->wishlistId; ?>)" class="icon-cross delete-from-wishlist" title="Remove from wishlist"></a></div>
		                            </div>
								<?php } ?>
								<?php }else{ 
										echo '<div class="wishlist-item"><span class="alert alert-danger" style="display: flex;">Sorry! No product available now.</span></div>';
									}

									?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<?php $this->load->viewF('inc/footer.php'); ?>

	</body>
</html>
