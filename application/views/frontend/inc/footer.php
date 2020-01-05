
    <footer class="page-footer footer-style-1 global_width">
        <div class="holder bgcolor bgcolor-1 mt-0">
            <div class="container">
                <div class="row shop-features-style3">
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">100% genuine Product</div>
                                <div class="text2">All items available are 100% expert-authenticated genuine.</div>
                            </div>
                        </a></div>
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="icon-arrow-left-circle"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">Easy Delivery & Returns</div>
                                <div class="text2">Information on our shipping and returns policy. They are friendly.</div>
                            </div>
                        </a></div>
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="icon-call"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">Cash on Delivery</div>
                                <div class="text2">Cash on delivery is the sale of goods by mail order where payment</div>
                            </div>
                        </a></div>
                </div>
            </div>
        </div>
        <div class="holder bgcolor bgcolor-2 py-3 py-md-5 mt-0 hide">
            <div class="container">
                <div class="subscribe-form subscribe-form--style1">
                    <form action="#">
                        <div class="form-inline">
                            <div class="subscribe-form-title">subscribe to newsletter:</div>
                            <div class="form-control-wrap"><input type="text" class="form-control" placeholder="Enter Your e-mail address"></div><button type="submit" class="btn-decor">subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-top container">
            <div class="row py-md-4">
                <div class="col-md-4 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Categories</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="<?=BASEURL?>/kids-eyeglasses">Kid </a></li>
                                <li><a href="<?=BASEURL?>/men-eyeglasses">Men</a></li>
                                <li><a href="<?=BASEURL?>/women-eyeglasses">Women </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Customer Service</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="<?=BASEURL?>/terms">Terms & Condition</a></li>
                                <!--<li><a href="<?=BASEURL?>/privacy-policy">Privacy Policy</a></li>-->
                                <li><a href="<?=BASEURL?>/contact">Contact Info</a></li>
                                <li class="<?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'hide':''?>"><a href="<?=BASEURL?>/login">Create Account</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>My Account</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="<?=BASEURL?>/user/profile">My Account</a></li>
                                <li><a href="<?=BASEURL?>/cart">View Cart</a></li>
                                <li><a href="<?=BASEURL?>/wishlist">My Wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>contact us</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul class="contact-list">
                                <li><i class="icon-phone"></i><span><span class="h6-style">Call Us:</span><span>9773910606</span></span></li>
                                <li><i class="icon-clock4"></i><span><span class="h6-style">Hours:</span><span>Mon-Sat 10am-8pm</span></span></li>
                                <li><i class="icon-mail-envelope1"></i><span><span class="h6-style">E-mail:</span><span><a href="mailto:support@chashma4u.com">support@chashma4u.com</a></span></span></li>
                                <li><i class="icon-location1"></i><span><span class="h6-style">Address:</span><span>Delhi, India</span></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom container">
            <div class="row lined py-2 py-md-3">
                <div class="col-md-6 col-lg-5 footer-copyright">
                    <p class="footer-copyright-text"><span>© Copyright</span> 2019 <a href="<?=BASEURL?>">chashma4u.com</a>. <span>All rights reserved.</span></p>
                </div>
                <div class="col-md-auto">
                    <div class="payment-icons1">
                    <img src="<?=FRONTSTATIC?>/images/payment/guaranteed.png" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-auto ml-lg-auto">
                    <ul class="social-list">
                        <li><a href="#" class="icon icon-facebook"></a></li>
                        <li><a href="#" class="icon icon-twitter"></a></li>
                        <li><a href="#" class="icon icon-google"></a></li>
                        <li><a href="#" class="icon icon-instagram"></a></li>
                        <li><a href="#" class="icon icon-youtube"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
		<!--========== city popup ========-->
		
		<a id="back_top_button" class="hang"></a>

		<!--======== end city popup section ==========-->

		<!--========== track order popup ========-->

		<div id="trackOrderModel" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-body">
						
						<div class="track-order">
							<h2>Track Order </h2>
							<div class="track-form">
							<form method="POST" action="<?=BASEURL.'/track_order'?>" name="track_order_form">
								<div class="form-group msg">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="orderId" placeholder="Order Number">
								</div>

								<div class="form-group">
									-- OR --
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="email" placeholder="Email Id">
								</div>
								<button type="button" class="button order-now-btn btn-track" onclick="trackOrderCheck(this, event)">Track Now</button><button type="button" class="button order-now-btn" data-dismiss="modal">Cancel</button>
								</form>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

		<!--======== end track order popup section ==========-->

	</div>	
	<!--====== Script =======-->
	<script src="<?php echo FRONTSTATIC; ?>/js/plugins.js"></script>
    <script src="<?php echo FRONTSTATIC; ?>/js/app.js"></script>
    <script src="<?php echo FRONTSTATIC; ?>/js/custom.js"></script>



<script type="text/javascript" src="<?php echo FRONTSTATIC; ?>/css/dist/owl.carousel.js"></script>



<script>
            $(document).ready(function() {
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                items: 4,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 1000,
                autoplayHoverPause: true
              });
              $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [1000])
              })
              $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              })
            })
          </script>

	<!-- <script src="<?php echo FRONTSTATIC; ?>/js/custom.js"></script> -->
	<!--====== Script =======-->


	<script type="text/javascript">
		<?php  echo $this->session->userdata('footer_script') ?>
	</script>

