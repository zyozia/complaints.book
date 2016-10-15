<?php

Abstract Class ModelForm_Base {
    
    public $validator;
    protected $_rules=null;
    public $errors = [];
    
    private $_params = [];
    public function rules()
    {
        return [];
    }
    /**
     * @inheritdoc
     */
    
    public function __construct()
    {
        $this->validator = new FormValidator_Base();
        $this->_rules = $this->rules();
        if(is_array($this->_rules)){
            foreach ($this->_rules as $key=>$value){
                $this->_params = [];
                if(is_array($value)){
                    foreach ($value as $keyValue=>$valueValue){;
                        $this->_params[] = $valueValue;
                    }
                    $this->validator->addRule($this->_params);
                }
                else{
                    $this->validator->addRule(false);
                }
            }
        }else{
            $this->validator->addRule(false);
        }
    }
    // Після створення обєкту для форми даний сценарій вворемо для перевірки
    // якщо TRUE можна продовжувати  дію де зсі записи знаходятимуться в перемінній entries - масив (name_1 => value_1, name_2 => value_2)
    // якшо ні то слід вивести помилку $this->errors - масив
    public function errorPost($post){
        // Input the POST data and check it
        if(!empty($_POST[$post])){
            $this->validator->addEntries($_POST);//вантажим і чистимо пост
            $this->validator->validate(); // запускаємо валідацію
            if($this->validator->foundErrors()){
                $this->errors = $this->validator->getErrors();
                return false;
            }else{
                $this->entries = $this->validator->getEntries();
                return true;
            }
        }
    }
}