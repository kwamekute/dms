<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id =$_POST['cid'];
	$qty = $_POST['qty'];
	
	
	mysqli_query($con,"update temp_trans set qty='$qty' where temp_trans_id='$id'");
	
	
	echo "<script>document.location='inventory/enquiry_details.php'</script>";  

	
?>
