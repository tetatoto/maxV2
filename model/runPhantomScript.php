<?php


//include("phantomScript.js");
// We suppose that the variable $theme is already on the format of a query (james+bond+daniel+craig for example)

function runPhantomScript($theme) {
    $runScriptCommand = 'phantomjs phantomScript.js '.'"'.$theme.'"';

    $nbTry = 0;
    $currentSize = 0;
    $wantedSize = 25;
    $giving_auth1 = shell_exec('chmod 777 *');
    $giving_auth2 = shell_exec('chmod 777 outputs/*');
    $pictureUrls = array();

    while ($nbTry < 5 && $currentSize < $wantedSize) {
        // Here we run the phantomJS script (assuming phantom is correctly installed on the vps) and we store the logs in a variable
        $logScriptPhantom = shell_exec($runScriptCommand);

        // Then we parse the logs to get the url of the images and we store them in a variable
        $pictureUrls = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $logScriptPhantom, -1, PREG_SPLIT_NO_EMPTY);

        // the following variable contains the number of images found
        $pictureUrlsSize = count($pictureUrls);

        $currentSize = $pictureUrlsSize;
        echo '<p>wanted size = '.$wantedSize.'</p>';
        echo '<p>nb try = '.$nbTry.'</p>';
        $nbTry++;
    }

    // // Here we run the phantomJS script (assuming phantom is correctly installed on the vps) and we store the logs in a variable
    // $logScriptPhantom = shell_exec($runScriptCommand);

    // // Then we parse the logs to get the url of the images and we store them in a variable
    // $pictureUrls = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $logScriptPhantom, -1, PREG_SPLIT_NO_EMPTY);

    // // NB : SO WE NEED THE LOGS (and the console.log(url[i]) etc) TO GET THE URLS INSIDE PHP VARIABLES

    // // the following variable contains the number of images found
    // $pictureUrlsSize = count($pictureUrls);

    return $pictureUrls;
}


// test the function :
$testResult1 = runPhantomScript("++++++++++++Avignon+:+le+réseau+Orange+victime+d'une+coupure++++++++");
var_dump( $testResult1);
echo 'booo';
echo 'boo';
echo '4';

