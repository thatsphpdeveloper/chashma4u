<?php $this->load->viewF('inc/header.php'); ?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

   <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Set new password</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row justify-content-around">
                  <?php if(isset($status) && $status == 'notset'){ ?>
                    <div class="col-sm-6 col-md-4">

                        <div id="loginForm">
                            <h2 class="text-center">SET PASSWORD HERE</h2>
                            <div class="form-wrapper">
                                <p>Please enter a strong password here.</p>
                                <form class="form-horizontal" action="#" method="post">
                                    <div class="form-group">
                                      <input type="password" class="form-control" id="password" autocomplete="off" placeholder="Enter password" name="password" required="required">
                                    </div>
                                    <div class="form-group">
                                      <input type="password" class="form-control" id="confirmPassword" autocomplete="off" placeholder="Conform password" name="confirmPassword" required="required">
                                    </div><button type="button" class="btn validate-password">Sign in</button>

                                  <div class="form-group msg"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-divider"></div>
                    <div class="col-sm-6 col-md-4 mt-3 mt-sm-0">
                        <h2 class="text-center">WANT TO SIGN IN</h2>
                        <div class="form-wrapper">
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <a href="<?=BASEURL?>/login" class="btn">Sign here</a>
                        </div>
                    </div>
                  <?php } else if(isset($status) && $status == 'alreadyset'){ ?>
                      <div class="col-sm-12 text-center">
                        <h1 class="text-danger">Access Denied.</h1>
                        <a href="<?php echo BASEURL;?>/login" class="btn" >Back to Login</a>
                      </div>

                    <?php } else if(isset($status) && $status == 'notFound'){ ?>

                      <div class="col-sm-12 text-center">
                        <h1 class="text-danger">Access Denied.</h1>
                        <a href="<?php echo BASEURL;?>" class="btn">Back to Home</a>
                      </div>
                    <?php } else if(isset($status) && $status == 'passwordset'){ ?>

                      <div class="col-sm-12 text-center">
                        <h1 class="text-success" style="font-size: 24px;margin-top: 24px;">Congratulations! Your password set now.</h1>
                        <a href="<?php echo BASEURL;?>/login" class="btn">Back to Login</a>
                      </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
  <?php $this->load->viewF('inc/footer.php'); ?>

  </body>
</html>
