<?php

// This script concatenate the list of videos of the videosToConcatenate.txt text file, and the resulting vdeo takes the name given as an argument to the function

function concatenateVideos($videos, $videoResultName) {
    // $videos is an array containing the path of the videos to concatenate
    // $videoResultName is a String containing the name of the resulting video

    // We clear the txt file
    file_put_contents("model/videosToConcatenate.txt", "");

    // We open the txt file that will contain the list of the path of the videos we want to concatenate
    $file = fopen("model/videosToConcatenate.txt","a");
    foreach ($videos as $videoPath) {
        fwrite($file,$videoPath.PHP_EOL);
    }
    fclose($file);

    // We run FFMPEG to concatenate the videos listed in the file
    $concatenateLogs = shell_exec("ffmpeg -f concat -i model/videosToConcatenate.txt -c copy model/outputs/".$videoResultName);

    return $concatenateLogs;

}

