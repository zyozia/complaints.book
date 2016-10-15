<?php
//Задаем константы:
define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
$sitePath = realpath(dirname(__FILE__) . DS);
define ('SITE_PATH', $sitePath); // путь к корневой папке сайта
 
// для подключения к бд
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'complaintbook');
//http://vk-book.ru/primer-mvc-v-php-tretya-statya-modeli-rabota-s-bazoj-dannyx-sozdanie-chtenie-obnovlenie-i-udalenie-zapisej/