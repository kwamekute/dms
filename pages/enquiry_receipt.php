<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | <?php include('../dist/includes/title.php');?></title>
       <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="../plugins/daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../plugins/daterangepicker/daterangepicker.css" />
 
    <style type="text/css">
      h5,h6{
        text-align:center;
      }


      @media print {
          .btn-print {
            display:none !important;
          }
      }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  
  <!-- Full Width Column -->
  <div class="content-wrapper">
	<div class="container">

	  <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box-body">
			  <!-- Date range -->
			  <form method="post" action="transaction_add.php">			
                  <h5><b><?php echo "branch name";?></b> </h5>  
                  <h6><?php echo "branch address";?></h6>
                  <h6>Contact #: <?php echo "branch contact";?></h6>
                  <h6>Date <?php echo date("M d, Y");?> Time <?php echo date("h:i A");?></h6>
                  <hr>
                   <table class="table">
                    <thead>
                    <tr>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Supplier Name</th>
                      <th>Date Requested</th>
                    </tr> 
					</thead>
					<tbody>
					<?php
						include('../dist/includes/dbcon.php');

						$branch=$_SESSION['branch'];
						$query=mysqli_query($con,"Select temp_trans.temp_trans_id, temp_trans.qty, temp_trans.part_id, 
											temp_trans.order_type_id, temp_trans.date, parts.part_name, parts.part_no, order_type.order_type 
											from temp_trans  
											LEFT JOIN parts ON temp_trans.part_id = parts.part_id
											LEFT JOIN order_type ON temp_trans.order_type_id = order_type.order_type_id");
						  
						while($row=mysqli_fetch_array($query)){						
					?>
					<tr>
						<td><?php echo $row["part_no"]; ?></td>
						<td><?php echo $row["part_name"]; ?></td>
						<td><?php echo $row["qty"]; ?></td>
						<td><?php echo $_GET["sname"]; ?></td>
						<td><?php echo $row["date"]; ?></td>
					</tr> 
					<?php 
						}
					?>
					<tr>
						<th>Prepared by:</th>
						<th></th>
						<th></th>
						<th></th>
					 </tr> 
			</tbody>
			
		  </table>
		  
		</div><!-- /.box-body -->
		</div>  
		</form>	
		</div><!-- /.box-body -->
		<a class = "btn btn-success btn-print" href = "" id="btnprint" name="btnprint" ><i class ="glyphicon glyphicon-print"></i> Confirm / Print</a>
		<a class = "btn btn-primary btn-print" href = "inventory/enquiry_details.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Enquiry Details Page</a>
	  </div><!-- /.box -->
	</div><!-- /.col (right) -->
   
  </div><!-- /.row -->

	 
  </section><!-- /.content -->
</div><!-- /.container -->
</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->
	
	<script src="../dist/js/jquery.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="../plugins/iCheck/icheck.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script src="js/enquiry.js"></script>
  </body>
</html>
