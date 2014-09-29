$(document).ready(function() {
	var pageTitle = document.title; //HTML page title
	var pageUrl = location.href; //Location of the page

	
	sharetext='Pre-evento Cyberlunes';

	function pruebaFacebook(){

		//var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
	    var shareName= 'facebook';

		console.log(shareName);
		switch (shareName) //switch to different links based on different social name
		{
			case 'facebook':
			 		//ga('send', 'event', 'restaurante/share', 'click', 'facebook');
				var openLink = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
				break;	
			
		}
		
		//Parameters for the Popup window
		winWidth 	= 650;	
		winHeight	= 450;
		winLeft   	= ($(window).width()  - winWidth)  / 2,
		winTop    	= ($(window).height() - winHeight) / 2,	
		winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
		
		//open Popup window and redirect user to share website.
		window.open(openLink,'Pre-evento Cyberlunes',winOptions);
		return false;

	}
	//user clicks on a share button
	/*$('.fb').click(function(event) {
			//var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
		    var shareName= 'facebook';

			console.log(shareName);
			switch (shareName) //switch to different links based on different social name
			{
				case 'facebook':
				 		//ga('send', 'event', 'restaurante/share', 'click', 'facebook');
					var openLink = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
					break;	
				
			}
		
		//Parameters for the Popup window
		winWidth 	= 650;	
		winHeight	= 450;
		winLeft   	= ($(window).width()  - winWidth)  / 2,
		winTop    	= ($(window).height() - winHeight) / 2,	
		winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
		
		//open Popup window and redirect user to share website.
		window.open(openLink,'Pre-evento Cyberlunes',winOptions);
		return false;
	});*/

	
	$('.tw').click(function(event) {
			//var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
		    var shareName= 'twitter';

			console.log(shareName);
			switch (shareName) //switch to different links based on different social name
			{
				case 'twitter':
					var openLink = 'http://twitter.com/home?status=' + encodeURIComponent( sharetext+ ' ' + pageUrl);
					//ga('send', 'event', 'restaurante/share', 'click', 'twitter');
					break;				
				
			}
		
		//Parameters for the Popup window
		winWidth 	= 650;	
		winHeight	= 450;
		winLeft   	= ($(window).width()  - winWidth)  / 2,
		winTop    	= ($(window).height() - winHeight) / 2,	
		winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
		
		//open Popup window and redirect user to share website.
		window.open(openLink,'Pre-evento Cyberlunes',winOptions);
		return false;
	});


	
	/*$(document).on( "click", ".socialesinfoampliada", function(event) {          

				//var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
			    var shareName=$(this).data("red");
			    var url=$(this).data("url");

				console.log(shareName);
				switch (shareName) //switch to different links based on different social name
				{
					case 'facebook':
					 		ga('send', 'event', 'restaurante/share', 'click', 'facebook');
						var openLink = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&amp;title=' + encodeURIComponent(pageTitle);
						break;
					case 'twitter':
						var openLink = 'http://twitter.com/home?status=' + encodeURIComponent( sharetext+ ' ' + url);
						ga('send', 'event', 'restaurante/share', 'click', 'twitter');
						break;				
					case 'google':
						var openLink = 'https://plus.google.com/share?url=' + encodeURIComponent(url) + '&amp;title=' + encodeURIComponent(sharetext);
						ga('send', 'event', 'restaurante/share', 'click', 'google');
						break;
					
				}
			
			//Parameters for the Popup window
			winWidth 	= 650;	
			winHeight	= 450;
			winLeft   	= ($(window).width()  - winWidth)  / 2,
			winTop    	= ($(window).height() - winHeight) / 2,	
			winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
			
			//open Popup window and redirect user to share website.
			window.open(openLink,'Acabo de descubrir uno de los mejores restaurantes en #loscienmejoresdelagastronomia',winOptions);
			return false;
		});*/
});
