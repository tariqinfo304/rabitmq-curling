<?php 
require_once __DIR__ . '/vendor/autoload.php';
include "db.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$obj = [
    "title" => "",
    "pic" => "",
    "desc" => "",
    "date" => ""
];


function process_object($node)
{
  global $obj;
  
  $_crawler = new Crawler($node);
    $heading = $_crawler->filter("h2");
    
    $heading->each(function($node4){

      global $obj;
      $obj["title"] = $node4->text();
    });

    $pics = $_crawler->filter('.lenta-image noscript');
    $pics->each(function ($node1){
      global $obj;
      $img = $node1->html();
      preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $img, $result);
      $img =  array_pop($result);
      $obj["pic"] = $img;

  });
 $node = new Crawler($node);
    $j = 0;
  $node->each(function ($node2){
    global $obj;
    global $j;

    $_desc = $node2->text();
    if($j == 0 )
    {
      $j=1;
    }
    else
    {
      $obj["desc"] = $_desc;
  
    } 
  });


  $date = $_crawler->filter('.meta-datetime');
  $date->each(function ($node){
    global $obj;
    $_date = $node->text();
    $obj["date"] = $_date;
    
  });
}

$callback = function ($msg) {

  global $obj;

  process_object(unserialize($msg->body));

  add_news_data($obj);
  $obj  = [
   "title" => "",
   "pic" => "",
   "desc" => "",
   "date" => ""
  ];
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}
?>