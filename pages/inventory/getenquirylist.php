<?php
	include('../dist/includes/dbcon.php');

	$enqid = $_POST["enqid"];
	$enqdata = "";
	$sqll = "Select enquiry.enqid, enquiry.qty, enquiry.enquiry_date, parts.part_name, parts.part_no, parts.reorder,
			  order_type.order_type, category.cat_name from enquiry
			  LEFT JOIN parts ON enquiry.part_id = parts.part_id
			  LEFT JOIN category ON parts.cat_id = category.cat_id
			  LEFT JOIN order_type ON enquiry.order_type_id = order_type.order_type_id";	
	$query=mysqli_query($con,$sqll);
	while($row=mysqli_fetch_array($query)){
		$enqdata .= "<tr>
                        <td>".$row['part_no']."</td>
                        <td>".$row['part_name']."</td>
						<td>".$row['cat_name']."</td>
						<td>Unknown</td>
						<td>".$row['order_type']."</td>
						<td>".$row['qty']."</td>
            			<td>".$row['enquiry_date']."</td>
					</tr>";
	}
	
	echo $enqdata;
?>