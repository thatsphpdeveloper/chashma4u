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
                    <h4 class="card-title">Zone List <button type="button" class="btn btn-primary pull-right csvModalBtn ml-1 hide" data-toggle="modal" data-target="#csvFormModal">Upload By CSV</button> <button type="button" class="btn btn-success pull-right newFormModalBtn" data-toggle="modal" data-target="#newFormModal">Add New</button></h4>                    
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Zone Name</th>
                            <th>Is Popular</th>
                            <th>Total pincode</th>
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
        <!-- zone modal start -->
        <div class="modal fade" id="newFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Zone</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateZone(this, event);">
                        <p class="msg"></p>
                        <div class="form-group">
                          <label for="zoneName">Zone Name</label>
                          <input type="text" class="form-control firstinput" id="zoneName" name="zoneName" placeholder="Enter zone name" required>
                        </div>
                        <div class="form-group">
                          <label for="slugName">Zone Slug</label>
                          <input type="text" class="form-control firstinput" id="slugName" name="slugName" placeholder="Enter zone slug name">
                        </div>
                        <div class="form-group">
                          <label for="lastDeliveryTime">Last Order Accepting time</label>
                          <select class="form-control timePicker" name="lastDeliveryTime" id="lastDeliveryTime" required>
                            <option value="">Select Last Delivery Time</option>
                            <?php for($i = 0; $i < 24; $i++): ?>
                            <option value="<?=(($i < 10)?'0'.$i:$i).':00'; ?>"><?=(($i < 10)?'0'.$i:$i).':00'; ?></option>
                            <option value="<?=(($i < 10)?'0'.$i:$i).':30'; ?>"><?=(($i < 10)?'0'.$i:$i).':30'; ?></option>
                            <?php endfor ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="isPopular">isPopular</label>
                          <input type="checkbox" name="isPopular" id="isPopular" value="1"> 
                        </div>
                        <div class="form-group">
                          <label for="uploadIcons">Upload Icons <span class="text-muted">( Image should be 100*100 )</span></label>
                          <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)">
                          <div class="previewimg"></div> 
                        </div>
                        <input type="hidden" name="action" value="addZone">
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

        <!-- zone modal end -->
        <!-- zone modal start -->
        <div class="modal fade" id="csvFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Upload CSV Of</span> Zone</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <form  method="POST" role="form" enctype="multipart/form-data" onsubmit="addZoneCSV(this,event,'.btn');">
                  <div class="row">
                    <p class="col-md-12 msg"></p>
                    <div class="form-group">
                      <div class="col-sm-8">
                        <input type="file" class="form-control input-sm" id="csvfile" name="csvfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <input type="hidden" name="action" value="addZoneCSV" id="action">
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

        <!-- zone modal end -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
