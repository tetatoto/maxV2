// This file is a phantomJS script. It takes one argument : the query made from the title of the choosen article
// Example : if the title of the article is "James Bond Daniel Craig" then the query will be : "James+Bond+Daniel+Craig"

var webPage = require('webpage');
var page = webPage.create();


var system = require('system');

var fs = require('fs');
// var path = 'urlsPhantom.txt';

if (system.args.length === 1) {
  console.log('Usage: script.js <some subject query>');
  phantom.exit();
}
page.settings.userAgent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36";

page.onConsoleMessage = function(msg, lineNum, sourceId) {
  console.log(msg);
};

page.onLoadFinished = function(status) {
    // var urls = new Array();
    if (status === 'success') {

        // console.log("ONLOAD success : " + status);
        // console.log("document ready state : " + document.readyState);
        // console.log("windows onload : " + window.onload);
        

        urls = page.evaluate(function() {
            // console.log("Entering the page.evaluate ");
            // var image_urls = new Array();
            // var j=-1;
            var images = document.getElementsByTagName("a");
            setTimeout(function() {
                // console.log("Entering the timeout 1");
                for(q = 0; q < images.length; q++){
                    // console.log("image added");
                    if(images[q].href.indexOf("/imgres?imgurl=http")>0){
                        var final_url = decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
                        // image_urls[++j]=decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
                        console.log(final_url);
                    }
                }
                // return image_urls;
            }, 2000);
            
            // Scrapping the google result page in order to get the url of the images

        });
        // setTimeout(function() {
        //         console.log("After page.evaluate ");
        //         console.log(urls[0]);
        //         for(k = 1; k < urls.length; k++) {
        //             console.log(urls[k]);
        //         }
        // }, 5000);
        


    } else {
        console.log("ONLOAD failed :" + status);
        phantom.exit();
    }

    // Erase the content of the urls_images.txt file
    // fs.remove(path);
    // console.log(status);
    // Wrtting in the text file all the urls found by the script
    // fs.write(path, urls[0], '+');
    // fs.write(path, '\n', '+');
    // fs.write(path, urls[k], '+');
    setTimeout(function() {
        phantom.exit();
    }, 3000);
    
}

// Run the script
page.open('https://www.google.fr/search?q='+system.args[1]+'&source=lnms&tbm=isch', fs);
