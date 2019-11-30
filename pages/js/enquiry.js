$(document).ready(function(event){
	
	$("#btnprint").click(function(event){
		event.preventDefault();
		var pstat = "confrim";
		
		$.ajax({
			url:'confirm_enquiry.php',
			type:'post',
			data:{p:pstat},
			success:function(response){
				if(response==1){
					window.print();
				}else{
					alert(response);
				}
			}
		});
		
	});
	
	$("#btnview").click(function(event){
		event.preventDefault();
		var enqid = $("#btnview").data("id");
		//alert(enqid);
		
		$.ajax({
			url:'getenquirylist.php',
			type:'post',
			data:{enqid:enqid},
			success:function(response){
				$("#enqid").val(enqid);
				$("#enqlist").html(response);
				$("#updateordinance").modal("show");
			}
		});
		
	});
	
});