function shareFacebook(){
    var pageTitle = document.title; //HTML page title
    var pageUrl = location.href; //Location of the page

    
    sharetext='Si les gustan las ofertas como a mí no se pueden perder CyberLunes este 19 de mayo. Entérense de las tiendas que van a participar aquí: www.cyberlunes.com.co';
    //var shareName = $(this).attr('class').split(' ')[0]; //get the first class name of clicked element
    var shareName= 'facebook';

    //console.log(shareName);
    switch (shareName) //switch to different links based on different social name
    {
        case 'facebook':
                //ga('send', 'event', 'restaurante/share', 'click', 'facebook');
            var openLink = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle);
            break;  
        
    }
    
    //Parameters for the Popup window
    winWidth    = 650;  
    winHeight   = 450;
    winLeft     = ($(window).width()  - winWidth)  / 2,
    winTop      = ($(window).height() - winHeight) / 2, 
    winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
    
    //open Popup window and redirect user to share website.
    window.open(openLink,'',winOptions);
    return false;

}

function shareTwitter(){
    var pageTitle = document.title; //HTML page title
    var pageUrl = location.href; //Location of the page

    sharetext='Están increíbles las ofertas de @CyberLunesCo. Los descuentos son hasta media noche. Conócelos en';
    var shareName= 'twitter';

    //console.log(shareName);
    switch (shareName) //switch to different links based on different social name
    {
        case 'twitter':
            var openLink = 'http://twitter.com/home?status=' + encodeURIComponent( sharetext+ ' ' + pageUrl);
            //ga('send', 'event', 'restaurante/share', 'click', 'twitter');
            break;              
        
    }
    
    //Parameters for the Popup window
    winWidth    = 650;  
    winHeight   = 450;
    winLeft     = ($(window).width()  - winWidth)  / 2,
    winTop      = ($(window).height() - winHeight) / 2, 
    winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;
    
    //open Popup window and redirect user to share website.
    window.open(openLink,'',winOptions);
    return false;

}
