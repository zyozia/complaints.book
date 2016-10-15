<?php

Class Model_Complaints Extends ModelDB_Base {
	/**
	 * id	int(10)
     * username varchar(50)
     * email	varchar(50)
     * site	varchar(50)
     * country	char(3)
     * complaint	text
     * adddate	datetime
     * browser	varchar(50)
     * ipaddress varchar(50)
     */
	
    public $id;
	public $username;
	public $email;
    public $site;
	public $country;
	public $complaint;
    public $adddate;
	public $browser;
	public $ipaddress;
	
	public function fieldsTable(){
		return array(
			'id' => 'Id',
			'username' => 'Користувач',
			'email' => 'Електронна скринька',
            'site' => 'Сайт',
			'country' => 'Країна',
			'complaint' => 'Відгук',
            'adddate' => 'Дата створення',
			'browser' => 'Браузер',
			'ipaddress' => 'ІР адреса'
		);
    }
}

	