

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="footer-section">



				<?php 
					if (isset($frontFooterData->value) && !empty($frontFooterData->value))
					    $frontFooterData = (object) unserialize($frontFooterData->value);


				?>



				<?php if (isset($frontFooterData->column_1_title) && !empty($frontFooterData->column_1_title)) { ?>

					<div class="footer-sub-section">
						<h3><?=$frontFooterData->column_1_title?></h3>	
						<?=$frontFooterData->column_1_description?>
					</div>

				<?php } ?>

				<?php if (isset($frontFooterData->column_2_title) && !empty($frontFooterData->column_2_title)) { ?>

					<div class="footer-sub-section">
						<h3><?=$frontFooterData->column_2_title?></h3>	
						<?=$frontFooterData->column_2_description?>
					</div>

				<?php } ?>

				<?php if (isset($frontFooterData->column_3_title) && !empty($frontFooterData->column_3_title)) { ?>

					<div class="footer-sub-section">
						<h3><?=$frontFooterData->column_3_title?></h3>	
						<?=$frontFooterData->column_3_description?>
					</div>

				<?php } ?>

				<?php if (isset($frontFooterData->column_4_title) && !empty($frontFooterData->column_4_title)) { ?>

					<div class="footer-sub-section">
						<h3><?=$frontFooterData->column_4_title?></h3>	
						<?=$frontFooterData->column_4_description?>
					</div>

				<?php } ?>

				<?php if (isset($frontFooterData->column_5_title) && !empty($frontFooterData->column_5_title)) { ?>
					<div class="footer-sub-section contact-section">
						<div class="contact-detail">
							<h3><?=$frontFooterData->column_5_title?></h3>	
							<?=$frontFooterData->column_5_description?>
						</div>

						<?php if (isset($frontFooterData->social_icon_ids) && !empty($frontFooterData->social_icon_ids)) { 

							$socialIconData = $this->Common_model->exequery("SELECT  * FROM ".tablePrefix."front_page_social_icons  WHERE status = 0 AND FIND_IN_SET(socialId, '".$frontFooterData->social_icon_ids."')");
							if ($socialIconData) { ?>

								<div class="connect-social">
									<h3><?=(isset($frontFooterData->social_title))?$frontFooterData->social_title:''?></h3>
									<ul>		
										
										<?php  foreach ($socialIconData as $icon) {
											echo '<li><a href="'.$icon->btnUrl.'"><img src="'.UPLOADPATH.'/social_images/'.$icon->img.'" alt=""></a></li>';
										} ?>	
											
										
									</ul>
								</div>
							<?php } ?>
						<?php } ?>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
</div>

