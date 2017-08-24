<?php
include("voicerss_tts.php");

function createSoundFile($finalText) {
    $tts = new VoiceRSS;
    $voice = $tts->speech([
        'key' => 'b3a50426f7914067aa6d40ce1d46ae71',
        'hl' => 'fr-ca',
        'src' => $finalText,
        'r' => '0',
        'c' => 'mp3',
        'f' => '44khz_16bit_stereo',
        'ssml' => 'false',
        'b64' => 'true'
    ]);
    
    // We clean the repo to erase the previous sound files
    $supprOldFile = shell_exec("rm -rf model/outputs/soundFile.mp3");
    // We create the new sound File corresponding to the new text
    file_put_contents('model/outputs/soundFile.mp3', base64_decode($voice['response']));
    // We put the right of the file to 777
    $giving_auth = shell_exec("chmod 777 model/outputs/*");
}