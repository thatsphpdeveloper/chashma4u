<?php $this->load->viewF('inc/header.php'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<style type="text/css">

div#datatable-order_length {
    display: none;
}

div#datatable-order_filter {
    display: none;
}
thead {
    display: none;
}

td {
    padding: 0px !important;
}


table.dataTable tbody tr {
    background: unset;
}
div#datatable-order_paginate {
    margin-bottom: 10px;
}

div#datatable-order_info {
    display: none;
}
table.dataTable.no-footer {
    border-bottom: unset;
}

</style>
<!-- Profile Banner Section -->

    <!--============= Cart Section ================-->
    <div class="grey-background">
      <!--===== page Navigate =======-->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-navigate">
              <ul>
                <li><a href="<?=BASEURL;?>">Home</a></li>
                <li>></li>
                <li><a href="<?=BASEURL;?>/user/profile">My Profile</a></li>
                <li>></li>
                <li><a href="javascript:" class="active">Order History</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--===== End page Navigate =======-->

      <!--============= My order Section ================-->
      <div class="container-fluid">
        <div class="my-order-section">
          <table class="" id="datatable-order" style="width: 100% !important;">
            <thead>
              <tr>
                <th>Order</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <!--============= End My order Section ================-->

    </div>

    <div id="shareMomentModel" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <form method="POST" action="#" onsubmit="uploadSharedMoment(this, event)" enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Share Moment</h4>
            </div>
            <div class="modal-body">
              <div class="form-group msg">
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" required="" placeholder="Enter title for your moment">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" required="" placeholder="Enter description for your moment"></textarea>
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="uploadImg"  accept="image/*" required onchange="fileuploadpreview(this)">
                <div class="profile-img preview-img hide"><img src="<?=NOIMAGE?>" alt="User Image" class="thumbnail"></div>
                <input type="hidden" name="action" value="uploadSharedMoment">
                <input type="hidden" name="orderId" value="0">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary validate-form">Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>


          </form>
        </div>

      </div>
    </div>

<!-- End View Profile Details Section -->
<?php $this->load->viewF("inc/footer.php"); ?>

    <script type="text/javascript">

    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        table = $('#datatable-order').DataTable( {
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "ajax": {
                "url": FRONTAJAX,
                "dataType": "json",
            "type": "POST",
              "data":{'action' : 'userOrderList' },
            },            
            "columns": [
                { "data": "order" }
            ],
            'columnDefs': [{
              'targets': 0,
              'searchable':false,
              'orderable':false
            }],
            "order": [[0, 'desc']],
        });
      });

    </script>

