<!doctype html>
<html lang="en">
<head>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
	<title><?=isset($title)?$title:'Chashma4u'?></title>
	<meta name="description" content="<?=isset($description)?$description:'Chashma4u'?>">
	<meta name="keyword" content="<?=isset($keyword)?$keyword:'Chashma4u'?>">
	<meta name="author" content="<?=isset($author)?$author:'Chashma4u'?>">
	<!-- <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASEURL; ?>/favicon.ico"> -->

	    <link rel="preload" as="font" href="<?php echo FRONTSTATIC; ?>/fonts/icomoon/fonts/icomoon543e.ttf?x9i9xv" type="font/ttf" crossorigin="anonymous">
    <!-- Vendor CSS -->
    <link href="<?php echo FRONTSTATIC; ?>/js/plugins.css" rel="stylesheet"  type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?php echo FRONTSTATIC; ?>/css/style-light.css" rel="stylesheet">
     <link href="<?php echo FRONTSTATIC; ?>/css/style3.css" rel="stylesheet">
   <!-- <link href="<?php echo FRONTSTATIC; ?>/css/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css">-->
   <!--<link href="<?php echo FRONTSTATIC; ?>/css/dist/assets/owl.theme.green.min.css" rel="stylesheet" type="text/css">-->
   <!-- <link href="<?php echo FRONTSTATIC; ?>/css/dist/assets/owl.css" rel="stylesheet" type="text/css">-->
    <!-- owl -->

    <link href="<?php echo FRONTSTATIC; ?>/fonts/icomoon/icomoon.css" rel="stylesheet">
    <link href="<?php echo FRONTSTATIC; ?>/fonts/montserrat/style.css" rel="stylesheet">
    <link href="<?php echo FRONTSTATIC; ?>/fonts/open-sans/style.css" rel="stylesheet">

	
    <?php $this->load->viewD("inc/constants"); ?>
    <?php
	    $frontPageSettingData = $this->Common_model->exequery("SELECT * FROM ch_setting WHERE status = 0 AND name= 'front_page'",1);
		if (isset($frontPageSettingData->value) && !empty($frontPageSettingData->value))
		    $frontSettingData = (object) unserialize($frontPageSettingData->value);

		echo (isset($frontSettingData->header_script))?$frontSettingData->header_script:'';
		$this->session->set_userdata('footer_script', (isset($frontSettingData->footer_script))?$frontSettingData->footer_script:'');
    ?>
</head>
<body class="home-page is-dropdn-click has-slider">
    <div class="body-preloader">
        <div class="loader-wrap">
            <div class="dots">
                <img src="<?php echo FRONTSTATIC; ?>/images/loader.gif"  alt="">
                <!--<div class="dot one"></div>-->
                <!--<div class="dot two"></div>-->
                <!--<div class="dot three"></div>-->
            </div>
        </div>
    </div>

		<!-- start Header section -->
<header class="hdr global_width hdr_sticky hdr-mobile-style2 stick">
    <!-- Promo TopLine -->
    <!-- <div class="bgcolor " style="background: #ea6e11;" >
        <div class="promo-topline" data-expires="1" <?php  //echo (isset($frontSettingData->offer_slider) && !empty($frontSettingData->offer_slider))?'':'style="display: none;"'; ?>>
            <div class="container">
                <div class="promo-topline-item">
                	<?php  //echo (isset($frontSettingData->offer_slider))?''.$frontSettingData->offer_slider:'<b>GET 10% OFF YOUR FIRST ORDER WITH CODE <span style="color: #000">GOODWIN</span>&nbsp;<span class="hidden-xs">&nbsp;|&nbsp;&nbsp; FREE GROUND SHIPPING OVER ₹250</span></b>'; ?>
                	
                </div>
            </div><a href="#" class="promo-topline-close js-promo-topline-close"><i class="icon-cross"></i></a>
        </div>
    </div> -->
    <!-- /Promo TopLine -->
    <!-- Mobile Menu -->

    <?php
    // $menuHtml = "";
    // $mobileMenuHtml = "";
    // $menuData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."menu WHERE status ='0'");

    // if (!empty($menuData)) {
    //     foreach ($menuData as $menu) {
    //         $submenuData = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."submenu WHERE status = 0 AND menuId = '".$menu->menuId."' order by title asc");
    //         if (!empty($submenuData)) {

    //             $menuHtml .= '<li class="mmenu-item--simple"><a href="javascript:void(0)">'.$menu->title.' '.(($menu->isNew)?'':'').'</a>';
               
    //             $menuHtml .= '<div class="mmenu-submenu"><ul class="submenu-list">';
                
    //             $mobileMenuHtml .= '<li><a href="javascript:void(0)">'.$menu->title.' '.(($menu->isNew)?'':'').'</a><span class="arrow"></span><ul class="nav-level-2">';

    //             foreach ($submenuData as $submenu) {
    //                 $menuHtml .= '<li><a href="'.$submenu->url.'" title=""  class="icon_box">'.(($submenu->img)?'<img src="'.UPLOADPATH.'/menu_images/'.$submenu->img.'" class="submenu-img" alt="Menu">':'').' '.$submenu->title.' '.(($submenu->isNew)?'':'').'</a></li>';
    //                 $mobileMenuHtml .= '<li><a href="'.$submenu->url.'" title=""  class="icon_box">'.(($submenu->img)?'<img src="'.UPLOADPATH.'/menu_images/'.$submenu->img.'" class="submenu-img" alt="Menu">':'').' '.$submenu->title.' '.(($submenu->isNew)?'':'').'</a></li>';
                    
    //             }
    //             $menuHtml .= '</ul></div>';
    //             $mobileMenuHtml .= '</ul>';
    //         }else{
    //             $menuHtml .= '<li><a href="'.$menu->url.'">'.$menu->title.' '.(($menu->isNew)?'':'').'</a>';
    //             $mobileMenuHtml .= '<li><a href="'.$menu->url.'">'.$menu->title.' '.(($menu->isNew)?'':'').'</a>';
    //         }

    //         $menuHtml .= '</li>';
    //         // $mobileMenuHtml .= '</li>';
    //     }
    // }

    //, array('mobileMenuHtml'=>$mobileMenuHtml)
    ?>

    <?php $this->load->viewF('inc/mobile-header') ?>

    <!-- /Mobile Menu -->
    <div class="hdr-mobile show-mobile">
        <div class="hdr-content">
            <div class="container">
                <!-- Menu Toggle -->
                <div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
                <!-- /Menu Toggle -->
                <div class="logo-holder"><a href="<?php echo BASEURL; ?>" class="logo"><img src="<?php echo FRONTSTATIC; ?>/images/logo.png"  alt=""></a></div>
                <div class="hdr-mobile-right">
                    <div class="hdr-topline-right links-holder"></div>
                    <div class="minicart-holder"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="hdr-desktop hide-mobile">
        <div class="hdr-topline">
            <div class="container">
                <div class="row">
                   <!--  <div class="col hdr-topline-center">
                        <div class="custom-text"><span>FREE</span> STANDARD DELIVERY ON ORDERS OVER ₹ 150</div>
                        <div class="custom-text"><i class="icon icon-mobile"></i><b>8800 265 89 56</b></div>
                    </div> -->
                    <div class="col-auto hdr-topline-right links-holder">
                        <!-- Header Search -->
                        <div class="dropdn dropdn_search hide-mobile @@classes"><a href="#" class="dropdn-link"><i class="icon icon-search2"></i><span>Search</span></a>
                            <div class="dropdn-content">
                                <div class="container">
                                    <form action="<?=BASEURL.'/search'?>" class="search"><button type="submit" class="search-button"><i class="icon-search2"></i></button> <input type="text" class="search-input" placeholder="search keyword" name="search" value="<?=isset($_GET['search'])?$_GET['search']:''?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Header Search -->
                        <!-- Header Wishlist -->
                        <div class="dropdn dropdn_wishlist @@classes"><a href="<?=BASEURL?>/wishlist" class="dropdn-link">
                            <i class="icon icon-heart-1"></i><span>Wishlist</span></a></div>
                            <!-- /Header Wishlist -->
                            <!-- Header Account -->
                            <div class="dropdn dropdn_account @@classes"><a href="#" class="dropdn-link"><i class="icon icon-person"></i><span>My Account</span></a>
                                <div class="dropdn-content">
                                    <div class="container">
                                        <div class="dropdn-close">CLOSE</div>
                                        <ul>
                                            <li class="<?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'':'hide'?>"><a href="<?=BASEURL.'/user/profile';?>"><i class="icon icon-person-fill"></i><span>My Account</span><input type="hidden" name="userId" id="userId" value="<?=$this->session->userdata(PREFIX.'userRoleId')?>"></a></li>
                                            <li class="<?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'hide':''?>"><a href="<?php echo BASEURL.'/login?redirect='.current_url(); ?>"><i class="icon icon-lock"></i><span>Log In</span></a></li>
                                            <li class="<?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'hide':''?>"><a href="<?php echo BASEURL; ?>/login"><i class="icon icon-person-fill-add"></i><span>Register</span></a></li>
                                            <li><a href="<?php echo BASEURL; ?>/cart"><i class="icon icon-check-box"></i><span>Checkout</span></a></li>
                                            <li class="<?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'':'hide'?>"><a href="<?=BASEURL.'/home/logout';?>">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Header Account -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="hdr-content hide-mobile ">
                <div class="container">
                    <div class="row">
                        <div class="col-auto logo-holder"><a href="<?=BASEURL?>" class="logo"><img src="<?=FRONTSTATIC?>/images/logo.png"  alt=""></a></div>
                        <!--navigation-->
                        <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                        <div class="nav-holder">
                            <div class="hdr-nav">
                                <!--mmenu-->
                                <ul class="mmenu mmenu-js">
                            <?php //echo $menuHtml;?>
					         <li class="mmenu-item--simple"><a href="javascript:void(0)" title="">EYEGLASSES</a>
                                <div class="mmenu-submenu">
                                    <ul class="submenu-list">
                                        <li><a href="<?php echo BASEURL; ?>/men-eyeglasses" title=""  class="icon_box men" >Men EYEGLASSES</a></li>
                                        <li><a href="<?php echo BASEURL; ?>/women-eyeglasses" title="" class="icon_box women">Women EYEGLASSES</a></li>
                                        <li><a href="<?php echo BASEURL; ?>/kids-eyeglasses" title="" class="icon_box kid">Kids EYEGLASSES</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="mmenu-item--simple"><a href="javascript:void(0)" title="">Sunglasses</a>
                                <div class="mmenu-submenu">
                                    <ul class="submenu-list">
                                        <li><a href="<?php echo BASEURL; ?>/men-sunglasses" title=""  class="icon_box men" >Men Sunglasses</a></li>
                                        <li><a href="<?php echo BASEURL; ?>/women-sunglasses" title="" class="icon_box women">Women Sunglasses</a></li>
                                        <li><a href="<?php echo BASEURL; ?>/kids-sunglasses" title="" class="icon_box kid">Kids Sunglasses</a></li>
                                    </ul>
                                </div>
                            </li>
                          <li><a href="<?php echo BASEURL; ?>/sports-sunglasses">SPORTS SUNGLASSES </a></li>
                          <li><a href="<?php echo BASEURL; ?>/reading-eyewear">READING EYEGLASSES </a></li>
                    </ul>
                    <!--/mmenu-->
                </div>
            </div>
            <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
            <!--//navigation-->

			<?php 
			if (!$this->session->userdata(PREFIX.'cartItemsCount')) {
				$userIP = $this->common_lib->getUserIpAddr();
				$userId = ($this->session->userdata(PREFIX.'userRoleId'))?$this->session->userdata(PREFIX.'userRoleId'):0;
				$cond = ($userId>0)? " AND userId = '".$userId."' or (userId = 0 AND ip = '".$userIP."')":((!empty($userIP))? " AND ip = '".$userIP."'":'');
					if ($cond){
						$cartData = $this->Common_model->exequery("SELECT cartId, grandtotal, (SELECT sum(qty) FROM ch_cart_detail where cartId = ch_cart.cartId) as cartItemsCount FROM ".tablePrefix."cart WHERE status ='0' $cond", 1);
					}
				if (isset($cartData->cartId) && !empty($cartData->cartId)) {
                    $this->session->set_userdata(PREFIX.'cartId', $cartData->cartId);
					$this->session->set_userdata(PREFIX.'cartItemsCount',$cartData->cartItemsCount);
					$this->session->set_userdata(PREFIX.'cartGrandtotal',$cartData->grandtotal);
				}else{
					$this->session->set_userdata(PREFIX.'cartItemsCount',0);
					$this->session->set_userdata(PREFIX.'cartGrandtotal','0.00');
				}
			} 
			?>
            <div class="col-auto minicart-holder">
                <div class="minicart"><a href="<?php echo BASEURL; ?>/cart" class="minicart-link" onclick="window.location.href='<?php echo BASEURL; ?>/cart'"><i class="icon icon-handbag"></i> <span class="minicart-qty my-cart-item-count"><?=($this->session->userdata(PREFIX.'cartItemsCount'))?$this->session->userdata(PREFIX.'cartItemsCount'):'0'?></span> <span class="minicart-title">Shopping Cart</span> <span class="minicart-total my-cart-grand-total">₹<?=($this->session->userdata(PREFIX.'cartGrandtotal'))?$this->session->userdata(PREFIX.'cartGrandtotal'):'0.00'?></span></a>
                   <!--  <div class="minicart-drop">
                        <div class="container">
                            <div class="minicart-drop-close">CLOSE</div>
                            <div class="minicart-drop-content">
                                <h3>Recently added items:</h3>
                                <?php

                                // if($this->session->userdata(PREFIX.'cartId') > 0){
                                //     $cartDetailData = $this->Common_model->exequery("SELECT cd.*, pd.productName, pd.slug, pv.variableTitle, (SELECT imageName FROM ch_images  WHERE (CASE WHEN cd.variableId > 0 then imageId = pv.imageId  ELSE imageId = pd.featuredImageId end) ) as img FROM ch_cart_detail as cd left join ch_product as pd on pd.productId = cd.productId left join ch_product_variable as pv on pv.variableId = cd.variableId  WHERE cartId = '".$this->session->userdata(PREFIX.'cartId')."'");
                                // }
                                // if (isset($cartDetailData) && !empty($cartDetailData)) {
                                //     foreach ($cartDetailData as $key => $detail) {
                                //         $prescription_type = ($detail->prescription_type == 'single-vision')?'Single vision':(($detail->prescription_type == 'frame-only')?'Frame only':(($detail->prescription_type == 'zero-power')?'Zero power':(($detail->prescription_type == 'bifocal-progressive')?'Bifocal Progressive':$detail->prescription_type)));
                                //         echo '<div class="minicart-prd  my-cart-item-'.$detail->detailId.'"> <div class="minicart-prd-image"><a href="'.BASEURL.'/'.$detail->slug.'"><img src="'.FRONTSTATIC.'/images/products/product-placeholder.png" data-srcset="'.getResizedImg($detail->img,'345_270').'" class="lazyload" alt=""></a></div> <div class="minicart-prd-name"> <h5><a href="'.BASEURL.'/'.$detail->slug.'">'.$prescription_type.'</a></h5> <h2><a href="'.BASEURL.'/'.$detail->slug.'">'.$detail->productName.'</a></h2> </div> <div class="minicart-prd-qty"><span>qty:</span> <b>'.$detail->qty.'</b></div> <div class="minicart-prd-price"><span>price:</span> <b>₹ '.$detail->subtotal.'</b></div> <div class="minicart-prd-action"><a href="#" class="icon-heart js-label-wishlist"></a> <a href="'.BASEURL.'/'.$detail->slug.'?cdi='.$detail->detailId.'" class="icon-pencil"></a> <a href="#" class="icon-cross js-product-remove"></a></div> </div>';
                                //     }
                                // }else{
                                //     echo '<div class="minicart-prd">
                                //     No items in your cart.</div>';
                                // }

                                ?>

                                <div class="minicart-drop-total">
                                    <div class="float-right"><span class="minicart-drop-summa"><span>Cart Subtotal:</span> <b class="my-cart-grand-total">₹ <?php //echo($this->session->userdata(PREFIX.'cartGrandtotal'))?$this->session->userdata(PREFIX.'cartGrandtotal'):'0.00'?></b></span>
                                        <div class="minicart-drop-btns-wrap hide"><a href="<?php //echo BASEURL; ?>/cart/checkout" class="btn"><i class="icon-check-box"></i><span>checkout</span></a> <a href="<?php //echo BASEURL; ?>/cart" class="btn btn--alt"><i class="icon-handbag"></i><span>view cart</span></a></div>
                                    </div>
                                    <div class="float-left"><a href="<?php //echo BASEURL; ?>/cart" class="btn btn--alt"><i class="icon-handbag"></i><span>view cart</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="sticky-holder compensate-for-scrollbar">
    <div class="container">
        <div class="row"><a href="#" class="mobilemenu-toggle show-mobile"><i class="icon icon-menu"></i></a>
            <div class="col-auto logo-holder-s"><a href="<?php echo BASEURL; ?>" class="logo"><img src="<?php echo FRONTSTATIC; ?>/images/logo.png" alt=""></a></div>
            <!--navigation-->
            <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
            <div class="nav-holder-s"></div>
            <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
            <!--//navigation-->
            <div class="col-auto minicart-holder-s"></div>
        </div>
    </div>
</div>
</header>
		<!-- end header section -->
		<!--=======================navbarEnd=========================== -->