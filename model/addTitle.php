<?php

// This function add a title to the video given in argument

function addTitle($videoPath, $videoResultName, $title) {
    // $videoPath is a String containing the path to the video we want to add a title
    // $videoResultName is a String containing the name of the resulting video
    // $title is a String containing the title we want for the video

    $commandLine = "ffmpeg -i ".$videoPath." -preset ultrafast -vf drawtext=\"fontfile=model/templates/arial.ttf: text=".$title.": fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5: boxborderw=5: x=10: y=330\" -codec:a copy model/outputs/".$videoResultName;

    // We run FFMPEG to add a title on the video 
    $concatenateLogs = shell_exec($commandLine);

    return $concatenateLogs;

}



// NB :
// ffmpeg -i input.mp4 -vf drawtext="fontfile=model/templates/arial.ttf: \
// text='Stack Overflow': fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5: \
// boxborderw=5: x=(w-text_w)/2: y=(h-text_h)/2" -codec:a copy output.mp4

//     The @0.5 controls the opacity of the text box. In this example it is set to 50%. You can remove @0.5 and there will be no transparency.

//     -codec:a copy will stream copy (re-mux) the audio and avoid re-encoding.

//     An alternative to the drawtext filter is to use ASS or SRT subtitles–especially if you want timed text or softsubs.

//     If you want to update or change the text see the textfile and reload options for this filter.

//     This filter requires your ffmpeg to be compiled with --enable-libfreetype. If you get No such filter: 'drawtext' it is probably missing --enable-libfreetype. Most of the ffmpeg static builds available support this, so see the FFmpeg Download page for links.

//     See the drawtext filter documentation for more options and examples.



// x=(w-text_w)/2: y=(h-text_h)/2\