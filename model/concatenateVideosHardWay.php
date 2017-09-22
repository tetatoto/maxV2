<?php



function concatenateVideosHardWay($videos, $videoResultName) {
    // $videos is an array containing the path of the videos to concatenate
    // $videoResultName is a String containing the name of the resulting video
    
    if (count($videos) != 2) {
        return "error : wrong inputs, only two videos are possible for this method";
    }
    else {

        $input1 = $videos[0];
        $input2 = $videos[1];

        // We run FFMPEG to concatenate the videos listed in the file
        // $concatenateLogs = shell_exec("ffmpeg -auto_convert 1 -f concat -i model/videosToConcatenate.txt -c copy model/outputs/".$videoResultName);
        $command1 = "ffmpeg -i ".$input1." -c copy -bsf:v h264_mp4toannexb -f mpegts model/outputs/intermediate1.ts";
        $command2 = "ffmpeg -i ".$input2." -c copy -bsf:v h264_mp4toannexb -f mpegts model/outputs/intermediate2.ts";
        $command3 = "ffmpeg -i \"concat:model/outputs/intermediate1.ts|model/outputs/intermediate2.ts\" -c copy -bsf:a aac_adtstoasc model/outputs/".$videoResultName;

        $logs1 = shell_exec($command1);
        $logs2 = shell_exec($command2);
        $logs3 = shell_exec($command3);

        return $logs3;
    }

}