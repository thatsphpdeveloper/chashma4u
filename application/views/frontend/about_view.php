<?php $this->load->viewF('inc/header.php'); ?>

		
		<!--============= terms condition Section ================-->
		<div class="profile-page">
			<!--===== page Navigate =======-->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="page-navigate">
							<ul>
								<li><a href="<?=BASEURL?>">Home</a></li>
								<li>></li>
								<li><a href="javascript:" class="active">About us</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--===== End page Navigate =======-->
			<div class="container-fluid">
				<div class="terms-condition">
					<div class="row">
						<div class="col-md-12">
							<?=isset($termsPageSettingData->value) ? $termsPageSettingData->value:'';?>
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
