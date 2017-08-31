<?php

// Global controler : entry of the web application
// It will redirect with GET values to the right pages of the website
// Whenever you want to call an other view, you should call this : index.php?section=<the page you want> 
if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once('controler/index.php');
}
elseif ($_GET['section'] == 'about') {
    include_once('controler/about.php');
}
elseif ($_GET['section'] == 'contact') {
    include_once('controler/contact.php');
}
elseif ($_GET['section'] == 'video_generation') {
    include_once('controler/video_generation.php');
}
elseif ($_GET['section'] == 'video_view_articles') {
    include_once('controler/video_view_articles.php');
}
elseif ($_GET['section'] == 'video') {
    include_once('controler/video.php');
}
elseif ($_GET['section'] == 'video_result') {
    include_once('controler/video_result.php');
}
elseif ($_GET['section'] == 'video_upload') {
    include_once('controler/video_upload.php');
}
elseif ($_GET['section'] == 'video_default_result') {
    include_once('controler/video_default_result.php');
}