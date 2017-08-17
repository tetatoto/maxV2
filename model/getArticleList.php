<?php
include_once("simple_html_dom.php");
include_once("getPageContent.php");
include_once("createQuery.php");

function getArticleList($search_content, $nbArticles) {
    // Here we are searching on the Orange Moteur de recherche
    $query1 = createQuery($search_content, '%20');
    $query2 = 'http://lemoteur.orange.fr/?module=lemoteur&bhv=actu&kw='.$query1;
    // The DOM variable contains the DOM of the search result
    $dom = getPageContent($query2);

    $articles = array();
    $cursor = 0;
    foreach ($dom->find('div.entry') as $articleContent) {
        $articleText = $articleContent->plaintext;
        $articleLink = $articleContent->find('a')[0];
        $articleTitle = $articleLink->plaintext;
        $articleUrl = $articleContent->find('a')[0]->href;

        $articleArray = [
            "text" => $articleText,
            "link" => $articleLink,
            "title" => $articleTitle,
            "url" => $articleUrl,
        ];

        array_push($articles, $articleArray);
        $cursor++;
        if ($cursor > $nbArticles) {
            break;
        }
    }

    return $articles;

}