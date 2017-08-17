<?php

include_once('model/getPageContent.php');
include_once('model/simple_html_dom.php');
include_once('model/createQuery.php');
include_once("model/urlExists.php");
include_once("model/getTextOfArticle.php");

// First we retrieve the POST variables send by the video_view_article page
// $link = $_POST['link'];
// $text = $_POST['text'];
// $title = $_POST['title'];
$url = $_POST['url'];

// Check if Url not valid or valid
$konotko = urlExists($url);

// Initiating the variables that will contain the text paragraphs of the article
$paragraphs = array();


// If the Url exists, we can do the work; else we display the page (which will adapt)
if ($konotko) {
    // Then we retrieve the text of the article by parsing its webpage
    $articleDom = getPageContent($url);
    $paragraphs = getTextOfArticle($articleDom);

}




// Displaying the view :
include_once('view/video_generation.php');