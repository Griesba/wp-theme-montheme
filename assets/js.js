
	function openNav() {
		document.getElementById("mySidebar").style.width = "100%";
		//document.getElementById("main").style.marginLeft = "250px";
	}
	
	function closeNav() {
		document.getElementById("mySidebar").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
	}

/* 	setTimeout(function()
	{
		var max = 150;
	  var tot, str;
	  $('.desc p.lead').each(function() {
		  str = String($(this).html());
		  tot = str.length;
		str = (tot <= max)
			? str
		  : str.substring(0,(max + 1))+"...";
		$(this).html(str);
	  });
	},100); // Delayed for example only. 
 */

jQuery(document).ready(function($) {	

	jQuery('#mySidebar').on( 'click', function( event ) {
        
		console.log('mySidebar');
		console.log(event);
		if(event.target.id === "mySidebar") {
			document.getElementById("mySidebar").style.width = "0";
			document.getElementById("main").style.marginLeft= "0";
		}		
	});


	jQuery('#main').on( 'click','#openNavBtn', function( event ) {
		console.log("hello");
        document.getElementById("mySidebar").style.width = "100%";
		document.getElementById("main").style.marginLeft = "250px";
	});

});