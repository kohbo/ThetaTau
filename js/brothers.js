

	
		  $(".alum").fadeOut(1200);
		

$("#alum").click(function(){
	$(".alum").fadeIn("slow",function(){
	  $(".act").fadeOut(1200);
	});
});

$("#all").click(function(){
	$(".alum").fadeIn(2000);
	$(".act").fadeIn(2000);
});