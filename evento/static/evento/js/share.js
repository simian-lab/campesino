function shareFacebook(art_detalle){

    var title = $('meta[http-equiv="og:title"]').attr("content");
    var description = $('meta[http-equiv="og:description"]').attr("content");
    var image = $('meta[http-equiv="og:image"]').attr("content");
    var url = $('meta[http-equiv="og:url"]').attr("content");

    var obj = {
        method: 'feed',
        link: url,
        picture: image,
        name: title, 
        caption: '',
        description: description
    };

    function callback(response) {
        onClickShare('facebook', title);
    }
    FB.ui(obj, callback);
    return false;
}

function shareTwitter(art_detalle){

    var url = location.href;

    if(art_detalle == 'detalle')
        var text_share = $('meta[http-equiv="og:title"]').attr("content");
    else
        var text_share = 'Ya estoy mirando en http://www.cyberlunes.com.co las mejores ofertas. Aprovecha los descuentos increíbles de @Cyberlunesco';

    var openLink = 'http://twitter.com/share?text=' + encodeURIComponent( text_share );
    
    onClickShare('twitter', text_share);
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

$(document).ready(function(){
    window.fbAsyncInit = function() {
        FB.init({
          appId      : appdiademoda.data.app.fb_appid,
          xfbml      : true,
          version    : 'v2.1'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
});
