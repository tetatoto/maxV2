<h2>Youtube APi test</h2>

<?php
require('vendor/autoload.php');



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
$client->setRedirectUri('http://vps441713.ovh.net/maxV2/youtubeAPI.php');
$client->setScopes('https://www.googleapis.com/auth/youtube');


$youtube = new Google_Service_YouTube($client);

session_start();

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
    $snippet->setTitle('max video');
    $snippet->setDescription('video de test');
    $snippet->setTags(['tag1','tag2','tag3']);
    $snippet->setCategoryId(17);

    $status = new Google_Service_YouTube_VideoStatus(); 
    $status->setPrivacyStatus('private');
    

    $video = new Google_Service_YouTube_Video();
    $video->setSnippet($snippet);
    $video->setStatus($status);

    
    $client->setDefer(true);

    $request = $youtube->videos->insert("status,snippet", $video);

    // $file = dirname(__DIR__).'video.mp4';
    $filePath = '/var/www/html/maxV2/model/templates/template_man.mp4';
    // echo file_get_contents($file);

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


    // $video = $client->execute($request);

    // var_dump($video);
    ?>

    <h1>video bien uploadée </h1>
    <p>infos sur la video (var dump video) : <?php //var_dump($video); ?></p>
    <?php



} else {
    ?>
    <h2>Accès interdit</h2>
    <p>Vous devez <a href="<?= $loginUrl; ?>">autorisez</a>   l'appli a acceder a votre compte youtube</p>
    <?php
}
?>



