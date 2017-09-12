<?php

function createZoom($pathToPicture, $nameZoomResult, $zoomDuration) {
    // $pathToPicture is a String containing the path to the initial picture
    // $nameZoomResult is a string containing the name you want to give to the video resulting
    // $zoomDuration is a integer setting the duration (in seconds) of the zooming effect

    $commandLine = "ffmpeg -loop 1 -i ".$pathToPicture." -vf \"zoompan=z='if(lte(zoom,1.0),1.5,max(1.001,zoom-0.0015))':d=125\" -c:v libx264 -t ".$zoomDuration." -s \"640x360\" model/outputs/".$nameZoomResult;
}