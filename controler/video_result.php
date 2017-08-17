<?php
include("model/createSoundFile.php");


// First we retrieve the POST variables send by the video_generation page
$cursor = 0;
$limit = 30;
$finalText = "";
for ($i=0; $i < $limit; $i++) {
    $currentName = 'p'.$cursor;
    if (isset($_POST["$currentName"])) {
        $finalText = $finalText.' '.$_POST["$currentName"];
    }
    $cursor++;
}
// Now the variable $finalText contains the complete string

// Here we create the sound File from the final text

$foo = createSoundFile($finalText);



// Displaying the view :
include_once('view/video_result.php');