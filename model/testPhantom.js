var page = require('webpage').create();

if (system.args.length === 1) {
  console.log('Usage: script.js <some subject query>');
  phantom.exit();
}

var url = 'https://www.google.fr/search?q='+system.args[1]+'&source=lnms&tbm=isch';


page.open(url, function (status) {
    var image_urls = new Array();
    

    setTimeout(function () {
        page.evaluate(function() {
        
        var j=-1;
        var images = document.getElementsByTagName("a");
        console.log(images.length);
        // Scrapping the google result page in order to get the url of the images
        for(q = 0; q < images.length; q++){
            if(images[q].href.indexOf("/imgres?imgurl=http")>0){
            image_urls[++j]=decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
            }
        }

        // page is redirecting.
    });
    }, 5000);
});