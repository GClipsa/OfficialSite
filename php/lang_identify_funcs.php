<?php
require_once 'geturlquery.php';

function lang_ml_header()
{
    $lang = getUrlQuery("lang");
    if($lang == "ru")
    {
        $ml_header = R::getAssoc('SELECT identify, ru_text FROM ml_header');
    }
    else if($lang == "en")
    {
        $ml_header = R::getAssoc('SELECT identify, en_text FROM ml_header');
    }
    else
    {
        $ml_header = R::getAssoc('SELECT identify, en_text FROM ml_header'); $lang = "en";
    }
    $ml_header_link = R::getAssoc('SELECT identify, link FROM ml_header');
    $ml_headers = [$ml_header, $ml_header_link, $lang];
    return $ml_headers;
}
?>