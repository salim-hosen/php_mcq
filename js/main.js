$(document).ready(function(){
	$("#login_form").submit(function(){
		var dataValue = $(this).serialize()+"&action=login";

		$.ajax({
			url: "ajax/login.php",
			type: "POST",
			data: dataValue,
			dataType: "html",
			success: function(data){
				if(data === "success"){
					window.location = "home.php";
				}else{
					$("#log_error").html(data).fadeIn("slow");
				}
			}
		});
		return false;
	});

	$("#reg_form").submit(function(){
		var dataValue = $(this).serialize()+"&action=register";

		$.ajax({
			url: "ajax/register.php",
			type: "POST",
			data: dataValue,
			dataType: "html",
			success: function(data){
				if(data === "success"){
					$("#reg_error").hide();
					$("#reg_success").html("Registration Successful.").fadeIn("slow");
				}else{
					$("#reg_success").hide();
					$("#reg_error").html(data).fadeIn("slow");
				}
			}
		});
		return false;
	});

	$("#profile_form").submit(function(){
		var dataValue = $(this).serialize()+"&action=update";

		$.ajax({
			url: "ajax/update.php",
			type: "POST",
			data: dataValue,
			dataType: "html",
			success: function(data){
				if(data === "success"){
					$("#upError").hide();
					$('#upSuccess').html("Successfully Updated.").fadeIn("slow");
				}else{
					$("#upSuccess").hide();
					$('#upError').html(data).fadeIn("slow");
				}
			}
		});
		return false;
	});

	$("#subject>li>a").click(function(){

		$("#subject>li").removeClass("active");
		$(this).parent().addClass("active");

		var dataValue = "subId="+this.id+"&action=getQset";

		$.ajax({
			url: "ajax/qSet.php",
			type: "POST",
			data: dataValue,
			dataType: "html",
			success: function(data){
				$("#qSet").html(data);
			}
		});

		return false;
	});

});

var c;

function delFun(delId){
	$("#alert").show();
	var dataValue = "delId="+delId+"&action=delete";

	$("#yes,#no").click(function(){
		if(this.id === "yes"){
			c = true;
		}else{
			c = false;
		}
		$("#alert").hide();
		if(c==true){
			$.ajax({
				url: "ajax/delete.php",
				type: "POST",
				data: dataValue,
				dataType: "html",
				success: function(data){
					if(data === "success"){
						$("#delError").hide();
						$("#delSuccess").html("Deleted Successfully.");
						$("#"+delId).remove();
						if($("#result tr").length < 1){
								$("#result").html("<tr><td colspan='6'>No Results Found.</td></tr>");
						}
					}else{
						$("#delError").html("Can not Delete Element.");
						$("#delSuccess").hide();
					}
				}
			});
		}
	});

}
