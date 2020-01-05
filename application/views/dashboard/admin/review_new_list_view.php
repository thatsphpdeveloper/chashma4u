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
                    <h4 class="card-title">New Review List <a href="<?=DASHURL.'/'.$this->sessDashboard?>/review/add" class="btn btn-info pull-right">Review List</a><a href="<?=DASHURL.'/'.$this->sessDashboard?>/review/add" class="btn btn-success pull-right">New Review</a></h4>                    
                    <div class="table-responsive">
                      <table class="table table-striped" id="tableDataList">
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>Product Name</th>
                            <th>Rating</th>
                            <th>Review</th>
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