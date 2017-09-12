<?php


//include("phantomScript.js");
// We suppose that the variable $theme is already on the format of a query (james+bond+daniel+craig for example)

function runPhantomScript($theme) {
    // The following command run the pahntom script and store the logs containing the urls in a file text named file.txt
    $runScriptCommand = 'phantomjs model/phantomScript.js '.'"'.$theme.'" > model/file.txt';

    $nbTry = 0;
    $currentSize = 0;
    $wantedSize = 25;
    $giving_auth1 = shell_exec("chmod 777 model/outputs/*");
    // Cleaning the file containing the urls of the images
    file_put_contents("model/file.txt", "");

    $pictureUrls = array();

    // I made several tries because sometimes the first script run is always failing
    while ($nbTry < 10 && $currentSize < $wantedSize) {
        // Here we run the phantomJS script (assuming phantom is correctly installed on the vps) and we store the logs in a variable
        $logScriptPhantom = shell_exec($runScriptCommand);
        sleep(2);

        // Then we parse the logs to get the url of the images and we store them in a variable
        // $pictureUrls = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $logScriptPhantom, -1, PREG_SPLIT_NO_EMPTY);
        $pictureUrls = file("model/file.txt", FILE_IGNORE_NEW_LINES);

        // the following variable contains the number of images found
        $pictureUrlsSize = count($pictureUrls);

        $currentSize = $pictureUrlsSize;

        // FOR TESTING :
        // echo '<p>current size = '.$currentSize.'</p>';
        // echo '<p>nb try = '.$nbTry.'</p>';
        // echo '<p>urls are = <br>';
        // var_dump($pictureUrls);
        // echo '</p>';
        $nbTry++;
    }

    // NB : SO WE NEED THE LOGS (and the console.log(url[i]) etc) TO GET THE URLS INSIDE PHP VARIABLES


    return $pictureUrls;
}


// FOR TESTING the function :
// $testResult = runPhantomScript("++++++++++++Avignon+:+le+réseau+Orange+victime+d'une+coupure++++++++");
// var_dump( $testResult);


