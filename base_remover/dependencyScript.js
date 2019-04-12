jQuery(document).ready(function($){
	
	var myElement = document.getElementById("plugin-filter");
	//if( myElement.innerHtml!=''){
		if(window.addEventListener) {
		   // Normal browsers
		   myElement.addEventListener('DOMSubtreeModified', contentChanged, false);
		} else
		   if(window.attachEvent) {
			  myElement.attachEvent('DOMSubtreeModified', contentChanged,false);
		   }
	//}
	   
});