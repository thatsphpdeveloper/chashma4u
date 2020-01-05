		<?php $this->load->viewF('inc/header.php'); ?>	
		<style type="text/css">

			.error-page { 
				background-color: #aa2f2f;
				color: #fff;
				font-size: 100%;
				line-height: 1.5;
				font-family: "Roboto", sans-serif;
				padding: 100px 0;
				display: flex;
				align-items: center;
				justify-content: center;
				flex-direction: column;
			}

			.error-page .button {
				font-weight: 300;
				color: #fff;
				font-size: 1.2em;
				text-decoration: none;
				border: 1px solid #efefef;
				padding: .5em;
				border-radius: 3px;
				transition: all .3s linear;
			}

			.error-page .button:hover {
				background-color: #f78900;
				color: #fff;
				border-color: #f78900;
			}

			.error-page p {
				font-size: 2em;
				font-weight: 100;
				margin-bottom: 40px;
			}

			.error-page h1 {
				font-size: 12em;
				font-weight: 200;
				text-shadow: #651212 2px 6px 10px;
				font-family: 'Rochester', cursive;
			}

		</style>

		<div class="error-page">
			<h1>404</h1>
			<p>Oops! Something is wrong.</p>
			<a class="button" href="<?=BASEURL?>"><i class="icon-home"></i> Go back in initial page, is better.</a>
		</div>
		<?php $this->load->viewF('inc/footer.php'); ?>

	</body>
</html>