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

// Now we retrieve the images 
$imageCursor = 0;
$imageLimit = 30;

// This array will contain the names of the images selected by the user
$selectedImages = array();

for ($j=0; $j < $imageLimit; $j++) { 
    $currentImageName = 'model/outputs/image'.$j.'.jpg';
    // inside the post call, the dot "." becomes an underscore "_"
    $currentImagePostName = 'model/outputs/image'.$j.'_jpg';
    if (isset($_POST["$currentImagePostName"])) {
        array_push($selectedImages, $currentImageName);
    }
    $imageCursor++;
}
$nbSelectedImages = count($selectedImages);


// Here we create the sound File from the final text

$logSound = createSoundFile($finalText);



// Displaying the view :
include_once('view/video_result.php');