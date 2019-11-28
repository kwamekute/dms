<?php 
error_reporting(1);
session_start();
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
    <title>Enquiry Details | <?php include('../../dist/includes/title.php');?></title>
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
    <script src="../../dist/js/jquery.min.js"></script>
    <script language="JavaScript"><!--
//--></script>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav" onload="myFunction()">
    <div class="wrapper">
      <?php include('../../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="newEnquiry.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Product</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Enquiry Details</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="../transaction_add.php">
				  <div class="row" style="min-height:400px">
					
					 <div class="col-md-4">
						  <div class="form-group">
							<label for="date">Part No.</label>
							 
								<select class="form-control select2" name="part_no" id="part_no" tabindex="1" autofocus required>
								<?php
								  $branch=$_SESSION['branch'];
								  $sid=$_REQUEST['sid'];
								  include('../dist/includes/dbcon.php');
									 $query2=mysqli_query($con,"select * from parts where branch_id='$branch' order by part_no")or die(mysqli_error());
									    while($row=mysqli_fetch_array($query2)){
								?>
										<option value="<?php echo $row['part_id'];?>"><?php echo 'No: '. $row['part_no'].' | '. $row['part_name']." Available(".$row['part_qty'].")";?></option>
								  <?php }?>
								</select>
						    <input type="hidden" class="form-control" name="cid" value="<?php echo $sid;?>" required>   
						  </div><!-- /.form group -->
					</div>
         <div class="col-md-2">
						  <div class="form-group">
							<label for="date">Order Type</label>
							 
								<select class="form-control select3" name="order_type" id="order_type" tabindex="" autofocus required>
							<?php
						  $branch=$_SESSION['branch'];
						  $sid=$_REQUEST['sid'];
										
								 $query3=mysqli_query($con,"select * from order_type where branch_id='$branch' order by order_type_id");
									while($row1=mysqli_fetch_array($query3)){
							?>
									<option value="<?php echo $row1['order_type_id'];?>"><?php echo $row1['order_type'];?></option>
							  <?php }?>
								</select>
						  </div>
					</div> 
					<div class=" col-md-2">
						<div class="form-group">
							<label for="date">Quantity</label>
							<div class="input-group">
							  <input type="number" class="form-control pull-right" id="qty" name="qty" placeholder="Quantity" tabindex="2" value="1"  required>
							</div><!-- /.input group -->
						</div><!-- /.form group -->
					 </div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="date"></label>
							<div class="input-group">
								<button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="addtocart">+</button>
							</div>
						</div>	
					</form>	
					</div>
					<div class="col-md-12">

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>
                        <th>img</th>
                        <th>Part No.</th>
                        <th>Part Name</th>
                        <th>Order Type</th>
                        <th>Date of Enq.</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					
					$query=mysqli_query($con,"Select temp_trans.temp_trans_id, temp_trans.qty, temp_trans.part_id, 
										temp_trans.order_type_id, temp_trans.date, parts.part_name, parts.part_no, order_type.order_type 
										from temp_trans  
										LEFT JOIN parts ON temp_trans.part_id = parts.part_id
										LEFT JOIN order_type ON temp_trans.order_type_id = order_type.order_type_id");
						$grand=0;
					while($row=mysqli_fetch_array($query)){
							$id=$row['temp_trans_id'];
					
					?>
                      <tr >
						<td><?php echo $row['qty'];?></td>
						<td></td>
						<td class="record"><?php echo $row['part_no'];?></td>
						<td class="record"><?php echo $row['part_name'];?></td>
						<td class="record"><?php echo $row['order_type'];?></td>
						<td class="record"><?php echo $row['date'];?></td>
						<td>
							<a href="#updateordinance<?php echo $row['temp_trans_id'];?>" data-target="#updateordinance<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
							<a href="#delete<?php echo $row['temp_trans_id'];?>" data-target="#delete<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
						  
						</td>
                      </tr>
					  <div id="updateordinance<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					  <div class="modal-dialog">
						<div class="modal-content" style="height:auto">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Update Sales Details</h4>
						  </div>
						  <div class="modal-body">
						  <form class="form-horizontal" method="post" action="../transaction_update.php" enctype='multipart/form-data'>
								<input type="hidden" class="form-control" name="cid" value="<?php echo $row['temp_trans_id'];?>">  	  
							<div class="form-group">
								<label class="control-label col-lg-3" for="price">Qty</label>
								<div class="col-lg-9">
								  <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $row['qty'];?>" required>  
								</div>
							</div>
							
						  </div><br>
						  <div class="modal-footer">
								<button type="submit" class="btn btn-primary">Save changes</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						 </form>
						</div>
							
					  </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->  
<div id="delete<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Item</h4>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="transaction_del.php" enctype='multipart/form-data'>
          <input type="hidden" class="form-control" name="cid" value="<?php echo "cid" ;?>" required>   
          <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
        <p>Are you sure you want to remove <?php echo $row['part_name'];?>?</p>
        
              </div><br>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->  
<?php }?>					  
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->

				</div>	
               
                  
                  

				</form>	

                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            <div class="col-md-2">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Preview Enq.</h3>
                </div>
                <div class="box-body">
                                                 
                  <div class="form-group">
                    <div class="input-group col-md-12">
                      <a href="../enquiry_receipt.php" class="btn btn-lg btn-primary pull-right" id="btnprint" name="">
						Print Preview
                      </a>
           
                    </div>
                  </div><!-- /.form group -->
      
        
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            

          </section><!-- /.content -->
        </div><!-- /.container -->
           
            
        
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
	<script>
  
    
      $("#cash").click(function(){
          $("#tendered").show('slow');
          $("#change").show('slow');
      });

    $(function() {

      $(".btn_delete").click(function(){
      var element = $(this);
      var id = element.attr("id");
      var dataString = 'id=' + id;
      if(confirm("Sure you want to delete this item?"))
      {
	$.ajax({
	type: "GET",
	url: "temp_trans_del.php",
	data: dataString,
	success: function(){
		
	      }
	  });
	  
	  $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
	  .animate({ opacity: "hide" }, "slow");
      }
      return false;
      });

      });
    </script>
	
	<script type="text/javascript" src="autosum.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../../dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../plugins/select2/select2.full.min.js"></script>
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
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,x`
          "info": true,
          "autoWidth": false
        });
      });
    </script>
     <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>
