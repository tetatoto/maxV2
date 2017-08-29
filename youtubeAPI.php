<h2>Youtube APi test</h2>

<?php
require('vendor/autoload.php');

// API Youtube data

$apiKey = "AIzaSyCM4hG8lmXY8sZDatjaElYZVfroUY2sKnE";
$clientID =  "971828143374-0d0fn2ao293mlcg99kvo42ibeqg03jcv.apps.googleusercontent.com";
$clientSecret = "z3V_PosIm0VhLkvUgRsgmcmy";

$client = new Google_Client();
$client->setDeveloperKey($apiKey);
$client->setClientId($clientID);
$client->setCLientSecret($clientSecret);
$client->setRedirectUri('http://vps441713.ovh.net/maxV2/youtubeAPI.php');
$client->setScopes('https://googleapis.com/auth/youtube');

$youtube = new Google_Service_YouTube($client);

$loginUrl = $client->createAuthUrl();



?>

<h2>Accès interdit</h2>

<p>Vous devez <a href="<?= $loginUrl; ?>">autorisez</a>   l'appli a acceder a votre compte youtube</p>

