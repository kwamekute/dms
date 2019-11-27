<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$model = $_POST['model'];
	$manufact = $_POST['manufacturer'];
    
	$query2=mysqli_query($con,"select * from model where model='$model' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Model already exist!');</script>";
			echo "<script>document.location='car_models.php'</script>";  
		}
		else
		{
			mysqli_query($con,"INSERT INTO model(model,manufact_id,branch_id) 
			VALUES('$model','$manufact','$branch')")or die(mysqli_error($con));

		echo "<script type='text/javascript'>alert('Successfully added new Car Model!');</script>";
				  echo "<script>document.location='car_models.php'</script>";  
		}
			
			
	
?>