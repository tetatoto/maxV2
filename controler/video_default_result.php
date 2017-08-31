<?php

include_once("model/defaultVideoCreation.php");

//  We retrieve the search content, that can comes from JARVIS GET request or from the web IHM through POST.
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

// Then we run the function with the default parameters explained inside the defaultVideoCreation.php file.
// The isWorking variable contains a boolean : true if there was no problem during the video generation, false if there was a problem.
$isWorking = defaultVideoCreation($searchContent);

// Displaying the view :
include_once('view/video_default_result.php');