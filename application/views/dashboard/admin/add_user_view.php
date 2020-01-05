<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <style type="text/css">
        .previewimg img {
          border: 1px solid black;
          padding: 1px;
          margin: 3px;
        }
        .address_row1 {
            align-items: flex-end;
            margin-bottom: 25px;
            border-bottom: 1px solid #222;
            padding-bottom: 18px;
        }

        .address_row1:last-child {
            border-bottom: 0;
        }
      </style>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Add User <a href="<?=DASHURL.'/'.$this->sessDashboard?>/user/userlist" class="btn btn-success pull-right">User List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateUser(this, event);">
                          <p class="msg"></p>

                          <p class="card-description">Profile Info</p>
                          
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control firstinput" id="firstName" name="firstName" placeholder="Enter First name" value="<?=isset($userData->firstName)?$userData->firstName:'';?>" required>
                                </div>
                              </div>
                            
                            
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="lastName" name="lastName" placeholder="Enter last Name" value="<?=isset($userData->lastName)?$userData->lastName:'';?>" required>
                                </div>
                              </div>
                           
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email ID</label>
                                <div class="col-sm-9">
                                 <input type="text" class="form-control " id="email" name="email" placeholder="Enter email id" value="<?=isset($userData->email)?$userData->email:'';?>" required>
                                </div>
                              </div>
                            
                            
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="mobile" name="mobile" placeholder="Enter mobile" value="<?=isset($userData->mobile)?$userData->mobile:'';?>" onkeypress="return OnlyInteger()" maxlength="10" required>
                                </div>
                              </div>
                              

                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9">
                                  <select class="form-control Frenchise" name="gender" id="gender" required="required">
                                    <option value="">Select Gender</option>
                                    <option value="male" <?=isset($userData->gender)?(($userData->gender=='male')?'Selected':''):'';?>>Male</option>
                                    <option value="female" <?=isset($userData->gender)?(($userData->gender=='female')?'Selected':''):'';?>>Female</option>
                                    <option value="other" <?=isset($userData->gender)?(($userData->gender=='other')?'Selected':''):'';?>>Other</option>
                                  </select>
                                </div>
                              </div>
                              
                              <div class="clearfix"></div>
                          <div class="card deliverySectionArea">
                            <div class="card-body">
                              <h4 class="card-title">Address</h4>
                              <?php if(isset($addressSectionHtml) && !empty($addressSectionHtml))
                                      echo $addressSectionHtml;
                                else { ?>
                              <div class="AddressSection address_row1 row" data-counter="0">
                                <div class="form-group col-md-6">
                                  <label for="addressType">Address Type</label>
                                  <input type="text" class="form-control" id="addressType" placeholder="Adress Type" name="addressType[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="address">Address</label>
                                  <input type="text" class="form-control" id="address" placeholder="Delivery Address" name="address[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="address">Address2</label>
                                  <input type="text" class="form-control" id="addresss" placeholder="Delivery Address2" name="addresss[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="city">City</label>
                                  <input type="text" class="form-control" id="city" placeholder="Delivery City" name="city[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="state">State</label>
                                  <input type="text" class="form-control" id="state" placeholder="Delivery State" name="state[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="country">Country</label>
                                  <input type="text" class="form-control" id="country" placeholder="Delivery Country" name="country[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="pincode">Pincode</label>
                                  <input type="text" class="form-control" id="pincode" placeholder="Delivery Pincode" name="pincode[0]" onkeypress="return OnlyInteger()" maxlength="6" required>
                                </div>  
                                                            
                              </div>
                            <?php } ?>
                              <button type="button" class="btn btn-success addMoreAddressSection"><i class="fa fa-plus"></i> Add More</button>
                            </div>
                          </div>

                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Image</label>
                                <div class="col-sm-9">
                                  <input type="file" name="uploadImage" id="uploadImage" value="" onchange="fileuploadpreview(this)" <?=(isset($userData->image) && !empty($userData->image))?'':'required';?>>
                                  <div class="previewimg"><?=(isset($userData->image) && !empty($userData->image))?'<img src="'.$userData->image.'" width="70px" height="50px">':'';?></div>
                                </div>
                              </div>
                              <?php if(!$userData) {?>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                  <input type="password" class="form-control " id="password" name="password" placeholder="Enter password" value="" required>
                                </div>
                              </div>
                              <?php }?>      
                          <input type="hidden" name="action" value="addUser">
                          <input type="hidden" name="hiddenval" value="<?=isset($userData->userId)?$userData->userId:0;?>">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button type="button" class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div> 
        </div>


<?php $this->load->viewD('inc/footer.php'); ?>
<script type="text/javascript">
          var deliveryCount = "<?php echo $countDelivery;?>";
          
        </script>