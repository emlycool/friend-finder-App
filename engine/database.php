<?php 
define('server', 'localhost');
define('username', 'root');
define('password', '');
define('database', 'test_project');

$mycon= mysqli_connect(server, username, password, database);

define('server2', 'localhost');
define('username2', 'root');
define('password2', '');
define('database2', 'commerce');

$mycon2= mysqli_connect(server2, username2, password2, database2);

?>