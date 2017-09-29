jQuery(document).ready(function($){
		if($('.plugin-card-amp').length>0){
			$('.plugin-card-amp').find('.plugin-action-buttons').find('li:first a').attr("href","#").attr('onclick','alert(\'This plugin is already added in our core\')');
		}		
});