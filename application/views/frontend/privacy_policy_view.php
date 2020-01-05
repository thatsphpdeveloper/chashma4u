<?php $this->load->viewF('inc/header.php'); ?>

    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
					<li><a href="<?=BASEURL?>">Home</a></li>
					<li><a href="javascript:" class="active">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
			<!--===== End page Navigate =======-->
			<div class="container-fluid">
				<div class="privacy-policy">
					<div class="row">
						<div class="col-md-12">
							<?=isset($privacyPageSettingData->value) ? $privacyPageSettingData->value:'';?>
						</div>
					</div>
				</div>
			</div>
			<!--============ Terms and Condition =======-->
		</div>
		<!--============= terms condition Section ================-->

		<?php $this->load->viewF('inc/footer.php'); ?>

	</body>
</html>
