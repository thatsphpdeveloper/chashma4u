 <!-- Start Footer -->
  <footer id="mu-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <div class="mu-footer-area">
           <div class="mu-footer-social">
            <a href="#"><span class="fa fa-facebook"></span></a>
            <a href="#"><span class="fa fa-twitter"></span></a>
            <a href="#"><span class="fa fa-google-plus"></span></a>
            <a href="#"><span class="fa fa-linkedin"></span></a>
            <a href="#"><span class="fa fa-youtube"></span></a>
          </div>
          <div class="mu-footer-copyright">
            <p>&copy; Copyright <a rel="nofollow" href="<?=BASEURL?>">Livrezon</a>. All right reserved.</p>
          </div>         
        </div>
      </div>
      </div>
    </div>
  </footer>
    <?php if(empty($this->session->userdata(PREFIX.'userAuthId'))){ ?>
      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#Login">Login</a></li>
                <li><a data-toggle="tab" href="#Signup">Signup</a></li>
              </ul>
            </div>
            <div class="modal-body">                
              <div class="tab-content">
                <div id="Login" class="tab-pane fade in active">                    
                  <form method="post" action="#" class="mu-contact-form" onsubmit="logincheck(this,event)">
                    <div class="form-group msg">
                    </div>
                    <div class="form-group">
                      <label for="subject">Phone/Email</label>
                      <input type="text" class="form-control" name="mobile" placeholder="Phone" required="">
                    </div>                      
                    <div class="form-group">
                      <label for="Password">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    </div>                                     
                    <button type="button" class="mu-send-btn validate-form">Login</button>
                    <input type="hidden" name="action" value="logincheck">
                  </form>
                </div>
                <div id="Signup" class="tab-pane fade">                      
                  <form method="post" action="#" class="mu-contact-form" onsubmit="registration(this,event)">
                    <div class="form-group msg">
                    </div>
                    <div class="form-group">
                      <label for="name">Your Name</label>
                      <input type="text" class="form-control" name="userName" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" name="email" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                      <label for="subject">Phone</label>
                      <input type="text" class="form-control" name="mobile" placeholder="Phone" onkeypress="return OnlyInteger()" required="">
                    </div>
                     <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
                    </div>
                     <div class="form-group">
                      <label for="confirmPassword">Confirm Password</label>
                      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required="">
                    </div>                                      
                    <input type="button" class="mu-send-btn validate-password" value="Signup">
                    <input type="hidden" name="action" value="registration">
                  </form>
                </div>                   
              </div>
            </div>               
          </div>
        </div>
      </div>
    <?php } ?>

  <!-- End Footer -->
  
  <!-- jQuery library -->
  <script src="<?=FRONTSTATIC;?>/js/jquery.min.js"></script>  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?=FRONTSTATIC;?>/js/bootstrap.js"></script>   
  <!-- Slick slider -->
  <script type="text/javascript" src="<?=FRONTSTATIC;?>/js/slick.js"></script>
  <!-- Gallery Lightbox -->
  <script type="text/javascript" src="<?=FRONTSTATIC;?>/js/jquery.magnific-popup.min.js"></script>
  <!-- Date Picker -->
  <script type="text/javascript" src="<?=FRONTSTATIC;?>/js/bootstrap-datepicker.js"></script> 
  <!-- Ajax contact form  -->
  <script type="text/javascript" src="<?=FRONTSTATIC;?>/js/app.js"></script>
  <!-- DateTime Picker -->
  <script src="<?=FRONTSTATIC;?>/js/moment-with-locales.js"></script>
  <script src="<?=FRONTSTATIC;?>/js/bootstrap-datetimepicker.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js'></script>
  <!-- Custom -->
  <script src="<?=FRONTSTATIC;?>/js/custom.js"></script> 
<div id="inactive-warning" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Session About To Timeout</h4>
      </div>
      <div class="modal-body">
        <p>
            You will be automatically logged out.<br />
        To remain logged in move your mouse over this window.</p>
        <h1 id="warning-timer">0</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  </body>
</html>