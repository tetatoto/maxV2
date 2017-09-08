var page = require('webpage').create();
system = require('system');

if (system.args.length === 1) {
  console.log('Usage: script.js <some subject query>');
  phantom.exit();
}

var url = 'https://www.bing.com/images/search?q='+system.args[1];

console.log("This is the url");
console.log(url);



page.onLoadFinished = function(){

    var urls = page.evaluate(function(){
        var image_urls = new Array;
        var images = document.getElementsByTagName("a");
        for(q = 0; q < images.length; q++){
            image_urls.push(images[q].m);
            // if(images[q].href.indexOf("/imgres?imgurl=http")>0){
                
            //     // image_urls[++j]=decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
            // }
        }
        return image_urls;
    });    


    {"cid":"KecjEWTJ",
    "purl":"http://starconnectmedia.wordpress.com/2013/01/10/oscars-to-celebrate-james-bond/",
    "murl":"http://starconnectmedia.files.wordpress.com/2013/01/james-bond.jpg",
    "turl":"https://tse1.mm.bing.net/th?id=OIP.KecjEWTJQkP2blVch17zywDUEs&pid=15.1",
    "md5":"29e7231164c94243f66e555c875ef3cb"}

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