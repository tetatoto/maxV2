<?php
require('vendor/autoload.php');

// API Youtube data

$clientID =  "971828143374-0d0fn2ao293mlcg99kvo42ibeqg03jcv.apps.googleusercontent.com";
$clientSecret = "z3V_PosIm0VhLkvUgRsgmcmy";

$client = new Google_Client();
$client->setClientId($clientID);
$client->setCLientSecret($clientSecret);
$client->setRedirectUri('http://vps441713.ovh.net/maxV2/youtubeAPI.php');
$client->setScopes('https://googleapis.com/auth/youtube');

$youtube = new Google_Service_Youtube($client);





?>

<h2>Accès interdit</h2>

<p>Vous devez <a href="<?php $client->createAuthUrl(); ?>">autorisez</a> autorisez  l'appli a acceder a votre compte youtube</p>

