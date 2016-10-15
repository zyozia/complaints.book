<?php

Class Authorize_Base
{
	
    private $_id;
	private $_name;
    private $_login;
    private $_userhash;
    private $_session;
    
    const ERROR_USERNAME_INVALID = ['Не вірне імя користувача!'];
    const ERROR_PASSWORD_INVALID = ['Не вірний пароль!'];
    const ERROR_NONE =  [false];
    
    public $errorCode;
	public $Guest = true;
    
	public function __construct() {
		$session = new Session();
        $session->start();
        $this->_session = $session;
        $this->authentication($session);
	}
    /*
     * генерація salt для crypt 
     * 
     * $password_hash = crypt( 'password', blowfishSalt() );
     */
    private function blowfishSalt($cost = 13)
    {
        if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
            throw new Exception("cost parameter must be between 4 and 31");
        }
        $rand = array();
        for ($i = 0; $i < 8; $i += 1) {
            $rand[] = pack('S', mt_rand(0, 0xffff));
        }
        $rand[] = substr(microtime(), 2, 6);
        $rand = sha1(implode('', $rand), true);
        $salt = '$2a$' . sprintf('%02d', $cost) . '$';
        $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
        return $salt;
    }
    
    /*
     *
     *
     */
    
    public function login($login,$password)
    {
        if($this->Guest = true){
            $select = array('where' => "login = '$login'" );
            $usersInfo = new Model_Users($select);
            $record = $usersInfo->getOneRow();
			
            if (count($record) < 2) {
                $this->_session->set('errorAut',serialize(self::ERROR_USERNAME_INVALID));
				$this->refresh();
            } else if ($record['pass'] !== crypt($password, $record['pass'])) {
                $this->_session->set('errorAut',serialize(self::ERROR_PASSWORD_INVALID));
				$this->refresh();
            } else {

                $this->_userhash = crypt( time() , $this->blowfishSalt() );
                $usersInfo->fetchOne(); 
                $usersInfo->user_hash = $this->_userhash;
                $result = $usersInfo->update();
                
                $this->setState($this->_userhash);
                $this->_session->del('errorAut');
            }
            return !$this->errorCode;
        }
    }
    
    
    private function setState($hash)
    {
        setcookie("uid", $hash, time()+60*60*24*30);
        $session = $this->_session;
        $session->set('uid',$hash);
        $this->refresh();
    }
    
    public function logout(){
        setcookie("uid", false, time()-60);
        $this->_session->del('uid');
        $this->_session->clear();
        $this->Guest = true;
        $this->refresh();
    }
    
    
    public function authentication($session){
        
        if($session->get("uid")){
            $this->_userhash = $session->get("uid");
            $select = array('where' => "user_hash = '$this->_userhash'" );
            $usersInfo = new Model_Users($select);
            $record = $usersInfo->getOneRow();
            if($record){
                $this->_id = $record['id'];
                $this->_name = $record['name'];
                $this->_login = $record['login'];
                $this->Guest = false;
            }  
        }else{
            if(isset($_COOKIE['uid'])){
                $this->_userhash = $_COOKIE['uid'];
                $select = array('where' => "user_hash = '$this->_userhash'" );
                $usersInfo = new Model_Users($select);
                $record = $usersInfo->getOneRow();
                if($record){
                    $session->set('uid',$this->_userhash);
                    $this->_id = $record['id'];
                    $this->_name = $record['name'];
                    $this->_login = $record['login'];
                    $this->Guest = false;
                }
            }else{
                $this->Guest = true;
            }
        }
    }
    
 
    public function getId(){
        return $this->_id;
    }
    public function getName(){
        return $this->_name;
    }
    public function getLogin(){
        return $this->_login;
    }
    
    protected function refresh(){
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
}