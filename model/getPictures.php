<?php



// We suppose that the variable $theme is already on the format of a query (james+bond+daniel+craig for example)
// The variable $number is the number of images you want ot download

function getPictures($theme, $number) {
    $runScriptCommand = 'phantomjs script3.js '.'"'.$theme.'"';
    // Here we run the phantomJS script (assuming it is correctly installed on the vps) and we store the logs in a variable
    $logScriptPhantom = shell_exec($runScriptCommand);

    // Then we parse the logs to get the url of the images and we store them in a variable
    $pictureUrls = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $logScriptPhantom, -1, PREG_SPLIT_NO_EMPTY);

    // NB : SO WE NEED THE LOGS (and the console.log(url[i]) etc) TO GET THE URLS INSIDE PHP VARIABLES

    // the following variable contains the number of images found
    $pictureUrlsSize = count($pictureUrls);

    // Then we download only the images than are .jpg format
    $cursor = 0;
    $current = 0;
    while ($cursor < $number && $current < $pictureUrlsSize) {
        $currentUrl = $pictureUrls[$current];
        $last4char = substr($currentUrl, -4);

        if ($last4char == ".jpg") {
            $pictureName = 'outputs/image'.$cursor.'.jpg';
            // Then downloading the image using CURL
            $ch = curl_init($currentUrl);
            $fp = fopen($pictureName, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            $cursor++;
        }

        $current++;
    }

}