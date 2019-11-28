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
	
});