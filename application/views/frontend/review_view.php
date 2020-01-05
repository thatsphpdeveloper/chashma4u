<?php $this->load->viewF('inc/header.php'); ?>

	<!--========= Sub-banner section =========-->
		<div class="sub-banner franchise-banner">
			<h1>All Testimonials</h1>
		</div>
		<!--========= Sub-banner section =========-->

		<!-- inner wrapper -->
	<div class="testimonial-view-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
							<?php if (isset($reviewData) && !empty($reviewData)) { 
								foreach ($reviewData as $review) {

									echo '<div class="testimonials-details"><div class="client-detail"> <img src="'.$review->img.'" alt=""> <h3>'.$review->firstName.'</h3> <p class="designation">(Customer)</p> </div> <div class="review"> <p>'.$review->review.'</p> </div> </div> <div class="divider"></div>';
								} 
							}?>	
				            
				        </div>
					</div>
			
			</div>
		</div>
		



		<?php $this->load->viewF('inc/footer.php'); ?>
	
	</body>
</html>