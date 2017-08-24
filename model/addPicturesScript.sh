#!/bin/bash


# we iterate over the arguments given to the script

# Simple example :
# for var in "$@"
# do
#     echo "$var"
# done
# 
# When running :
# sh test.sh 1 2 '3 4'
# 1
# 2
# 3 4

# NB : 
# Step 1 : generate a template with a duration close to the sound file duration
# Step 2 : adding a sound on this template
# Step 3 : adding images to the video

video_duration="$(mp3info -p "%S\n" model/outputs/soundFile.mp3)"

let 'current_timeline=0'
let 'limit=video_duration-10'
let 'next=10'
let 'cursor=2'

for picturePath in "$@"
do
    echo "$picturePath";
    if [ $current_timeline -lt $limit ]
    then
        ffmpeg -y -i model/outputs/generated_video_step2.mp4 -i "$picturePath" -filter_complex "[0:v][1:v] overlay=640-320-0:0:enable='between(t,${current_timeline},${next})'" -pix_fmt yuv420p -c:a copy model/outputs/generated_video_step2.mp4;
        ((current_timeline=current_timeline+10));
        ((next=next+10));
    fi
done