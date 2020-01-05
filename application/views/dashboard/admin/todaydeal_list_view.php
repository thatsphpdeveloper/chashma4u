<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
             
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Today Deal List <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/todaydeal" class="btn btn-success pull-right">Add New</a></h4>                    
                    <div class="table-responsive">
                      <table class="table table-striped" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Total Product</th>
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
<?php $this->load->viewD('inc/footer.php'); ?>