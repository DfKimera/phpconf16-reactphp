<?php
include("vendor/autoload.php");

$loop = React\EventLoop\Factory::create();
$painter = new \Fab\SuperFab();
$socket = new React\Socket\Server($loop);

$socket->on('connection', function ($conn) use ($painter) {

	$conn->write("Hello there! Type anything and I'll color it for you!\n");

	$conn->on('data', function ($data) use ($conn, $painter) {
		$painted = $painter->paint($data);
		$conn->write($painted);
	});

});

$socket->listen(8080);
$loop->run();

