<?php

include_once('model/getArticleList.php');
include_once('model/getPageContent.php');
include_once('model/simple_html_dom.php');
include_once('model/createQuery.php');
// $searchContent = $_POST['searchContent'];


// $searchContent will take the POST value if it is set trough the web interface, 
// and the GET value is this is a call from Jarvisjarvis
$searchContent = "";
if (isset($_POST['searchContent'])) {
    $searchContent = $_POST['searchContent'];
}
elseif (isset($_GET['searchContent'])) {
    $searchContent = $_GET['searchContent'];
} 
else {
    $searchContent = "";
}


$maxArticles = 10;
$articles = getArticleList($searchContent, $maxArticles);
$nbArticles = count($articles);


// Displaying the view 
include_once('view/video_view_articles.php');