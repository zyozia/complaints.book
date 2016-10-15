<?php

Class Model_Users Extends ModelDB_Base {
	
	public $id;
	public $login;
	public $pass;
    public $user_hash;
	
	public function fieldsTable(){
		return array(
			'id' => 'Id',
			'login' => 'Ім\'я користувача',
			'pass' => 'Пароль',
            'user_hash' => 'Хеш'
		);
    }	
}