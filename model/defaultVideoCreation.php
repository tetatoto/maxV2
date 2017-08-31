<?php

// the goal of this function is to generate a video automatically with the default parameters 
// So the user just has to enter his search and max will make default choices for the text selection, the image selection, etc
// This function will be useful for JARVIS

include_once("getArticleList.php");
include_once("getPageContent.php");
include_once("getTextOfArticle.php");
include_once("runPhantomScript.php");
include_once("createQuery.php");
include_once("getPictures.php");
include_once("createSoundFile.php");
include_once("runAddPicturesScript.php");
include_once("resizePictures.php");

function defaultVideoCreation($searchContent) {
    $isWorking = true;

    // SET OF DEFAULT PARAMETERS
    $nbPicturesMax = 10;
    $nbPicturesOnVideo = 3;
    $maxWordsOnParagraph = 35;
    $gender = 'female';
    $subtitles = 'no';


    // First we get the list of articles found by Max on the choosen subject (we just choose the first one)
    $maxArticles = 5;
    $articles = getArticleList($searchContent, $maxArticles);
    $nbArticles = count($articles);

    if ($nbArticles < 1) {
        $isWorking = false;
        return $isWorking;
    }
    else {
        $articleTitle = $articles[0]['title'];
        $articleUrl = $articles[0]['url'];

        // We retrieve the text of the article
        $articleDom = getPageContent($articleUrl);
        $paragraphs = getTextOfArticle($articleDom);

        if (empty($paragraphs)) {
            // There is no text available, we end the function
            $isWorking = false;
            return $isWorking;
        }
        else {
            // There is some text available - so we can search for images
            // We can then search for images : (the second parameter in the call to getPictures is the number of images we want to DL)
            $theme = "";
            $theme = createQuery($articleTitle, '+');

            $pictureUrls = runPhantomScript(htmlspecialchars($theme));

            // DOWNLOADING (The following variable is the number of pictures actually downloaded)
            $nbPicturesDl = getPictures($pictureUrls, $nbPicturesMax);

            // RESIZING
            $resultResizing = resizePictures(330, 220);

            if ($nbPicturesDl < 3) {
                // Not enough images were found, we end the function
                $isWorking = false;
                return $isWorking;
            }
            else {
                // We retrieve the text of the paragraphs with a size > $maxWordsOnParagraph words
                $finalTextForVideo = "";
                foreach ($paragraphs as $paragraph) {
                    if ($paragraph['size'] > $maxWordsOnParagraph) {
                        $finalTextForVideo = $finalTextForVideo.' '.$paragraph['text'];
                    }
                }
                // Then the variable $finalTextForVideo contains the final script for the video

                // Now we create an array $selectedImages containing all the path to the wanted images (we will take the $nbPicturesOnVideo first ones)
                $selectedImages = array();
                for ($i=0; $i < $nbPicturesOnVideo; $i++) { 
                    $currentImageName = 'model/outputs/image'.$i.'.jpg';
                    array_push($selectedImages, $currentImageName);
                }
                $nbSelectedImages = count($selectedImages);


                // Here we create the sound file from the script contained in the variable
                $logSound = createSoundFile($finalTextForVideo);

                // A bit of cleaning : the old mp4 files and the mylist containing the number of time the template should be looped
                $cleaningOldMovieFiles = shell_exec("rm -rf model/outputs/*.mp4");
                $cleaningMylistFile = file_put_contents("model/mylist.txt", "");

                // Run script create template with right duration & sound (absolute path seems to be necessary here ...)
                $runVideoCreationScript = shell_exec("/var/www/html/maxV2/model/videoCreationScript.sh ".$gender);

                // RUn script that add the selected images to the video
                $runAddPicturesScript = runAddPicturesScript($selectedImages);

                return $isWorking;

            }
        }
    }



}