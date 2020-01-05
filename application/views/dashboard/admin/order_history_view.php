<?php $this->load->viewD('inc/header.php'); ?>  
    <?php $this->load->viewD('inc/sidebar.php'); ?>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style type="text/css">
      .badge-secondary {
        border: 1px solid #e5e5e5;
        color: #1b1919;
      }
      .badge-light {
        border: 1px solid #f3f5f6;
        color: #757575;
      }
      table{
        margin: 0 auto;
        width: 100%;
        clear: both;
        border-collapse: collapse;
        table-layout: fixed;
        word-wrap:break-word;
      }
      .table td, th{
        word-break: break-all;
        white-space: pre-line;
      }
      .mr-2, .template-demo > .btn, .template-demo > .btn-toolbar, .template-demo > .btn-group, .template-demo .dropdown, .mx-2 {
          margin-right: 0.1rem !important;
          margin-top: 0.1rem !important;
      }
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title">Orders <?=(isset($vendorData->vendorName))?'('.$vendorData->vendorName.')':''?> <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/visitors'?>" class="btn btn-warning pull-right ml-2 hide">Visitors</a> <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/new'?>" class="btn btn-info pull-right hide">Create New Order</a></div>
                  <div class="row">

                    <div class="col-lg-6">
                      <form class="form-inline" action="#" method="post">
                        <div class="form-group">
                            <label class="mr-2 mb-2">Choose Dates</label>
                            <input type="text" name="daterange"  class="form-control mb-2 mr-sm-2" id="reportrange">
                        </div>
                        <div class="form-group">
                          <button type="button" class="btn btn-primary btn-filter mb-2 mr-2">Filter</button>
                          <button type="button" class="btn btn-success mb-2" onclick="exportOrderCsv(this, event)">Export</button>
                          <input type="hidden" name="vendorId" id="vendorId" value="<?=(isset($vendorData->vendorId))?$vendorData->vendorId:0?>">
                          <a href="../../ORDERS.csv" download id="download_csv" class="hide">d</a>
                        </div>
                      </form>
                    </div>

                    <div class="col-lg-6 template-demo">
                      <a href="javascript:" class="btn btn-primary" data-filter="New">New (<?=isset($orderData->new)?$orderData->new:0?>)</a>
                      <a href="javascript:" class="btn btn-secondary" data-filter="Ongoing">Ongoing (<?=isset($orderData->ongoing)?$orderData->ongoing:0?>)</a> 
                      <a href="javascript:" class="btn btn-secondary" data-filter="Completed">Completed (<?=isset($orderData->completed)?$orderData->completed:0?>)</a> 
                      <a href="javascript:" class="btn btn-secondary" data-filter="History">All (<?=isset($orderData->total)?$orderData->total:0?>)</a> 
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-striped" id="tableDataList">
                      <thead>
                        <tr>
                              <th>Order ID.</th>
                              <th>User</th>
                              <th>City</th>
                              <th>Paid Amt</th>
                              <th>Order Status</th>
                              <th>Payment Status</th>
                              <th>Order Date</th>
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
<script type="text/javascript">
  $('.template-demo .btn').on('click', function(event) {
    $('.template-demo .btn').attr('class','btn btn-secondary');
    $(this).attr('class','btn btn-primary');
    $('#tableDataList').DataTable().destroy();
    orderHistory();
  });
  $('.btn-filter').on('click', function(event) {
    $('#tableDataList').DataTable().destroy();
    orderHistory();
  });

  $('#download_csv').click(function(e) {
    e.preventDefault();
    window.location.href = BASEURL+'/ORDERS.csv';
  });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
$(function() {

    var start = moment("2019-01-01");
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'All': [moment("2019-01-01"), moment()]
        }
    }, cb);

    cb(start, end);

});


</script>



