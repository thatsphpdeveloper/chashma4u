<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <style type="text/css">
        .note-toolbar-wrapper{
          min-height: 50px !important;
        }
      </style>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">              
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Attribute Option List</h4>  
                    <button type="button" class="btn btn-success btn-fw pull-right addNewAttributeOption">Add New</button>
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Attribute Name</th>
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
        <!-- partial:partials/_footer.html -->
        <!-- Model Content -->
        <div id="addTabModel" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New</h4>
              </div>
              <div class="modal-body">
                 <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateAttributeOption(this, event);">
                    <p class="msg"></p>
                    <div class="form-group col-lg-12">
                      <label for="attributeName">Attribute Name</label>
                      <select name="attributeName" class="form-control firstinput" id="attributeName" required>
                        <option value=""> Choose Attribute </option>
                        <?php echo @$attributeDropDown;?>
                      </select>
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="name">Attribute Option Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter attribute option name" required>
                    </div>
                    
                    <div class="form-group col-lg-12">
                      <input type="hidden" name="action" value="addAttributeOption">
                      <input type="hidden" name="hiddenval" value="">
                      <input type="hidden" name="indexval" value="">
                      <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                      <button class="btn btn-light" data-dismiss="modal" type="button" >Cancel</button>
                    </div>
                  </form>
              </div>
            </div>

          </div>
        </div>
        <!-- End Model Content -->
<?php $this->load->viewD('inc/footer.php'); ?>