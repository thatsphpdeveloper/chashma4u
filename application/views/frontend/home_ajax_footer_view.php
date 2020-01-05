
<?php 
	if (isset($frontPageSettingData->value) && !empty($frontPageSettingData->value))
	    $frontPage = (object) unserialize($frontPageSettingData->value);


?>
<?php if (isset($frontPage->footer_description) && !empty($frontPage->footer_description)) { ?>

	<section class="faq-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?=$frontPage->footer_description?>
				
				</div>
			</div>
		</div>
	</section>

<?php } ?>