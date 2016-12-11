<?php
include("vendor/autoload.php");

$loop = React\EventLoop\Factory::create();

$server = stream_socket_server('tcp://127.0.0.1:8080');
stream_set_blocking($server, 0);

$loop->addReadStream($server, function ($server) use ($loop) {
	$conn = stream_socket_accept($server);
	
	echo "\nNew connection: {$conn}";
	
	fputs($conn, "Hello world!\n");
	fclose($conn);
});

$loop->addPeriodicTimer(5, function() {
	echo "\nThis will run every 5 seconds!";
});
	
$loop->run();

