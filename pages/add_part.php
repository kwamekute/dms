<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$name = $_POST['part_name'];
	$price = $_POST['part_price'];
	$desc = $_POST['part_desc'];
	$supplier = $_POST['supplier'];
	$reorder = $_POST['reorder'];
	$category = $_POST['category'];
	$part_no = $_POST['part_no'];
	$model = $_POST['model'];
	
	$query2=mysqli_query($con,"select * from parts where part_name='$name' and branch_id='$branch' and model_for_id = '$model'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Part already exist!');</script>";
			echo "<script>document.location='parts.php'</script>";  
		}
		else
		{	

			$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{
				$pic="default.gif";
			}
			else
			{
				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
						{
						die("Format is not allowed or file size is too big!");
						}
				else
				      {
					move_uploaded_file($temp, "../dist/uploads/".$pic);
				      }
					}
			}	

			mysqli_query($con,"INSERT INTO parts(part_name,part_price,part_desc,part_pic,cat_id,reorder,supplier_id,branch_id,part_no,model_for_id)
			VALUES('$name','$price','$desc','$pic','$category','$reorder','$supplier','$branch','$part_no','$model')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new part!');</script>";
					  echo "<script>document.location='parts.php'</script>";  
		}
?>