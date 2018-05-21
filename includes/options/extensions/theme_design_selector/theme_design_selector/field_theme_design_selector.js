jQuery(document).ready(function($){ 
	$('.theme_design_selector li').click(function(){
		var current = $(this);
		current.siblings().removeClass('active'); 
		current.addClass('active');	 
	}); 
});