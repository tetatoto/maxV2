<?php
include("model/createSoundFile.php");
include("model/runAddPicturesScript.php");
require('vendor/autoload.php');


// First we retrieve the POST variables send by the video_generation page

// BEGIN retrieving the TEXT
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
// END retrieving the TEXT

// BEGIN Now we retrieve the images 
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
// END retrieving images


// Here we create the sound File from the final text
$logSound = createSoundFile($finalText);

// BEGIN we retrieve the options : with / without subtitles and female / male
if (isset($_POST['female'])) {
    $gender = $_POST['female']; // This will contain "female" 
}
elseif (isset($_POST['male'])) {
    $gender = $_POST['male']; // This will contain "male"
}
else {
    $gender = 'female'; // Default Option (as the voice is currently a feminine voice ...)
}


// $gender = $_POST['gender']; 
$subtitles = $_POST['subtitles']; // This will contain "yes" or "no"
// END


// A bit of cleaning : the old mp4 files and the mylist containing the number of time the template should be looped
$cleaningOldMovieFiles = shell_exec("rm -rf model/outputs/*.mp4");
$cleaningMylistFile = file_put_contents("model/mylist.txt", "");

// Run script create template with right duration & sound (absolute path seems to be necessary here ...)
$runVideoCreationScript = shell_exec("/var/www/html/maxV2/model/videoCreationScript.sh ".$gender);

// RUn script that add the selected images to the video
$runAddPicturesScript = runAddPicturesScript($selectedImages);

// API Youtube data // NOT HERE ANYMORE

// $clientID =  "971828143374-0d0fn2ao293mlcg99kvo42ibeqg03jcv.apps.googleusercontent.com";
// $clientSecret = "z3V_PosIm0VhLkvUgRsgmcmy";

// $client = new Google_Client();
// $client->setClientId($clientID);
// $client->setCLientSecret($clientSecret);
// $client->setRedirectUri('');
// $client->setScopes('');

// $youtube = new Google_Service_Youtube($client);




// Displaying the view :
include_once('view/video_result.php');