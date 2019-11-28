<?php
include('../dist/includes/dbcon.php');

$enqid = 'EN'.'1001'.''.rand(1,10000).'';

$alltemp = array();
$sql = "SELECT * FROM temp_trans";
$result = $con->query($sql);
if ($result->num_rows > 0) {
	while($row = mysqli_fetch_assoc($result))
	{
		$alltemp[] = $row;
	}
}
$sql1 = "";
foreach($alltemp as $a){
	$order_type_id = $a["order_type_id"];
	$enquiry_date = $a["date"];
	$part_id = $a["part_id"];
	$qty = $a["qty"];
	$tid = $a["temp_trans_id"];
	$sql1 .= " INSERT INTO enquiry(enqid, order_type_id,supplier_id,enquiry_date,due_date, profoma_no, part_id, qty) 
			VALUES('$enqid','$order_type_id','','$enquiry_date','','','$part_id','$qty');";
	$sql1 .= " DELETE FROM `temp_trans` WHERE temp_trans_id = '$tid';";
}

if($con->multi_query($sql1)){
	$yes = 1;
}else{
	$yes = $con->error;	
}

echo $yes;
?>