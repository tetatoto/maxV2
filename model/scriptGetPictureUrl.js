// This file is a phantomJS script. It takes one argument : the query made from the title of the choosen article
// Example : if the title of the article is "James Bond Daniel Craig" then the query will be : "James+Bond+Daniel+Craig"


var page = require('webpage').create(),
  system = require('system'),
  t, address;
var fs = require('fs');
var path = 'outputs/urls_images.txt';

if (system.args.length === 1) {
  console.log('Usage: script.js <some subject query>');
  phantom.exit();
}
page.settings.userAgent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36";

page.onLoadFinished = function() {
    //console.log(document.getElementsByTagName("a").length);
    var urls  = page.evaluate(function(src_file2){
        var image_urls = new Array();
        var j=-1;
        var images = document.getElementsByTagName("a");
        // Scrapping the google result page in order to get the url of the images
        for(q = 0; q < images.length; q++){
            if(images[q].href.indexOf("/imgres?imgurl=http")>0){
            image_urls[++j]=decodeURIComponent(images[q].href).split(/=|%|&/)[1].split("?imgref")[0];
            }
        }
        return image_urls;
    });
    //page.render('img.png');

    // console.log(urls.length);
    // console.log('*************************');
    //console.log(urls[1]);

    // Erase the content of the urls_images.txt file
    fs.remove(path);
    // Wrtting in the text file all the urls found by the script
    console.log(urls[0]);
    fs.write(path, urls[0], '+');
    for(k = 1; k < urls.length; k++){
        console.log(urls[k]);
        fs.write(path, '\n', '+');
        fs.write(path, urls[k], '+');
    }
    phantom.exit();
}
// Run the script
page.open('https://www.google.fr/search?q='+system.args[1]+'&source=lnms&tbm=isch', fs);
