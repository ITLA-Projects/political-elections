<?php


define('URL',str_replace("\\",'/',"http://".$_SERVER['HTTP_HOST'].substr(getcwd(),strlen($_SERVER['DOCUMENT_ROOT'])))."/");

define('HOST','localhost');
define('DB','political_elections');
define('USER','root');
define('PASSWORD','');
define('CHARSET','utf8mb4');

define('EMAIL_HOST',"smtp.gmail.com");
define('EMAIL_USERNAME',"rampabonoide@gmail.com");
define('EMAIL_PASSWORD',"");
define('EMAIL_PORT',"587");
define('EMAIL_FROM',"Political Elections");
?>