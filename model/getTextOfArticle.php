<?php
include_once("simple_html_dom.php");
include_once("getPageContent.php");
include_once("createQuery.php");
include_once("urlExists.php");

function getTextOfArticle($articleDom) {
    // This function will return an array of Strings containing the paragraphs of the article
    $paragraphs = array();

    foreach ($articleDom->find('p') as $paragraph) {
        $textParagraph = $paragraph->plaintext;
        $sizeParagraph = str_word_count($textParagraph);

        // We delete the special characters that can affect later the text to speech process
        $textParagraph = str_replace('"', '', $textParagraph);

         $paragraphArray = [
            "text" => $textParagraph,
            "size" => $sizeParagraph,
        ];

        array_push($paragraphs, $paragraphArray);
    }

    return $paragraphs;
}