<?php 
session_start();
$id=$_SESSION['id'];
$branch=$_SESSION['branch'];	

include('../dist/includes/dbcon.php');

	$sid = $_POST['sid'];
	$no = $_POST['part_no'];
	$qty = $_POST['qty'];
		
		
			mysqli_query($con,"INSERT INTO enuiry(prod_id,qty,price,branch_id) VALUES('$name','$qty','$price','$branch')")or die(mysqli_error($con));
	

	
		echo "<script>document.location='cash_transaction.php?cid=$cid'</script>";  
	
?>