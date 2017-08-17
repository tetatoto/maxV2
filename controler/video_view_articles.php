<?php

include_once('model/getArticleList.php');
include_once('model/getPageContent.php');
include_once('model/simple_html_dom.php');
include_once('model/createQuery.php');
$searchContent = $_POST['searchContent'];
$maxArticles = 10;
$articles = getArticleList($searchContent, $maxArticles);
$nbArticles = count($articles);


// Displaying the view 
include_once('view/video_view_articles.php');