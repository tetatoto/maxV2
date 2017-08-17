<?php
include_once("simple_html_dom.php");

 

function getPageContent($url) {
    $proxy = '127.0.0.1:3128';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    // the next line has to be uncommented if you are working on localhost host e-buro, in order to use cntlm proxy
	curl_setopt($curl, CURLOPT_PROXY, $proxy);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str = curl_exec($curl);
    curl_close($curl);

    // Create a DOM object
    $dom = new simple_html_dom();
    // Load HTML from a string
    $dom->load($str, true, false);

    return $dom;
}

// Uncomment those lines to test the function
// $url = 'http://lemoteur.orange.fr/?module=lemoteur&bhv=web_fr&kw=clients%20orange%20free';
// $dom_result = getPageContent($url);
// // var_dump($dom_result);
// echo '<h1>  Done </h1>';
