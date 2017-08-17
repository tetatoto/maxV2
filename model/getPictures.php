<?php

include("runPhantomScript.php");

// We suppose that the variable $theme is already on the format of a query (james+bond+daniel+craig for example)
// The variable $number is the number of images you want ot download

function getPictures($pictureUrls, $number) {

    // the following variable contains the number of images found
    $pictureUrlsSize = count($pictureUrls);

    // We clean the repo containing the previous images
    $cleaningRepo = shell_exec('rm -rf outputs/*.jpg');

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
        $giving_auth = shell_exec('chmod 777 outputs/*.jpg');
        $current++;
    }

    return $pictureUrlsSize;


}



// test of this function
$test_func = getPictures("james+bond+daniel+craig", 15);
echo '<h1>  test '.$test_func.' srx</h1>';