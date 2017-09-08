var page = require('webpage').create();
system = require('system');

if (system.args.length === 1) {
  console.log('Usage: script.js <some subject query>');
  phantom.exit();
}

var url = 'https://www.google.fr/search?q='+system.args[1]+'&source=lnms&tbm=isch';

console.log("This is the url");
console.log(url);



page.onLoadFinished = function(){

    var urls = page.evaluate(function(){
        var image_urls = new Array;
        var images = document.getElementsByTagName("img");
        for(q = 0; q < images.length; q++){
            image_urls.push(decodeURIComponent(images[q].src));
            if(images[q].href.indexOf("/imgres?imgurl=http")>0){
                
                // image_urls[++j]=decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
            }
        }
        return image_urls;
    });    

    console.log(urls.length);
    for (var i = 0; i < urls.length; i++) {
        var element = urls[i];
        console.log(urls[i]);
    }
    

    phantom.exit();
}

page.open(url);



// page.open(url, function (status) {
//     try {
//         if (status !== "success") {
//             console.log("Unable to access network");
//         } else {
//             var image_urls = new Array();
    
//             console.log("HERE 1");
//             setTimeout(function () {
//                 console.log("HERE 2");
//                 var eval = page.evaluate(function() {
//                     console.log("HERE 3");
//                     var j=-1;
//                     var image_urls = new Array();
//                     var images = document.getElementsByTagName("a");
//                     console.log(images.length);
//                     // Scrapping the google result page in order to get the url of the images
//                     for(q = 0; q < images.length; q++){
//                         console.log("HERE 4");
//                         if(images[q].href.indexOf("/imgres?imgurl=http")>0) {
//                             image_urls[++j]=decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
//                         }
//                     }
//                     return image_urls;
//                 // page is redirecting.
//                 });
//                 console.log(eval);
//             }, 5000);
//         }        
//     } catch (ex) {
//         var fullMessage = "\nJAVASCRIPT EXCEPTION";
//         fullMessage += "\nMESSAGE: " + ex.toString();
//         for (var p in ex) {
//             fullMessage += "\n" + p.toUpperCase() + ": " + ex[p];
//         }
//         console.log(fullMessage);
//     }
// });