$(document).ready(function(){
	$(".click_cat").click(function(){
		var catid = $(this).data("id");
		console.log(catid);

		$.ajax({
			url	:	"../include/action.php",
			method:	"POST",
			data	:	{category:catid},
			success	:	function(data){
				$("#searchResult").html(data);
				$("#searchResult").show();
				$("#allProduct").hide();
		    console.log(data);
			}
		})
	});
});
