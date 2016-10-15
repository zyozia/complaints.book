<?php

Class Model_FormUsers Extends ModelForm_Base 
{
    /*
	 * int id
     * str name
     * str login
     * str pass
     * str user_hash    
    */
	
 	/**
     * @inheritdoc
     */
	
    public function rules()
    {
        return [
            ['login', 'Введіть будь ласка логін', 'required'],
            ['login', 'Логін має містити мінімум 3 літери', 'minlength', 3],
            ['pass', 'Заповніть будьласка пароль', 'required']
        ];
    }
}