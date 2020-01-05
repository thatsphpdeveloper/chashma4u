
        <div class="modal" id="address-model">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">



                    <!-- Modal Header -->

                    <div class="modal-header">

                        <h4 class="modal-title">Add New Address</h4>

                        <button type="button" class="close" data-dismiss="modal">×</button>

                    </div>



                    <!-- Modal body -->

                    <div class="modal-body">

                            

                        <form class="form-ad checkout-address-form" onsubmit="addUpdateAddress(this, event)" >

                            <div class="row">

                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>Reciever Name</label>

                                  <input type="text" class="form-control" name="name"  id="chk-name" value="" required>

                                </div>

                              </div>

                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>Reciever Mobile No.</label>

                                  <input type="text" class="form-control" name="mobile" maxlength="14" onkeypress="return OnlyInteger()" id="chk-mobile" value="" required>

                                </div>

                              </div>

                            </div>

                            <div class="row">


                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>Address</label>

                                  <input type="text" class="form-control" name="address" id="chk-address" value="" required>

                                </div>

                              </div>

                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>Landmark</label>

                                  <input type="text" class="form-control" name="address2" id="chk-address2" value="">

                                </div>

                              </div>

                            </div>



                            <div class="row">

                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>City</label>

                                  <input type="text" class="form-control" name="city" id="chk-city" value="" required>

                                </div>

                              </div>
                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>State</label>

                                  <input type="text" class="form-control" name="state" id="state" value="">

                                </div>

                              </div>

                            </div>

                            <div class="row">

                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>Country</label>

                                  <input type="text" class="form-control"  name="country" id="chk-country" value="" required>

                                </div>

                              </div>

                              <div class="col-md-6">

                                <div class="form-group">

                                  <label>Zipcode</label>

                                  <input type="text" class="form-control" name="pincode" id="chk-pincode" value="" required>

                                </div>

                              </div>

                              <div class="col-md-6">

                                <div class="form-group mt-2">
                                  <div class="clearfix"><input id="formCheckbox1" name="isDefault" type="checkbox" value="1"> <label for="formCheckbox1">Set address as default</label></div>

                                </div>

                              </div>

                            </div>

                            <div class="row">

                              <div class="col-md-12">

                                <div class="btn-section mt-2">

                                  <button type="button" class="btn btn-primary validate-form">Submit</button>

                                  <input type="hidden" name="action" value="addUpdateAddress">
                                  <input type="hidden" name="addressId" id="addressId" value="0">

                                </div>

                              </div>

                            </div>



                            <div class="row">

                                <div class="col-md-12 msg"></div>

                            </div>

                        </form>



                    </div>

                </div>

            </div>

        </div>