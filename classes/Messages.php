<?php
// класс повідомлень
Class Messages
{

	/**
	 * приймає ім'я сесії, і пост який надійшов
	 * відповідь - блок з описом помилки
	 */
	public static function getWrong($session,$post){
        if(!empty($_SESSION[$session]) && empty($_POST[$post]))
		{
			$errors = unserialize($_SESSION[$session]);
			if(count($errors)>0){ ?>
				<div class="alert alert-danger" role="alert">	
					<?php foreach($errors as $error): ?>
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						<?=$error ?><br>
					<?php endforeach;?>
				</div>
			<?php
			$_SESSION[$session] = null;
			}
		}else{
			return null;
		}
    }
	
	/**
	 * приймає ім'я сесії, і пост який надійшов
	 * відповідь - блок з підтвердженням
	 */
	public static function getInfo($session,$post){
        if(!empty($_SESSION[$session]) && empty($_POST[$post]))
		{
			$errors = unserialize($_SESSION[$session]);
			if(count($errors)>0){ ?>
				<div class="alert alert-success" role="alert">	
					<?php foreach($errors as $error): ?>
						<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						<?=$error ?><br>
					<?php endforeach;?>
				</div>
			<?php
			$_SESSION[$session] = null;
			}
		}
    }
	public static function getBrowser()
	{
		$user_agent = $_SERVER["HTTP_USER_AGENT"];
		if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
		elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
		elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
		elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
		elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
		else $browser = "Неизвестный";
		return $browser;
	}
	
	public static function getIp()
	{
		return $_SERVER["REMOTE_ADDR"];
	}
}