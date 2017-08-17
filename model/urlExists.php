<?php
function urlExists($url) {
    if(filter_var($url, FILTER_VALIDATE_URL))
    {
        return true;
    }
    else
    {
        return false;
    }
}