
	function openNav() {
		document.getElementById("mySidebar").style.width = "100%";
		//document.getElementById("main").style.marginLeft = "250px";
	}
	
	function closeNav() {
		document.getElementById("mySidebar").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
	}


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