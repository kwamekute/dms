<?php 
session_start();
$id=$_SESSION['id'];
$branch=$_SESSION['branch'];
$partid = $_POST['part_no'];
$order_typeid = $_POST['order_type'];
$qty = $_POST['qty'];	
$dt = date('Y-m-d');

include('../dist/includes/dbcon.php');
	
	$query1=mysqli_query($con,"select * from temp_trans where part_id='$partid'");
	$count=mysqli_num_rows($query1);
	
	
	if ($count>0){
		mysqli_query($con, "update temp_trans set qty=qty+'$qty' where part_id='$partid'");
		echo "exists";
	}
	else{
		mysqli_query($con,"INSERT INTO temp_trans(part_id,order_type_id,qty,date) 
					VALUES('$partid','$order_typeid','$qty','$dt')");
	}


	echo "<script>document.location='inventory/enquiry_details.php'</script>";  
	
?>