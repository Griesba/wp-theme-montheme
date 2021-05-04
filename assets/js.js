jQuery(document).ready(function($) {


	jQuery('#mySidebar').on( 'click', function( event ) {
        document.getElementById("mySidebar").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
	});

	jQuery('#main').on( 'click','#openNavBtn', function( event ) {
		console.log("hello");
        document.getElementById("mySidebar").style.width = "100%";
		document.getElementById("main").style.marginLeft = "250px";
	});

	function openNav() {
		document.getElementById("mySidebar").style.width = "250px";
		document.getElementById("main").style.marginLeft = "250px";
	  }
	  
	  function closeNav() {
		document.getElementById("mySidebar").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
	  }

});