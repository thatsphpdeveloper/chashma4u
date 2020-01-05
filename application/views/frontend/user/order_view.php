<?php $this->load->viewF("inc/header.php"); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="<?=BASEURL?>">Home</a></li>
                    <li><span>Order History</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside aside--left">
                        <?php $this->load->viewF("user/sidebar.php"); ?>
                    </div>
                    <div class="col-md-9 aside">
                        <h2>Order History</h2>
                        <div class="table-responsive" >
                            <table class="table table-bordered table-striped table-order-history" id="datatable-order">
                                <thead>
                                    <tr>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Action</th>
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
<!-- End View Profile Details Section -->
<?php $this->load->viewF("inc/footer.php"); ?>

    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        table = $('#datatable-order').DataTable( {
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "ajax": {
                "url": BASEURL+'/frontajax',
                "dataType": "json",
            "type": "POST",
              "data":{'action' : 'userOrderList' },
            },            
            "columns": [
                { "data": "generatedId" },
                { "data": "addedOn" },
                { "data": "status" },
                { "data": "grandTotal" },
                { "data": "orderId" }
            ],
            "order": [[4, 'desc']],
        });
      });

    </script>