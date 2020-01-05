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
                    <h4 class="card-title">Today Deal List 
                      <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/product/todaydeal/'.$todaydealData->todaydealId?>"  class="btn btn-success">Edit</a>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/todaydeal" class="btn btn-success pull-right">Add New</a>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/todaydeallist" class="btn btn-success pull-right">Today Deal List</a> 
                      </div>
                    </h4>                    
                    <div class="table-responsive">
                      <?php if (valResultSet($todaydealData)) {
                          ?>
                            <ul>
                              <li><h2><small>Date : </small><span style="font-size: 15px;"><?=$todaydealData->date?></span></h2></li>
                              <li><h2><small>Start Time : </small><span style="font-size: 15px;"><?=$todaydealData->startTime?></span></h2></li>
                              <li><h2><small>End Time : </small><span style="font-size: 15px;"><?=$todaydealData->endTime?></span></h2></li>
                              <li><h2><small>Status : </small><label style="font-size: 15px; margin-left: 5px;" class="<?=$todaydealData->class?>"><?=$todaydealData->status?></label></h2></li>
                              <li><h2><small>Products : </small><span></span></h2></li>
                            </ul>


                      <?php } ?>
                      <table class="table table-bordered" id="sampleTable">
                        <thead>
                          <tr>
                            <th style="text-align: left;">Products</th>
                            <th><?=$this->lang->line('price')?></th>
                            <th><?=$this->lang->line('discountedPrice')?></th>
                          </tr>
                        </thead>
                        <tbody class="tablebody">
                          <?php if (isset($productData) && !empty($productData)){
                            foreach ($productData as $product) {
                              echo '<tr><td style="text-align: left;">'.$product->productName.'</td><td>Rs '.$product->oldPrice.'</td><td>Rs '.$product->price.'</td></tr>';
                            }
                          } ?>
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