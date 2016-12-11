<?php
include("vendor/autoload.php");

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket);

$http->on('request', function ($request, $response) {

	$response->writeHead(200, ['Content-Type' => 'text/html']);
	$response->end('<marquee>Hello world!</marquee>');

});

$socket->listen(8080);
$loop->run();
