<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../../index.php');
endif;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Enquiry | <?php include('../../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <style>
      .col-lg-3{
        margin:50px 0px;
      }
      
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
  <?php include "modals.php"; ?>
    <div class="wrapper">
      <?php include('../../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="<?php echo URLROOT;?>/pages/inventory/index.php">Back</a>
              <a class="btn btn-lg btn-info" href="newEnquiry.php">Make New Enquiry</a>
              <a class="btn btn-lg btn-success" href="request.php">View Purchase Requests</a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo URLROOT;?>/pages/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Enquiry</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	      
            
            <div class="col-xs-12">
              <div class="box box-primary">
    
                <div class="box-header">
                  <h3 class="box-title">Enquiry List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>             
                        <th>ENQUIRY ID</th>
                        <th>ORDER TYPE</th>
						<th>Parts</th>
            			<th>ENQUIRY DATE</th>
                  <th>Due DATE</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$sqle = "Select enquiry.enqid, enquiry.enquiry_date, COUNT(DISTINCT(enquiry.part_id)) AS nop, 
								 order_type.order_type from enquiry
								 LEFT JOIN order_type ON enquiry.order_type_id = order_type.order_type_id 
								 GROUP BY enquiry.enqid";	
						$query=mysqli_query($con,$sqle);
						while($row=mysqli_fetch_array($query)){
							
					?>
                      <tr>
                        <td><?php echo $row['enqid'];?></td>
                        <td><?php echo $row['order_type'];?></td>
						<td><?php echo $row['nop'];?></td>
            			<td><?php echo $row['enquiry_date'];?></td>
                  <td><?php echo 'Date Due Appears Here';?></td>

                        <td>
							<a id="btnview" name="btnview" data-id="<?php echo $row['enqid'];?>" class="btn btn-primary">View</a>	
						</td>
          </tr>
		  <?php }?>
                   
					  
                    </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="../js/enquiry.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
