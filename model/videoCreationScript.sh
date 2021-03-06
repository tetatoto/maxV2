#!/bin/bash

video_duration="$(mp3info -p "%S\n" model/outputs/soundFile.mp3)"

echo "***************************************************************"
echo "STARTING THE GENERATION OF THE FULL VIDEO"
echo "_______________________________________________________________"
echo "The duration of the video is $video_duration seconds "

gender='woman'
# knowing the argument fot the template : wowan or man (the default answer is female)
if [ $1 = "female" ]
then
	gender='woman02';
elif [ $1 = "male" ]
then
	gender='man';
elif [ $1 = "female2" ]
then
	gender='woman3';
else
	gender='woman';
fi

# FIRST STEP : creating a loop with the template video in order to reach the right duration (given in argument)

template_duration="$(mediainfo --Inform="Video;%Duration%"  model/templates/template_${gender}.mp4)"
let 'template_duration=template_duration/1000' # because the result is on ms and we want seconds
let 'current_duration=0'

echo "The duration of the template is $template_duration seconds"
echo "_______________________________________________________________"

# rm -rf model/outputs/generated_video_step1.mp4
# rm -rf model/outputs/generated_video_step2.mp4

# 1.1 // loop to get the full duration video



# Initiate the final video with the right duration looping the template

while [ $current_duration -lt $video_duration ]
do 
	printf "file '%s'\n" "templates/template_${gender}.mp4" >> model/mylist.txt;
	((current_duration=current_duration+template_duration))
	#echo "current duration is $current_duration"

done

ffmpeg -y -f concat -i model/mylist.txt -c copy model/outputs/generated_video_step1.mp4

echo "final duration is $current_duration"

# 1.2 // Adding the sound file to the video

ffmpeg -y -i "model/outputs/generated_video_step1.mp4" -i "model/outputs/soundFile.mp3" -c copy -shortest -map 0:v0 -map 1:a:0 "model/outputs/generated_video_step2.mp4"


# Giving rights to the videos
chmod 777 model/outputs/*.mp4