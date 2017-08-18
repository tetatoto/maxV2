<?php

include_once('model/getPageContent.php');
include_once('model/simple_html_dom.php');
include_once('model/createQuery.php');
include_once("model/urlExists.php");
include_once("model/getTextOfArticle.php");
include_once("model/getPictures.php");
include_once("model/runPhantomScript.php");
include_once("model/resizePictures.php");

// First we retrieve the POST variables send by the video_view_article page
// $link = $_POST['link'];
// $text = $_POST['text'];
// $title = $_POST['title'];
$url = $_POST['url'];

// The following variable "theme" is the one which will be send as a query for the image search
// If there is a title available then it will be the query, else it will only be the url
$theme = "";
if (isset($_POST['title'])) {
    $theme = createQuery($_POST['title'], '+');
}
else {
    $theme = $url;
}

// Check if Url not valid or valid
$konotko = urlExists($url);

// Initiating the variables that will contain the text paragraphs of the article
$paragraphs = array();

$pictureUrls = array();
// $pictureUrls_bis = array();


// If the Url exists, we can do the work; else we display the page (which will adapt)
if ($konotko) {
    // Then we retrieve the text of the article by parsing its webpage
    $articleDom = getPageContent($url);
    $paragraphs = getTextOfArticle($articleDom);

    // We can then search for images : (the second parameter in the call to getPictures is the number of images we want to DL)
    $pictureUrls = runPhantomScript(htmlspecialchars($theme));

    // DOWNLOADING (The following variable is the number of pictures actually downloaded)
    $nbPicturesDl = getPictures($pictureUrls, 20);

    // RESIZING
    $resultResizing = resizePictures(320, 210);

}




// Displaying the view :
include_once('view/video_generation.php');