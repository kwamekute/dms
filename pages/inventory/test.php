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
      <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Product</li>
            </ol>
          </section>
      <div class="content container-fluid">
    
    <div class="row">
    	<div class="col-sm-12">
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                           <!-- <li class="active col-md-3"><a href="#tab1default" data-toggle="tab">Default 1</a></li>
                            <li class="col-md-3"><a href="#tab2default" data-toggle="tab">Default 2</a></li>
                            <li class="col-md-3"><a href="#tab3default" data-toggle="tab">Default 3</a></li>-->
                            <li class="active dropdown col-sm-4">
                                <a href="#" data-toggle="dropdown">Purchase Enquiry <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab1default" data-toggle="tab">View Enquiries</a></li>
                                    <li><a href="#tab2default" data-toggle="tab">Make New Enquiry</a></li>
                                </ul>
                            </li>
                            <li class="dropdown col-sm-4">
                                <a href="#" data-toggle="dropdown">Purchase Order <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab3default" data-toggle="tab">View Purchase Orders</a></li>
                                    <li><a href="#tab4default" data-toggle="tab">Make New Purchase order</a></li>
                                </ul>
                            </li>
                            <li class="dropdown col-sm-4">
                                <a href="#" data-toggle="dropdown">Receipt Documents <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab5default" data-toggle="tab">View Receipts </a></li>
                                    <li><a href="#tab6default" data-toggle="tab">Confirm New Receipts</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">     
                            <div class="container">
                            <section class="content-header">   
                            <h1>
              <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-blue"></i></a>
            </h1>
            </section>
            <br>
            <div class="col-xs-12">
              <div class="box box-primary">
    
                <div class="box-header">
                  <h3 class="box-title">Parts List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th>Picture</th>
                        <th>Part No.</th>
                        <th>Part Name</th>
                        <th>Description</th>
						            <th>Supplier</th>
                        <th>Qty</th>
            						<th>Price</th>
            						<th>Category</th>
            						<th>Reorder</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		$query=mysqli_query($con,"select * from parts natural join supplier natural join category where branch_id='$branch' order by part_name")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		
?>
                      <tr>
                      	<td><img style="width:80px;height:60px" src="../dist/uploads/<?php echo $row['part_pic'];?>"></td>
                        <td><?php echo $row['part_no'];?></td>
                        <td><?php echo $row['part_name'];?></td>
                        <td><?php echo $row['part_desc'];?></td>
						            <td><?php echo $row['supplier_name'];?></td>
                        <td><?php echo $row['part_qty'];?></td>
            						<td><?php echo number_format($row['part_price'],2);?></td>
            						<td><?php echo $row['cat_name'];?></td>
            						<td><?php echo $row['reorder'];?></td>
                        <td>
				<a href="#updateordinance<?php echo $row['part_id'];?>" data-target="#updateordinance<?php echo $row['part_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
			
						</td>
                      </tr>
<div id="updateordinance<?php echo $row['part_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Part Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="product_update.php" enctype='multipart/form-data'>
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Part No.</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="price" name="part_no" value="<?php echo $row['part_no'];?>" required>  
          </div>
        </div>
                
				<div class="form-group">
					<label class="control-label col-lg-3" for="name">Part Name</label>
					<div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['part_id'];?>" required>  
					  <input type="text" class="form-control" id="name" name="part_name" value="<?php echo $row['part_name'];?>" required>  
					</div>
				</div> 
        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Part Description</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="part_desc" value="<?php echo $row['part_desc'];?>" required>  
          </div>
        </div> 
				<div class="form-group">
					<label class="control-label col-lg-3" for="file">Supplier</label>
					<div class="col-lg-9">
					    <select class="form-control select2" style="width: 100%;" name="supplier" required>
						  <option value="<?php echo $row['supplier_id'];?>"><?php echo $row['supplier_name'];?></option>
					      <?php
						
							$query2=mysqli_query($con,"select * from supplier")or die(mysqli_error());
							  while($row2=mysqli_fetch_array($query2)){
					      ?>
							    <option value="<?php echo $row['supplier_id'];?>"><?php echo $row2['supplier_name'];?></option>
					      <?php }?>
					    </select>
					</div>
				</div> 
				
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Price</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="price" name="part_price" value="<?php echo $row['part_price'];?>" required>  
					</div>
				</div>
				
				<div class="form-group">
							<label class="control-label col-lg-3" >Category</label>
							<div class="col-lg-9">
							  <select class="form-control select2" style="width: 100%;" name="category" required>
              <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
                <?php
            
              $queryc=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
                while($rowc=mysqli_fetch_array($queryc)){
                ?>
                  <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                <?php }?>
              </select>
							</div><!-- /.input group -->
						  </div><!-- /.form group -->
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Reorder</label>
					<div class="col-lg-9">
					  <input type="number" class="form-control" id="price" name="reorder" value="<?php echo $row['reorder'];?>" required>  
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Picture</label>
					<div class="col-lg-9">
					  <input type="hidden" class="form-control" id="price" name="image1" value="<?php echo $row['prod_pic'];?>"> 
					  <input type="file" class="form-control" id="price" name="image">  
					</div>
				</div>
              </div><br><br><br><br><br><br><br>
              <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Save changes</button>
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
 
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
                    </div>
    </div>
                        <div class="tab-pane fade" id="tab2default">Default 2</div>
                        <div class="tab-pane fade" id="tab3default">Default 3</div>
                        <div class="tab-pane fade" id="tab4default">Default 4</div>
                        <div class="tab-pane fade" id="tab5default">Default 5</div>
                        <div class="tab-pane fade" id="tab6default">Default 6</div>

                    </div>
                </div>
            </div>
        </div>
      
	</div>
</div>


<br/>
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
