<?php $this->load->viewF('inc/header.php'); ?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

   <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Login</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-sm-6 col-md-4">
                        <div id="loginForm">
                            <h2 class="text-center">SIGN IN</h2>
                            <div class="form-wrapper">
                                <p>If you have an account with us, please log in.</p>
                                <form onsubmit="logincheck(this, event)">
                                    <div class="form-group">
                                    	<input type="email" class="form-control" placeholder="E-mail" name="email" required>
                                    	<input type="hidden" name="action" value="logincheck">
                                        <input type="hidden" name="redirectUrl" id="redirectUrl" value="<?=@$_REQUEST['redirect']?>">
                                        <input type="hidden" name="redirectType" id="redirectType" value="<?=@$_REQUEST['p']?>">
                                    </div>
                                    <div class="form-group">
										<input type="password" class="form-control" placeholder="Password" name="password" required>
									</div>
                                    <p class="text-uppercase"><a href="#" class="js-toggle-forms">Forgot Your Password?</a></p>
                                    <div class="clearfix"><input id="checkbox1" name="checkbox1" type="checkbox" checked="checked"> <label for="checkbox1">Remember me</label></div><button type="button" class="btn validate-form">Sign in</button>

                                	<div class="form-group msg"></div>
                                </form>
                            </div>
                        </div>
                        <div id="recoverPasswordForm" class="d-none">
                            <h2 class="text-center">RESET YOUR PASSWORD</h2>
                            <div class="form-wrapper">
                                <p>We will send you an email to reset your password.</p>
                                <form  onsubmit="forgotcheck(this, event)">
                                    <div class="form-group">
                                    	<input type="email" class="form-control" placeholder="E-mail" name="forgotemail" required>
                                    </div>
                                    <div class="btn-toolbar"><a href="#" class="btn btn--alt js-toggle-forms">Cancel</a> <button type="button" class="btn ml-1 validate-form">Submit</button>
									<input type="hidden" name="action" value="forgotpassword">
									</div>

                                	<div class="form-group msg"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-divider"></div>
                    <div class="col-sm-6 col-md-4 mt-3 mt-sm-0">
                        <h2 class="text-center">CREATE AN ACCOUNT</h2>
                        <div class="form-wrapper">
                            <p>To take advantage of our speedy checkout.</p>
                            <form onsubmit="registration(this, event)">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mt-0">
											<input type="text" class="form-control" name="firstName" placeholder="First name" required>
										</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mt-0">
                                        	<input type="text" class="form-control" placeholder="Last name" name="lastName" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<input type="email" class="form-control" placeholder="E-mail" name="email" required>
                                </div>
                                <div class="form-group">
                                	<input type="text" class="form-control" placeholder="Mobile Number" name="mobile" maxlength="12" minlength="6" onkeypress="return OnlyInteger()" required>
                                </div>
                                <div class="form-group">
                                	<input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                                </div>
                                <div class="form-group">
                                	<input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" required>
                                </div>
                                <div class="form-group">
									<div class="g-recaptcha" data-sitekey="6LdRna8UAAAAAMXHbHvx9DAZwCJW5iv79VEynVaC"></div>
                                </div>
                                <div class="clearfix"><input id="checkbox2" name="checkbox2" type="checkbox" checked="checked" required=""> <label for="checkbox2">By registering your details you agree to our Terms and Conditions and privacy and cookie policy</label></div>
                                <div class="text-center"><button type="button" class="btn validate-password">create an account</button>
									<input type="hidden" name="action" value="registration">
								</div>

                                <div class="form-group msg"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php $this->load->viewF('inc/footer.php'); ?>

	</body>
</html>
