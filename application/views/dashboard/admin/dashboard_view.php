<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <?=$this->common_lib->showSessMsg(); ?>
        <div class="content-wrapper">
          
          <?php $rolePermission = $this->common_lib->checkrolePermission(['can_manage_all_order','can_view_order'],0);
            if($rolePermission['valid']){ ?>
              <style type="text/css">
                #tableDataList{
                  margin: 0 auto;
                  width: 100%;
                  clear: both;
                  border-collapse: collapse;
                  table-layout: fixed;
                  word-wrap:break-word;
                }
                #tableDataList td, th{
                  word-break: break-all;
                  white-space: pre-line;
                }
              </style>
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">New Orders
                        <div class="template-demo pull-right">
                          <a href="javascript:" class="btn btn-primary hide" data-filter="New">New</a>
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
          <?php } ?>
          <div class="row filter-section">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
              <form class="form-inline" action="#" method="post" onsubmit="getDashboardfilterData(this, event)">
                <div class="form-group">
                    <label class="mr-2 mb-2">Choose Dates</label>
                    <input type="text" name="daterange"  class="form-control mb-2 mr-sm-2" id="reportrange">
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-primary mb-2 validate-form">Filter</button>
                  <input type="hidden" name="action" value="getDashboardfilterData">
                </div>
              </form>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Revenue</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><i class="fa fa-inr" aria-hidden="true"></i> <?= ($filterData->totalRevenue > 0)?round($filterData->totalRevenue,1):0 ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Our growth
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Orders</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= ($filterData->totalOrder > 0)?$filterData->totalOrder:0 ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> All Orders
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Delivered Orders</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= ($filterData->totalSuccess > 0)?$filterData->totalSuccess:0 ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Delivered Orders
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Failed Orders</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?= ($filterData->totalFailed  > 0)?$filterData->totalFailed:0 ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Cancelled orders
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
              <!--weather card-->
              <div class="card card-weather">
                <div class="card-body">
                  <div class="weather-date-location">
                    <h3><?=date('l')?></h3>
                    <p class="text-gray">
                      <span class="weather-date"><?=date('d M, Y')?></span>
                      <span class="weather-location">India</span>
                    </p>
                  </div>
                  <div class="weather-data d-flex">
                    <div class="mr-auto">
                      <h4 class="display-3">21
                        <span class="symbol">&deg;</span>C</h4>
                      <p>
                        Mostly Cloudy
                      </p>
                    </div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="d-flex weakly-weather">
                    <div class="weakly-weather-item">
                      <p class="mb-0">
                        Sun
                      </p>
                      <i class="mdi mdi-weather-cloudy"></i>
                      <p class="mb-0">
                        30°
                      </p>
                    </div>
                    <div class="weakly-weather-item">
                      <p class="mb-1">
                        Mon
                      </p>
                      <i class="mdi mdi-weather-hail"></i>
                      <p class="mb-0">
                        31°
                      </p>
                    </div>
                    <div class="weakly-weather-item">
                      <p class="mb-1">
                        Tue
                      </p>
                      <i class="mdi mdi-weather-partlycloudy"></i>
                      <p class="mb-0">
                        28°
                      </p>
                    </div>
                    <div class="weakly-weather-item">
                      <p class="mb-1">
                        Wed
                      </p>
                      <i class="mdi mdi-weather-pouring"></i>
                      <p class="mb-0">
                        30°
                      </p>
                    </div>
                    <div class="weakly-weather-item">
                      <p class="mb-1">
                        Thu
                      </p>
                      <i class="mdi mdi-weather-pouring"></i>
                      <p class="mb-0">
                        29°
                      </p>
                    </div>
                    <div class="weakly-weather-item">
                      <p class="mb-1">
                        Fri
                      </p>
                      <i class="mdi mdi-weather-snowy-rainy"></i>
                      <p class="mb-0">
                        31°
                      </p>
                    </div>
                    <div class="weakly-weather-item">
                      <p class="mb-1">
                        Sat
                      </p>
                      <i class="mdi mdi-weather-snowy"></i>
                      <p class="mb-0">
                        32°
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <!--weather card ends-->
            </div>
            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 class="card-title text-primary mb-5">Performance History</h2>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Current year performance</p>
                      <p class="display-3 mb-4 font-weight-light"><i class="fa fa-inr" aria-hidden="true"></i> <?= @($statisticsData->currentYearOrderRevenue != '')?round($statisticsData->currentYearOrderRevenue,1):0 ?></p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted"><?=date("Y")?></small>
                    </div>
                  </div>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Last year performance</p>
                      <p class="display-3 mb-5 font-weight-light"><i class="fa fa-inr" aria-hidden="true"></i> <?= @($statisticsData->LastYearOrderRevenue != '')?round($statisticsData->LastYearOrderRevenue,1):0 ?></p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted"><?=date("Y",strtotime("last year December 31st"))?></small>
                    </div>
                  </div>
                  <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Sales</p>
                      <p class="mb-2 text-primary">88%</p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 88%" aria-valuenow="88"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="wrapper mt-4">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Visits</p>
                      <p class="mb-2 text-success">56%</p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 56%" aria-valuenow="56"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if(isset($chartData) && !empty($chartData)){}  ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row d-none d-sm-flex mb-4">
                    <div class="col-4">
                      <h5 class="text-primary">Unique Visitors</h5>
                      <p>34657</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Bounce Rate</h5>
                      <p>45673</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Active session</h5>
                      <p>45673</p>
                    </div>
                  </div>
                  <div class="chart-container">
                    <canvas id="dashboard-area-chart" height="80"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
<script src="<?php echo base_url(); ?>system/static/dashboard/admin/vendors/js/vendor.bundle.addons.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<?php if(isset($chartData) && !empty($chartData)){}  ?>
<script type="text/javascript">
  var orderYears = [];
  var orderDelivedred = [];
  var orderCancelled = [];
  var chartData = <?=json_encode((isset($chartData) && !empty($chartData))?$chartData:array());?>;
  $.each(chartData, function(k, v){
    orderYears.push(k);
    orderDelivedred.push(v.totalDelivered);
    orderCancelled.push(v.totalCanceled);
  });
  (function ($) {
    'use strict';
    $(function () {
      if ($('#dashboard-area-chart').length) {
        var lineChartCanvas = $("#dashboard-area-chart").get(0).getContext("2d");
        var data = {
          labels: orderYears,//["2013", "2014", "2014", "2015", "2016", "2017"],
          datasets: [
            {
              label: 'Cancelled',
              data: orderCancelled,//[0, 7, 11, 8, 11, 0],
              backgroundColor: 'rgb(255, 179, 179)',
              borderWidth: 1,
              fill: true
            },{
              label: 'Delivered',
              data: orderDelivedred,//[0, 11, 6, 10, 8, 0],
              backgroundColor: 'rgba(0, 128, 207, 0.4)',
              borderWidth: 1,
              fill: true
            }
          ]
        };
        var options = {
          responsive: true,
          maintainAspectRatio: true,
          scales: {
            yAxes: [{
              display: false
            }],
            xAxes: [{
              display: false,
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 3
            }
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          stepsize: 1
        };
        var lineChart = new Chart(lineChartCanvas, {
          type: 'line',
          data: data,
          options: options
        });
      }
    });
  })(jQuery);
</script>

<script type="text/javascript">
  $(document).ready(function(){
    orderHistory();
  })


</script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(0, 'days');
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
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>
