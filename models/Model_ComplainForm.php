<?php

Class Model_ComplainForm Extends ModelForm_Base 
{
    /**
	 * int id
	 * str username
	 * str email
	 * str site
	 * str country
	 * str complaint
	 * datetime adddate
	 * str browser
     * str ipaddress
	 */
	
	/**
     * @inheritdoc
     */
	
    public function rules()
    {
        return [
            ['username', 'Ім\'я обовязкове для заповнення', 'required'],
			['username', 'ім\'я складається мінімум 2 літери', 'minlength', 2],
            ['email', 'email обовязкове для заповнення', 'required'],
            ['email', 'email має бути вірним', 'email'],
            ['site', 'email має бути вірним', 'clin'],
			['country', 'Оберіть вашу країну', 'required'],
            ['complaint', 'Текст звернення обовязковий для заповнення', 'required']
        ];
    }
        
}