jQuery(document).ready(function() {	
	
	var id = '#dialog';

        //transition effect		
		jQuery('#mask').fadeIn(500);		
		
		//Get the window width
		var winW = jQuery(window).width();
              
		//Set the popup window to center
		jQuery(id).css('left', (jQuery(window).width() 
		- jQuery(id).outerWidth())/2);

		//transition effect
		jQuery(id).fadeIn(2000); 	

		jQuery('#pop img.banner').click(function(){
			window.location.href = './regularizacaoimobiliaria/';
		 });		

	
    jQuery(window).resize(function(){

		jQuery(id).css({
		 position:'absolute',
		 left: (jQuery(window).width() 
		   - jQuery(id).outerWidth())/2
		});
	  
	   });


	//if close button is clicked
	jQuery('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		jQuery('#mask').hide();
		jQuery('.window').hide();
	});		
	
	//if mask is clicked
	jQuery('#mask').click(function () {
		jQuery(this).hide();
		jQuery('.window').hide();
	});		
	
});