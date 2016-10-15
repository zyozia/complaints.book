<?php
//Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS);
$sitePath = str_replace("/home/u485438947/public_html", "", $sitePath);
define ('SITE_PATH', $sitePath); // путь к корневой папке сайта
 
// для подключения к бд
define('DB_USER', 'u485438947_zyozi');
define('DB_PASS', '123789');
define('DB_HOST', 'localhost');
define('DB_NAME', 'u485438947_cbook');

/*

// для подключения к бд
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'complaintbook');

*/