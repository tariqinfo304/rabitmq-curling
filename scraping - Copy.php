<?php 
require_once __DIR__ . '/vendor/autoload.php';
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


$client = new Client();

echo "<pre>";
$i =0 ;
$crawler = $client->request('GET', 'https://highload.today/uk/category/novyny/');
// Get the latest post in this category and display the titles


function process_object($node)
{
	$_crawler = new Crawler($node->html());
    $heading = $_crawler->filter("h2");
    
    $heading->each(function($_node){
    	echo $_node->text();
    	echo "<br/>";
    });

    $pics = $_crawler->filter('.lenta-image noscript');
    $pics->each(function ($node1){
			$img = $node1->html();
			preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $img, $result);
			$img =  array_pop($result);
			echo $img;
			echo "<br/>";
	});

    $j = 0;
	$node->each(function ($node2){

		global $j;

		$_desc = $node2->text();
		if($j == 0 )
		{
			$j=1;
		}
		else
		{
			echo $_desc;
			echo "<br/>";
		}
			
	});


	$date = $_crawler->filter('.meta-datetime');
	$date->each(function ($node){
		$_date = $node->text();
		echo $_date;
		echo "<br/>";
	});
}


$crawler->filter('.lenta-item')->each(function($node, $i){
	process_object($node);
})



/*
$heading = $crawler->filter('.lenta-item  h2');
$pics = $crawler->filter('.lenta-item .lenta-image noscript');
$desc = $crawler->filter('.lenta-item');
$date = $crawler->filter('.lenta-item .meta-datetime');


$list = [];

$i=0;
$heading->each(function ($node){
	
	global $i,$list;
	$list[$i]["title"]=$node->text();
	$i++;
});

$i=0;
$pics->each(function ($node){

		global $i,$list;
		$img = $node->html();
		preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $img, $result);
		$img =  array_pop($result);
		$list[$i]["img"]=  $img;
		$i++;
});

$i=0;

$date->each(function ($node){

	global $i,$list;

		$_date = $node->text();
		$list[$i]["date"]= $_date;
		$i++;
});


$i=0;
$j = 0;
$desc->each(function ($node){

	global $i,$list,$j;

		$_desc = $node->text();
		if($j == 0 )
		{
			$j=1;
		}
		else
		{
			$list[$i]["desc"] = $_desc;
			$i++;
		}
		
});


print_r($list);*/






?>