<?php 
session_start();
include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
    $sex = $_POST['sex'];
    $credit = $_POST['credit'];
    $acct_num = $_POST['acct_num'];

	
	$query2=mysqli_query($con,"select * from cust where cust_name='$name'and acct_num = $acct_num and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);
		$row=mysqli_fetch_array($query2);
			$id=$row['id'];

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Customer Account Already Exists!');</script>";
			echo "<script>document.location='add_cust.php'</script>";  
		}
		else
		{	
			
			mysqli_query($con,"INSERT INTO cust(cust_name,address,telephone,branch_id,balance,credit_limit,sex,email,acct_num) 
				VALUES('$name','$address','$contact','$branch','0.00',$credit,$sex,$email,$acct_num)")or die(mysqli_error($con));

			$id=mysqli_insert_id($con);
			//$_SESSION['cid']=$id;
			echo "<script type='text/javascript'>alert('New Customer Account Succesfully Added!');</script>";
			echo "<script>document.location='accounts.php'</script>";  
		}
?>