<?php
include("voicerss_tts.php");

function createSoundFile($finalText) {
    $tts = new VoiceRSS;
    $voice = $tts->speech([
        'key' => 'b3a50426f7914067aa6d40ce1d46ae71',
        'hl' => 'fr-fr',
        'src' => $finalText,
        'r' => '0',
        'c' => 'mp3',
        'f' => '44khz_16bit_stereo',
        'ssml' => 'false',
        'b64' => 'true'
    ]);

    file_put_contents('model/outputs/soundFile.mp3', base64_decode($voice['response']));
}