<?php
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}
$host = 'localhost';
$port = 12345;

$result = socket_bind($socket, $host, $port);
if ($result === false) {
    echo "socket_bind() failed.\nReason: (" . socket_last_error() . ") " . socket_strerror(socket_last_error()) . "\n";
}
socket_listen($socket, 3);
    
$spawn = socket_accept($socket);
if ($spawn === false) {
    echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

$input = socket_read($spawn, 2048);
if ($input === false) {
    echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($spawn)) . "\n";
}

$output = "Hello, client!";
socket_write($spawn, $output, strlen($output));

socket_close($spawn);
socket_close($socket);
    