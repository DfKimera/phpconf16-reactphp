<?php
include("vendor/autoload.php");

$loop = React\EventLoop\Factory::create();
$source = new React\Stream\Stream(fopen('php://stdin', 'r'), $loop);

$server = stream_socket_server('tcp://127.0.0.1:8080');
stream_set_blocking($server, 0);

$loop->addReadStream($server, function ($server) use ($loop, $source) {

	$conn = stream_socket_accept($server);
	$destination = new React\Stream\Stream($conn, $loop);

	$source->pipe($destination);

});

$loop->run();
