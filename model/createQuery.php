<?php


function createQuery($searchContent, $separator) {
    $keywords = explode(' ', $searchContent);
    $keywords_size = count($keywords);
    if ($keywords_size != 0) {
        $query = $keywords[0];
        for ($i=1; $i < $keywords_size; $i++) { 
            $query = $query.$separator.$keywords[$i];
        }
        return $query;
    }
    else {
        return "";
    } 
}

// Uncomment those lines to TEST the function :)
// $query_test = "james bond action movie";
// $separator = "+";
// $result = createQuery($query_test, $separator);
// echo '<h1>'.$result.'</h1>';
