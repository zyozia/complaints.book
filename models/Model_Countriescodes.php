<?php

Class Model_Countriescodes Extends ModelDB_Base {
	
	public $code;
	public $title;
			
	public function fieldsTable(){
		return array(
			'code' => 'Код країни',
			'title' => 'Країна'
		);
    }	
}