<?php
// абстрактый класс контроллера
Abstract Class Controller_Base {
 
    protected $registry;
    protected $template;
    protected $layouts; // шаблон
    public $auth;
     
    public $vars = array();
 
    // в конструкторе подключаем шаблоны
    function __construct($registry) {
        $this->registry = $registry;
        // шаблоны
        $this->template = new Template($this->layouts, get_class($this));
        $this->auth = new Authorize_Base();
        if(isset($_POST['ex'])){$this->auth->logout();}
		if(isset($_POST['us'])){$this->login();}        
    }
 
    abstract function index(); 
    
	protected function refresh(){
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
    
    function error(){
        $this->template->view('../layouts/error');
    }
	
	//////////////////////////////////////////////////
        // авторизація
	protected function login()
	{   
		$aut = new Model_FormUsers();
        if($aut->errorPost('us')){
            $res = $aut->entries;
            $auth = new Authorize_Base();
            $auth->login($aut->entries['login'],$aut->entries['pass']);
        }else{
			$errors=$aut->errors;
			if(count($errors)>0){
				
				$err = new Session();
				$err->start();
				$err->set('errorAut',serialize($errors));
				$this->refresh();
			}
        }
	}
	
}