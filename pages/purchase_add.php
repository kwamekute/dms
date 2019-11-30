<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

$enqid = $_POST['enqid'];
$prid = 'PR'.'1001'.''.rand(1,10000).'';
$dt = date('Y-m-d');
$allenq = array();

$sql = "SELECT * FROM enquiry WHERE enqid='$enqid'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_assoc($result))
	{
		$allenq[] = $row;
	}
}

$sql1 = "";
foreach($allenq as $a){
	$order_type_id = $a["order_type_id"];
	$enquiry_date = $a["enquiry_date"];
	$part_id = $a["part_id"];
	$qty = $a["qty"];
	$sql1 .= "INSERT INTO purchase_request(pr_id, prod_id, qty, request_date, branch_id, purchase_status) 
			  VALUES('$prid','$part_id','$qty','$dt','0','pending');";
}

if($con->multi_query($sql1)){
	$yes = "<script>alert('Purchase request added');window.location='inventory/enquiry.php';</script>";
}else{
	$yes = $con->error;	
}

echo $yes;

?>