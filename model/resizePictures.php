<?php

// This function takes 2 arguments : the height and the width you want for your pictures
// It resizes every JPG file in the model/outputs/ directory

function resizePictures($width, $height) {
    // $give_auth = shell_exec("chmod 777 model/outputs/*");
    $commandLine = 'mogrify -resize '.$width.'x'.$height.' model/outputs/*.jpg';
    $runCommand = shell_exec($commandLine);

    // Example of command : mogrify -resize 320x210 picture_outputs/*.jpg
}

