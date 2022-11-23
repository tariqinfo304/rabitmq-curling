<?php 
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);


$client = new Client();
$crawler = $client->request('GET', 'https://highload.today/uk/category/novyny/');
// Get the latest post in this category and display the titles


$crawler->filter('.lenta-item')->each(function($node, $i){

	global $channel;
	$msg = new AMQPMessage(serialize($node->html()));
	$channel->basic_publish($msg, '', 'hello');
});

$channel->close();
$connection->close();

?>