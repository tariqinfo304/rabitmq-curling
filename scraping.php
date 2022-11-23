<?php 
require_once __DIR__ . '/vendor/autoload.php';
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


$client = new Client();


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
});


?>