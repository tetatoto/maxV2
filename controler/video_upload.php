<?php

require('vendor/autoload.php');

session_start();



if (isset($_POST['youtubeDescription'])) {
    $_SESSION['youtubeDescription'] = $_POST['youtubeDescription'];
}
if (isset($_POST['youtubePrivacy'])) {
    $_SESSION['youtubePrivacy'] = $_POST['youtubePrivacy'];
}
if (isset($_POST['youtubeTitle'])) {
    $_SESSION['youtubeTitle'] = $_POST['youtubeTitle'];
}
if (isset($_POST['youtubeCategoryId'])) {
    $_SESSION['youtubeCategoryId'] = (int)$_POST['youtubeCategoryId'];
}

// The variable $access will contain a boolean indicating if the user is logged into its Google account or not.
// It will depend on thepresence of the access token which is created by logging into a google account in the url created by the function $client->createAuthUrl();
// Once you are logged in, it will redirect you to the "redirectUrl" you choose when setting the $client->setRedirectUri() AND in you google developer Oauth Console.
// REMEMBER THAT YOU HAVE TO SET BOTH the $client->setRedirectUri() AND the redirect url input in the google developer Oauth Console

$access = false;

// API Youtube data
// Information about the API : https://developers.google.com/youtube/v3/code_samples/php#upload_a_video
// You will have to get your own 3 keys that are there :

$apiKey = "AIzaSyCM4hG8lmXY8sZDatjaElYZVfroUY2sKnE";
$clientID =  "971828143374-0d0fn2ao293mlcg99kvo42ibeqg03jcv.apps.googleusercontent.com";
$clientSecret = "z3V_PosIm0VhLkvUgRsgmcmy";

$client = new Google_Client();
$client->setDeveloperKey($apiKey);
$client->setClientId($clientID);
$client->setCLientSecret($clientSecret);
$client->setRedirectUri('http://vps441713.ovh.net/maxV2/index.php?section=video_upload');
$client->setScopes('https://www.googleapis.com/auth/youtube');


$youtube = new Google_Service_YouTube($client);

// session_start();

$loginUrl = $client->createAuthUrl();

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
}

if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);
}


if ($client->getAccessToken()) {
    $snippet = new Google_Service_YouTube_VideoSnippet();
    $snippet->setTitle($_SESSION['youtubeTitle']);
    $snippet->setDescription($_SESSION['youtubeDescription']);
    $snippet->setTags(['automation','news','IA']);
    $snippet->setCategoryId($_SESSION['youtubeCategoryId']);

    $status = new Google_Service_YouTube_VideoStatus(); 
    $status->setPrivacyStatus($_SESSION['youtubePrivacy']);
    

    $video = new Google_Service_YouTube_Video();
    $video->setSnippet($snippet);
    $video->setStatus($status);

    // This parameter block the request the time you want in order to set the parameters and to upload the media
    $client->setDefer(true);

    $request = $youtube->videos->insert("status,snippet", $video);




    // $file = dirname(__DIR__).'video.mp4';
    $filePath = '/var/www/html/maxV2/model/outputs/'.$_SESSION['videoNameToUpload'];

    // The way we use to upload the media is chunk by chunk (it is the only working way I found)
    $chunkSizeBytes = 1 * 1024 * 1024;


    // $media = new Google_Http_MediaFileUpload($client, $request, 'video/*', file_get_contents($file));
    $media = new Google_Http_MediaFileUpload(
        $client,
        $request,
        'video/*',
        null,
        true,
        $chunkSizeBytes
    );
    $media->setFileSize(filesize($filePath));

    //  Read the media file and upload it chunk by chunk.
    $status = false;
    $handle = fopen($filePath, "rb");
    while (!$status && !feof($handle)) {
      $chunk = fread($handle, $chunkSizeBytes);
      $status = $media->nextChunk($chunk);
    }

    fclose($handle);
    $client->setDefer(false);

    $access = true;

} else {
    
    $access = false;
    
}



// Displaying the view :
include_once('view/video_upload.php');