jQuery(document).ready(function($){ 
	$('.theme_design_selector li label').click(function(){
		var current = $(this).parent();
		current.siblings().removeClass('active'); 
		current.addClass('active');	 
	}); 
});