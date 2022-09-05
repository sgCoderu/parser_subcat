<?php

# Supports PHP 7.3

ini_set('max_execution_time', 300);

require_once 'phpQuery.php';

function get_category($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl);
    curl_close($curl);

    $pq = phpQuery::newDocument($content);

    $category_links = $pq->find('.pane-catalog-elements-panel-pane-1')->find('a');
    foreach ($category_links as $item)
    {
        echo(mb_strtoupper("<h4 style='color: red;'>".pq($item)->html())."</h4>");
        get_subcategory('https://ivtextil.ru/'.pq($item)->attr('href'));
	}
}

function get_subcategory($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl);
    curl_close($curl);

    $pq = phpQuery::newDocument($content);

    $subcategory_links = $pq->find('.pane-subcategories-panel-pane-1')->find('a');
    foreach ($subcategory_links as $item)
    {
        print_r(pq($item)->html()."<br>");
	}
}

get_category('https://ivtextil.ru/');
