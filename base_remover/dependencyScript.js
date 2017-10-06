jQuery(document).ready(function($){
	
	var myElement = document.getElementById('plugin-filter');
	//if( myElement.innerHtml!=''){
		if(window.addEventListener) {
		   // Normal browsers
		   myElement.addEventListener('DOMSubtreeModified', contentChanged, false);
		} else
		   if(window.attachEvent) {
			  myElement.attachEvent('DOMSubtreeModified', contentChanged,false);
		   }
	//}
	   
	
	function contentChanged() {
		if($('.plugin-card-amp').length>0){
			$('.plugin-card-amp').find('.plugin-action-buttons').find('li:first a').attr("href","#").attr('onclick','alert(\'This plugin is already added in our core\')');
		}
	}
	contentChanged();
});