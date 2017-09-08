var page = require('webpage').create();
system = require('system');

if (system.args.length === 1) {
  console.log('Usage: script.js <some subject query>');
  phantom.exit();
}

var url = 'https://www.google.fr/search?q='+system.args[1]+'&source=lnms&tbm=isch';

console.log("This is the url");
console.log(url);

page.open(url, function (status) {
    var image_urls = new Array();
    
    console.log("HERE 1");
    setTimeout(function () {
        console.log("HERE 2");
        page.evaluate(function() {
            console.log("HERE 3");
            var j=-1;
            var image_urls = new Array();
            var images = document.getElementsByTagName("a");
            console.log(images.length);
            // Scrapping the google result page in order to get the url of the images
            for(q = 0; q < images.length; q++){
                console.log("HERE 4");
                if(images[q].href.indexOf("/imgres?imgurl=http")>0) {
                    image_urls[++j]=decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
                }
        }

        // page is redirecting.
    });
    }, 5000);
});