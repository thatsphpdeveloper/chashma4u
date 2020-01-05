<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    

      <style type="text/css">
        .mssg {
          background-color: #538e5a;
          color: #fff;
          padding: 6px 14px;
          width: 100%;
          font-size: 12pt;
          display: none;
        }
        #myProgress {
          width: 100%;
          background-color: #ddd;
          display: none;
        }

        #myBar {
          width: 10%;
          height: 30px;
          background-color: #4CAF50;
          text-align: center;
          line-height: 30px;
          color: white;
        }
      </style>
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"><?php echo (isset($getPincodeDetails) && !empty($getPincodeDetails)) ? 'Update' : 'Add New';?> Pincode <button type="button" class="btn btn-primary pull-right csvModalBtn ml-1 hide" data-toggle="modal" data-target="#csvFormModal">Upload By CSV</button> <a href="<?=DASHURL.'/'.$this->sessDashboard?>/zone/pincode" class="btn btn-success pull-right">Pincode List</a></h4>
                        
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validatePinCode(this, event);">
                          <p class="msg"></p>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="zoneName">Zone Name</label>
                              <select name="zoneName" class="form-control bindconditionGroup" id="zoneName" required>
                                <option value=""> Choose Zone </option>
                                <?php echo @$zoneDropDown;?>
                              </select>
                              <button type="button" class="btn btn-secondery btn-sm copyDeliveryInformation mt-1 ml-1" style="display: none;">Copy Delivery Information</button>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="pincode">PinCode</label>
                              <input type="text" class="form-control firstinput" id="pincode" value="<?php echo (isset($getPincodeDetails->pincode) && !empty($getPincodeDetails->pincode)) ? $getPincodeDetails->pincode : '';?>" name="pincode" placeholder="Enter pincode" onkeypress="return OnlyInteger()" maxlength="6" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="minCartValue">Min Cart value</label>
                              <input type="number" min="0" class="form-control firstinput" id="minCartValue" value="<?php echo (isset($getPincodeDetails->minCartValue) && !empty($getPincodeDetails->minCartValue)) ? $getPincodeDetails->minCartValue : '0';?>" name="minCartValue" placeholder="Enter minimum cart value" required>
                            </div>

                            <div class="form-group col-md-6">
                              <div class="form-group">
                                <div class="form-check form-check-flat">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="isCod" <?php echo (isset($getPincodeDetails->isCod) && !empty($getPincodeDetails->isCod)) ? 'checked' : '';?>> Is cash on delivery available ?
                                  <i class="input-helper"></i></label>
                                </div>
                                
                              </div>
                            </div>
                          </div>

                          <!-- <div class="clearfix"></div> -->
                          <div class="clearfix"></div>
                          <div class="card deliverySectionArea">
                            <div class="card-body">
                              <h4 class="card-title">Delivery Condition</h4>
                              
                              <?php if(isset($deliverySectionHtml) && !empty($deliverySectionHtml))
                                      echo $deliverySectionHtml;
                                else { ?>
                              <div class="deliverySection" data-counter="0">
                                <div class="form-group col-md-6">
                                  <label for="deliveryType">Delivery Type</label>
                                  <input type="text" class="form-control" id="deliveryType" placeholder="Delivery Type" name="deliveryType[0]" required>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="deliveryAmount">Delivery Amount</label>
                                  <input type="text" class="form-control" id="deliveryAmount" placeholder="Delivery Amount" onkeypress="return OnlyFloat()" name="deliveryAmount[0]" required>
                                </div>  
                                <div class="col-md-12 timeslotsSection">
                                  <div class="slotsItems">
                                    <div class="form-group col-md-3">
                                      <label for="startTime">Start Time</label>
                                      <input type="text" class="form-control timePicker"  placeholder="Start Time" name="startTime[0][0]" required>
                                    </div>
                                    <div class="form-group col-md-3">    
                                      <label for="endTime">End Time</label>
                                      <input type="text" class="form-control timePicker" name="endTime[0][0]" placeholder="End Time" required>                                      
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label for="numberOfDelivery">Number of Delivery</label>
                                      <input type="text" class="form-control" placeholder="Number of Delivery" name="numberOfDelivery[0][0]" onkeydown="OnlyNumericKey(event)" required>
                                    </div>
                                    <div class="form-group col-md-2">&nbsp;</div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <button type="button" class="btn btn-success addMoreSlots"><i class="fa fa-plus"></i> Add More</button>
                                </div>                            
                              </div>
                            <?php } ?>
                              <button type="button" class="btn btn-success addMoreDeliverySection"><i class="fa fa-plus"></i> Add More</button>
                            </div>
                          </div>
                          <input type="hidden" name="action" value="addPinCode">
                          <input type="hidden" name="hiddenval" value="<?php echo (isset($getPincodeDetails) && !empty($getPincodeDetails)) ? $getPincodeDetails->pincodeId : '';?>">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div> 
        </div>


        <!-- pincode modal start -->
        <div class="modal fade" id="csvFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Upload CSV Of</span> Pincode</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <form  method="POST" role="form" enctype="multipart/form-data" onsubmit="addPincodeCSV(this,event,'.btn');">
                  <div class="row">
                    <p class="col-md-12 msg"></p>
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input type="file" class="form-control input-sm" id="csvfile" name="csvfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <input type="hidden" name="action" value="addPincodeCSV" id="action">
                      </div>

                      <div class="col-sm-4">
                        <button class="btn btn-primary actionbtn" type="submit" style="padding: 11px;"><i class='fa fa-fw fa-lg fa-check-circle' ></i><span class="btntext">Upload</span></button>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div id="myProgress">
                        <div id="myBar">0%</div>
                      </div>
                    </div>
                  </div>
              </div>              
            </div>
          </div>
        </div>

        <!-- pincode modal end -->
        <script type="text/javascript">
          var deliveryCount = "<?php echo $countDelivery;?>";
          var pincodeCount = "<?php echo $countTimeSlots;?>";
        </script>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
