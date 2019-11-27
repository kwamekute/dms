<?php 
session_start();
include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$name = $_POST['supplier_name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	
	$query2=mysqli_query($con,"select * from supplier where supplier_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Supplier already exist!');</script>";
			echo "<script>document.location='newEnquiry.php'</script>";  
		}
		else
		{	
			
			mysqli_query($con,"INSERT INTO supplier(supplier_name,supplier_address,supplier_contact,branch_id) 
				VALUES('$name','$address','$contact','$branch')")or die(mysqli_error($con));

			$id=mysqli_insert_id($con);
			//$_SESSION['cid']=$id;
			//echo "<script type='text/javascript'>alert('Successfully added new customer!');</script>";
			echo "<script>document.location='enquiry_details.php?cid=$id'</script>";  
		}
?>