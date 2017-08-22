#!/bin/bash

video_duration="$(mp3info -p "%S\n" outputs/soundFile.mp3)"

echo "***************************************************************"
echo "STARTING THE GENERATION OF THE FULL VIDEO"
echo "_______________________________________________________________"
echo "The duration of the video is $video_duration seconds "


# FIRST STEP : creating a loop with the template video in order to reach the right duration (given in argument)

let 'template_duration=13'
let 'current_duration=0'

echo "The duration of the template is $template_duration seconds"
echo "_______________________________________________________________"

rm -rf generated_video_step1.mp4
rm -rf generated_video_step2.mp4

# 1.1 // loop to get the full duration video

# Initiate the final video with the right duration looping the template

while [ $current_duration -lt $video_duration ]
do 
	printf "file '%s'\n" outputs/template_woman.mp4 >> mylist.txt;
	((current_duration=current_duration+template_duration))
	#echo "current duration is $current_duration"

done

ffmpeg -y -f concat -i mylist.txt -c copy outputs/generated_video_step1.mp4

echo "final duration is $current_duration"

# 1.2 // Adding the sound file to the video

ffmpeg -y -i "outputs/generated_video_step1.mp4" -i "outputs/soundFile.mp3" -c copy -shortest -map 0:v0 -map 1:a:0 "outputs/generated_video_step2.mp4"