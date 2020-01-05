<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <style type="text/css">
        .previewimg img {
          border: 1px solid black;
          padding: 1px;
          margin: 3px;
        }
      </style>

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
<!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Lens List <button type="button" class="btn btn-success pull-right newFormModalBtn" data-toggle="modal" data-target="#newFormModal">Add New</button></h4>                    
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Lens Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
        </div>
        <!-- content-wrapper ends -->
        <!-- lens modal start -->
        <div class="modal fade" id="newFormModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Lens</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateLens(this, event);">
                        <p class="msg"></p>
                        <div class="form-group col-lg-12">
                          <label for="categoryId">Category Name</label>
                          <select name="categoryId" class="form-control" id="categoryId" required>
                            <option value=""> Choose Category </option>
                            <?php echo @$categoryDropDown;?>
                          </select>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="lensName">Lens Name</label>
                          <input type="text" class="form-control firstinput" id="lensName" name="lensName" placeholder="Enter lense name" required>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="lensIndex">Index</label>
                          <input type="number" class="form-control" id="lensIndex" name="lensIndex" placeholder="Enter index" value="0" required>
                        </div>
                        <div class="form-group col-lg-12">
                          <label for="antiReflectiveCoating"> Anti Reflective Coating</label>
                          <input type="text" class="form-control" id="antiReflectiveCoating" name="antiReflectiveCoating" placeholder="Enter anti reflective coating">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="actualPrice">Lens Price</label>
                          <input type="text" class="form-control" id="actualPrice" name="actualPrice" placeholder="Enter lens price" value="0" onkeydown="OnlyNumericKey(event)" required>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="salePrice">Lens Sale Price</label>
                          <input type="text" class="form-control" id="salePrice" name="salePrice" placeholder="Enter sale price" value="0" onkeydown="OnlyNumericKey(event)">
                        </div>

                          <div class="col-md-6 nopadding">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" id="scratchResistant" name="scratchResistant" value="1" > Scratch Resistant
                                <i class="input-helper"></i></label>
                              </div>
                          </div>

                          <div class="col-md-6 nopadding">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" id="waterDustRepellent" name="waterDustRepellent" value="1" > Water Dust Repellent
                                <i class="input-helper"></i></label>
                              </div>
                          </div>

                          <div class="col-md-6 nopadding mb-5">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" id="uv400Protection" name="uv400Protection" value="1" > UV 400 Protection
                                <i class="input-helper"></i></label>
                              </div>
                          </div>

                          <div class="col-md-6 nopadding mb-5">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" id="blueLightBlocker" name="blueLightBlocker" value="1" > Blue Light Blocker
                                <i class="input-helper"></i></label>
                              </div>
                          </div>

                        <input type="hidden" name="action" value="addLens">
                        <input type="hidden" name="hiddenval" value="">
                        <input type="hidden" name="indexval" value="">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                      </form>
                    </div>                  
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>

        <!-- lens modal end -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
