<?php $this->load->viewF('inc/header.php'); ?>	
	   <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="index.html">Home</a></li>
                    <li><span>Contact Us</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <!-- Page Title -->
                <div class="page-title text-center">
                    <div class="title">
                        <h1>Contact Us</h1>
                    </div>
                </div>
                <!-- /Page Title -->
                <div class="row vert-margin-double justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <h2>Contact us any time for any questions</h2>
                        <div class="contact-info">
                            <div class="contact-info-icon"><i class="icon-mobile"></i></div>
                            <div class="contact-info-title">CALL US:</div>
                            <div class="contact-info-text">9773910606</div>
                        </div>
                        <div class="contact-info">
                            <div class="contact-info-icon"><i class="icon-clock"></i></div>
                            <div class="contact-info-title">HOURS:</div>
                            <div class="contact-info-text">MON-SAT 10AM-8PM</div>
                        </div>
                        <div class="contact-info">
                            <div class="contact-info-icon"><i class="icon-mail"></i></div>
                            <div class="contact-info-title">E-MAIL:</div>
                            <div class="contact-info-text"><a href="mailto:SUPPORT@CHASHMA4U.COM"></a>SUPPORT@CHASHMA4U.COM</div>
                        </div>
                        <div class="contact-info">
                            <div class="contact-info-icon"><i class="icon-location"></i></div>
                            <div class="contact-info-title">ADDRESS:</div>
                            <div class="contact-info-text">DELHI, INDIA</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 offset-lg-1">
                        <h2 class="text-center">SIGN IN</h2>
                        <form data-toggle="validator" class="contact-form" onsubmit="sendEnquiry(this, event)">
                            <div class="form-confirm">
                                <div class="success-confirm text-center">Thanks! Your message has been sent.<br>We will get back to you soon!</div>
                                <div class="error-confirm text-center">Oops! There was an error submitting form.<br>Refresh and send again.</div>
                            </div>
                            <div class="form-group"><label class="text-dark"><span class="required">*</span>NAME</label> <input type="text" name="name" class="form-control" data-required-error="Please fill the field" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group"><label class="text-dark"><span class="required">*</span>EMAIL</label> <input type="text" name="email" class="form-control" data-error="Error, that email address is invalid" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group"><label class="text-dark"><span class="required">*</span>MESSAGE</label> <textarea class="form-control textarea--height-100" name="comment" data-required-error="Please fill the field" required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                            <button type="button" class="btn mt-1 validate-form">send message</button>
                            <input type="hidden" name="action" value="sendEnquiry" />
                            <div class="form-group  msg"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="holder fullwidth">
            <div class="container px-0">
                <div class="contact-map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2201.3258493677126!2d-74.01291322172017!3d40.70657451080482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sua!4v1492962272380"></iframe></div>
            </div>
        </div>
    </div>
		<?php $this->load->viewF('inc/footer.php'); ?>

	</body>
</html>