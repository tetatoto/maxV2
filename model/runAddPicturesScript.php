<?php

// The goal of this function is to run the scipt which add pictures on the video
// The first step is to create a command with all the arguments needed : the paths of the pictures selected by the user

function runAddPicturesScript($selectedImages) {
    $command = '/var/www/html/maxV2/model/addPicturesScript.sh ';

    foreach ($selectedImages as $picturePath) {
        $command = $command.$picturePath.' ';
    }

    $runCommand = shell_exec($command);

    return $runCommand;
}