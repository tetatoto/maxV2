<?php

// This function takes 2 arguments : the height and the width you want for your pictures
// It resizes every JPG file in the model/outputs/ directory

function resizePictures($width, $height) {
    // Converting files to jpg
    $ConvertToJpg = 'mogrify -path model/outputs -format jpg -flatten -quality 100 model/outputs/*.jpg';
    $runConvertToJpg = shell_exec($ConvertToJpg);

    // $give_auth = shell_exec("chmod 777 model/outputs/*");
    $commandLine = 'mogrify -resize '.$width.'x'.$height.' model/outputs/*.jpg';
    $runCommand = shell_exec($commandLine);

    return $runCommand;
    // Example of command : mogrify -resize 320x210 picture_outputs/*.jpg
}

