<?php
header("Content-Type: text/html; charset=utf-8");
// включим отображение всех ошибок
error_reporting (E_ALL); 
// подключаем конфиг
include ('config.php'); 
 
// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' ));
// подключаем ядро сайта
include (SITE_PATH . DS . 'core' . DS . 'core.php'); 
 

if(isset($_POST['name'])){
	$edit = false;
	$del = false;
	$ar = [];
	// Редагувати
	if(preg_match("/^(btn-)[0-9]+$/", $_POST['name'])){
		(int)$rest = substr($_POST['name'], 4);	
		$edit = true;
	}
	// Видалити
	if(preg_match("/^(drop-)[0-9]+$/", $_POST['name'])){
		(int)$rest = substr($_POST['name'], 5);
		$del = true;
	}
	//
	if(isset($rest) && ($edit == true || $del == true)){
		$model = new Model_Complaints(); 
		$result = $model->getRowById($rest); // получаем все строки
		if(isset($result['country']))
		{
			$code = $result['country'];
			$select = array('where' => 'code = "'.$code.'"');
			$country = new Model_Countriescodes($select); 
			$c = $country->getAllRows();
			$ar[1]= $c;
		}
		if($result){
			$result['id']=null;
			$result[0]=null;
			$ar[0]= $result;
			echo  json_encode($ar);
		}
	}
}
?>