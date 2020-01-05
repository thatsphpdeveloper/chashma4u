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
      </style>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Add Vendor <a href="<?=DASHURL.'/'.$this->sessDashboard?>/vendor/vendorlist" class="btn btn-success pull-right">Vendor List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateVendor(this, event);">
                          <p class="msg"></p>

                          <p class="card-description">Profile Info</p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Vendor Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control firstinput" id="vendorName" name="vendorName" placeholder="Enter vendor name" value="<?=isset($vendorData->vendorName)?$vendorData->vendorName:'';?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Contact Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="contactName" name="contactName" placeholder="Enter contact persion name" value="<?=isset($vendorData->contactName)?$vendorData->contactName:'';?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email ID</label>
                                <div class="col-sm-9">
                                 <input type="text" class="form-control " id="email" name="email" placeholder="Enter email id" value="<?=isset($vendorData->email)?$vendorData->email:'';?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="mobile" name="mobile" placeholder="Enter mobile" value="<?=isset($vendorData->mobile)?$vendorData->mobile:'';?>" onkeypress="return OnlyInteger()" maxlength="10" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alternate Number</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="alternateNumber" name="alternateNumber" placeholder="Enter alternate number" value="<?=isset($vendorData->alternateNumber)?$vendorData->alternateNumber:'';?>" onkeypress="return OnlyInteger()" maxlength="10">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Image</label>
                                <div class="col-sm-9">
                                  <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)" <?=(isset($vendorData->img) && !empty($vendorData->img))?'':'required';?>>
                                  <div class="previewimg"><?=(isset($vendorData->img) && !empty($vendorData->img))?'<img src="'.$vendorData->img.'" width="70px" height="50px">':'';?></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="description" rows="3" name="description" placeholder="Enter description" required><?=isset($vendorData->description)?$vendorData->description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row" style="background: #ececec;border: 1px solid #bbb2b2;padding: 10px;margin: 1px; margin-bottom: 10px;">

                              <?php
                                  $days = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');
                                   $times = array('00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');
                              ?>

                              <div class="col-md-12">
                                <div class="form-group row">
                                  <label style="font-size: 20px; color: #313131;">Close Days</label>
                                  <div class="col-sm-12 day-name">
                                      <?php 
                                      $closeArry  = array();
                                      if(isset($vendorData->closeDays)){
                                          $closeArry = explode(',',$vendorData->closeDays);
                                      } 
                                      foreach ($days as $day) {
                                          $ischecked = (in_array($day,$closeArry))? "checked":'';
                                          echo '<div class="col-md-3 ">
                                                  <input id="closeDays'.$day.'" type="checkbox"  name="closeDays[]" class="closeDays" value="'.$day.'" '.$ischecked.' onchange="checkopenclosetiming(this,event)">
                                                  <label for="closeDays'.$day.'">'.ucwords($day).'</label>
                                              </div>';
                                      }
                                      ?>
                                  </div>
                                </div>
                                  
                              </div>

                              <label class="col-md-12" style="font-size: 20px; color: #313131;"><?=$this->lang->line('openCloseTiming')?></label>
                              <div class="col-md-12 open-close-day">
                                  <div class="col-md-6 form-group <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'monday') > -1)?'hide':''?>" >
                                      <label>Monday </label>

                                      <select class="form-control" name="mondayOpen" id="mondayOpen" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'monday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#mondayClose')">
                                          <option value="">Select Open Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->mondayOpen) && $vendorData->mondayOpen == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                      <select class="form-control" name="mondayClose" id="mondayClose" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'monday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#mondayOpen')">
                                          <option value="">Select Close Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->mondayClose) && $vendorData->mondayClose == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                  </div>
                                  <div class="col-md-6 form-group <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'tuesday') > -1)?'hide':''?>">
                                      <label>Tuesday</label>

                                      <select class="form-control" name="tuesdayOpen" id="tuesdayOpen" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'tuesday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#tuesdayClose')">
                                          <option value="">Select Open Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->tuesdayOpen) && $vendorData->tuesdayOpen == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                      <select class="form-control" name="tuesdayClose" id="tuesdayClose" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'tuesday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#tuesdayOpen')">
                                          <option value="">Select Close Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->tuesdayClose) && $vendorData->tuesdayClose == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                  </div>
                                  <div class="col-md-6 form-group <?= (isset($vendorData->closeDays) && strpos($vendorData->closeDays, 'wednesday') > -1)?'hide':''?>">
                                      <label>Wednesday </label>
                                      

                                      <select class="form-control" name="wednesdayOpen" id="wednesdayOpen" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'wednesday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#wednesdayClose')">
                                          <option value="">Select Open Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->wednesdayOpen) && $vendorData->wednesdayOpen == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                      <select class="form-control" name="wednesdayClose" id="wednesdayClose" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'wednesday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#wednesdayOpen')">
                                          <option value="">Select Close Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->wednesdayClose) && $vendorData->wednesdayClose == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                  </div>
                                  <div class="col-md-6 form-group <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'thursday') > -1)?'hide':''?>">
                                      <label>Thursday </label>
                                      

                                      <select class="form-control" name="thursdayOpen" id="thursdayOpen" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'thursday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#thursdayClose')">
                                          <option value="">Select Open Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->thursdayOpen) && $vendorData->thursdayOpen == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                      <select class="form-control" name="thursdayClose" id="thursdayClose" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'thursday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#thursdayOpen')">
                                          <option value="">Select Close Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->thursdayClose) && $vendorData->thursdayClose == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                  </div>
                                  <div class="col-md-6 form-group <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'friday') > -1)?'hide':''?>">
                                      <label>Friday </label>
                                      

                                      <select class="form-control" name="fridayOpen" id="fridayOpen" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'friday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#fridayClose')">
                                          <option value="">Select Open Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->fridayOpen) && $vendorData->fridayOpen == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                      <select class="form-control" name="fridayClose" id="fridayClose" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'friday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#fridayOpen')">
                                          <option value="">Select Close Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->fridayClose) && $vendorData->fridayClose == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                  </div>
                                  <div class="col-md-6 form-group <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'saturday') > -1)?'hide':''?>">
                                      <label>Saturday </label>
                                      

                                      <select class="form-control" name="saturdayOpen" id="saturdayOpen" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'saturday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#saturdayClose')">
                                          <option value="">Select Open Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->saturdayOpen) && $vendorData->saturdayOpen == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                      <select class="form-control" name="saturdayClose" id="saturdayClose" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'saturday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#saturdayOpen')">
                                          <option value="">Select Close Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->saturdayClose) && $vendorData->saturdayClose == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                  </div>
                                  <div class="col-md-6 form-group <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'sunday') > -1)?'hide':''?>">
                                      <label>Sunday </label>
                                      

                                      <select class="form-control" name="sundayOpen" id="sundayOpen" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'sunday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#sundayClose')">
                                          <option value="">Select Open Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->sundayOpen) && $vendorData->sundayOpen == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                      <select class="form-control" name="sundayClose" id="sundayClose" <?= (isset($vendorData->closeDays) &&strpos($vendorData->closeDays, 'sunday') > -1)?'':''?> style="width: 100%;" onchange="checkCloseTime(this,event,'#sundayOpen')">
                                          <option value="">Select Close Time</option>
                                          <?php   
                                              foreach($times as $time) { 
                                                      ?>
                                                  <option value="<?php echo $time?>" <?php echo (isset($vendorData->sundayClose) && $vendorData->sundayClose == $time) ? 'Selected' : ''; ?> ><?php echo $time;?></option>
                                            <?php }   ?>
                                      </select>
                                  </div>                    
                              </div>
                          </div>

                          <div class="clearfix"></div>
                          <div class="form-group deliverOnPincodes">
                              <label for="deliverOnPincodes">Deliver On Pincodes </label>
                              <input type="text" class="form-control tagPincodeInputs" id="deliverOnPincodes" value="<?=isset($vendorData->deliverOnPincodes)?$vendorData->deliverOnPincodes:'';?>" name="deliverOnPincodes" placeholder="Deliver On Pincodes" autocomplete="off" >
                          </div>

                          <p class="card-description">  Account Detail </p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Account Number</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="accountNumber" name="accountNumber" placeholder="Enter account number" value="<?=isset($vendorData->accountNumber)?$vendorData->accountNumber:'';?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">IFSC Code</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="ifscCode" name="ifscCode" placeholder="Enter IFSC code" value="<?=isset($vendorData->ifscCode)?$vendorData->ifscCode:'';?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Account Holder Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="accountHolderName" name="accountHolderName" placeholder="Enter account holder name" value="<?=isset($vendorData->accountHolderName)?$vendorData->accountHolderName:'';?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Food license No.</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="pincode" name="foodLicenseNo" placeholder="Enter food license number" value="<?=isset($vendorData->foodLicenseNo)?$vendorData->foodLicenseNo:'';?>" required>
                                </div>
                              </div>
                            </div>
                          </div>                          
                          <p class="card-description">  Address </p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address Line 1</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="address1" name="address1" placeholder="Enter address line 1" value="<?=isset($vendorData->address1)?$vendorData->address1:'';?>" required>
                                  <input type="hidden" name="latitude" id="latitude" value="<?php echo ((isset($vendorData->lat))?(!empty($vendorData->lat)?$vendorData->lat:'0'):'0'); ?>">
                                  <input type="hidden" name="longitude" id="longitude" value="<?php echo ((isset($vendorData->lang))?(!empty($vendorData->lang)?$vendorData->lang:'0'):'0'); ?>">
                                  <input type="hidden" name="formatted_address" id="formatted_address" value="">
                                  <input type="hidden" name="pre_latitude" id="pre_latitude" value="28.590083699999997">
                                  <input type="hidden" name="pre_longitude" id="pre_longitude" value="77.3352423">
                                  <input type="hidden" name="pre_formatted_address" id="pre_formatted_address" value="India Country">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address Line 2</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="address2" name="address2" placeholder="Enter address line 2" value="<?=isset($vendorData->address2)?$vendorData->address2:'';?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="city" name="city" placeholder="Enter city" value="<?=isset($vendorData->city)?$vendorData->city:'';?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="state" name="state" placeholder="Enter state" value="<?=isset($vendorData->state)?$vendorData->state:'';?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="country" name="country" placeholder="Enter country" value="<?=isset($vendorData->country)?$vendorData->country:'';?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pincode</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control " id="pincode" name="pincode" placeholder="Enter pincode" value="<?=isset($vendorData->pincode)?$vendorData->pincode:'';?>" onkeypress="return OnlyInteger()" maxlength="6" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <p class="card-description">SEO Details </p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Meta Title</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="metaTitle" name="metaTitle" value="<?=isset($vendorData->metaTitle)?$vendorData->metaTitle:'';?>" maxlength="65" placeholder="Enter meta title">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Meta Keywords</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="metaKeywords" name="metaKeywords" value="<?=isset($vendorData->metaKeywords)?$vendorData->metaKeywords:'';?>" placeholder="Enter meta title">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Meta Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control" id="metaDescription" rows="3" name="metaDescription" maxlength="150" placeholder="Meta Description"><?=isset($vendorData->metaDescription)?$vendorData->metaDescription:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>

                          <?php if(!isset($vendorData->vendorId)){ ?>

                          <p class="card-description">Authentication</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                  <input type="password" class="form-control" value="" placeholder="Password" id="password" name="password" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="isShownOnOurStores" <?=(isset($vendorData->isShownOnOurStores) && !empty($vendorData->isShownOnOurStores))?'checked':'';?>> Show on our stores page
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="action" value="addVendor">
                          <input type="hidden" name="hiddenval" value="<?=isset($vendorData->vendorId)?$vendorData->vendorId:0;?>">
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
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->


<!--         <div id="mappopup" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Location Marker</h4>
              </div>
              <div class="modal-body">
                <div id="mapCanvas"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default update-address">Update Address</button>
              </div>
            </div>
          </div>
        </div> -->


      <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Update Location Marker</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <div id="mapCanvas" style="min-height: 400px;"></div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-default update-address">Update Address</button>
            </div>
            
          </div>
        </div>
      </div>

<?php $this->load->viewD('inc/footer.php'); ?>

      <!-- Google Map Js -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAXJ-mvlpHWOPcISLr9UW21Ox7AgTpwEVk&sensor=false&libraries=geometry,places&ext=.js"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->

    <script type="text/javascript">
        var geocoder = new google.maps.Geocoder();
        var map;
        var marker;
        var latLng;
        function initialize() {
          latLng = new google.maps.LatLng($('body').find('#latitude').val(), $('body').find('#longitude').val());
          map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: 17,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          });
          marker = new google.maps.Marker({
            position: latLng,
            title: $('#formatted_address').val(),
            map: map
          });
          google.maps.event.addListener(map, 'click', function(event) {
          geocoder.geocode({
            'latLng': event.latLng
          }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              
              if (results[0]) {
                marker.setMap(null);
                marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        title: results[0].formatted_address,
                        map: map // the global map variable. Map has to be plotted before hand
                    });
                var formatted_address=results[0].formatted_address; 
                $('#pre_formatted_address').val(formatted_address);       
                $('#pre_latitude').val(results[0].geometry.location.lat);
                $('#pre_longitude').val(results[0].geometry.location.lng);
              }
            }
          });
          });
          
        }

        // Onload handler to fire off the app.
        google.maps.event.addDomListener(window, 'load', initialize);
                    
          /***************************** Bind Address Latitute and Longitude ********************************************/


          $(document).on('change','#address1, #state, #city, #country',function(){
            if($('#address1').val().trim() != '' && $('#state').val().trim() != '' && $('#city').val().trim() != '' && $('#country').val().trim() != '' ){
              $('#toggoleMapModal').trigger('click');
            }
          });
          $('#myModal').on('shown.bs.modal',function(){
            google.maps.event.trigger(map,'resize',{});
            latLng = new google.maps.LatLng($('body').find('#latitude').val(), $('body').find('#longitude').val());
            map.setCenter(latLng);
            marker.setMap(null);
            marker = new google.maps.Marker({
                position: latLng,
                title: $('#formatted_address').val(),
                map: map
            });
          });
          $('.update-address').click(function(){
            if($('#pre_latitude').val().trim() != '' && $('#pre_latitude').val().trim() !='' ){
              $('#latitude').val($('#pre_latitude').val());
              $('#longitude').val($('#pre_longitude').val());
              $('#myModal').modal('hide');
            }
          });

          
        function checkopenclosetiming(obj, e){

            var day = $(obj).val();
            if ($(obj).prop("checked")){
               
                // $('#'+day+'Open').removeAttr('required');
                // $('#'+day+'Close').removeAttr('required');
                $('#'+day+'Open').parent('div.form-group').addClass('hide');
            }else{
                // $('#'+day+'Open').attr('required');
                // $('#'+day+'Close').attr('required');
                $('#'+day+'Open').parent('div.form-group').removeClass('hide');

            }
          }
          function checkCloseTime(obj, e, obj1) {
            if($(obj).val() == $(obj1).val())
                $(obj1).find('option:selected').removeAttr("selected");
                
          }


          var deliverOnPincodes = <?=(isset($deliverOnPincodes) && !empty($deliverOnPincodes))? json_encode($deliverOnPincodes):json_encode(array());?>;
          $(document).ready(function() {
            if (deliverOnPincodes) {
              $.each(deliverOnPincodes, function(i, item) {
                $("#deliverOnPincodes").tagsinput('add', { "value": item.pincodeId , "text": item.pincode });
              });
            }
        });

    </script>
