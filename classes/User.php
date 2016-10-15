<?php
/**
 
 *  Класс User v 0.1.0.0
 *      Класс авторизации и регистрации пользователя.
 
 *  Примечание:
 *      Класс статичный, потому любой метод надо вызывать через двойное двоеточие, например:
 *      if ( User::isLogined() ) {
 
 *  Метод check ()
 *      Проверяет, авторизировался ли пользователь, этот метод следует вызвать до вызова любого другого метода класса
 
 *  Метод isLogged ()
 *      Возвращает значение, залогинен ли пользователь в этом сеансе
 *      @ Return boolean
 
 *  Метод register (String $nick, String $pass)
 *      Регистрирует пользователя с ником $nick (если не занят) и паролем $pass
 *      @ Return TRUE или "NickBusy"
 *      ВНИМАНИЕ: Данный метод нуждается в доработке, если вы хотите его использовать у себя на сайте
 *          подробнее - в комментариях метода
 
 *  Метод login (String $nick, String $pass)
 *      Авторизует пользователя с ником $nick (если существует) и паролем $pass (если правильный)
 *      @ Return TRUE или "WrongPass" или "WrongNick"
 *      ВНИМАНИЕ: Данный метод нуждается в доработке, если вы хотите его использовать у себя на сайте
 *          подробнее - в комментариях метода
 
 *  Метод logout ()
 *      Делает пользователя неавторизированным на сайте и запоминает это состояние
 *      ВНИМАНИЕ: Данный метод нуждается в доработке, если вы хотите его использовать у себя на сайте
 *          подробнее - в комментариях метода
 
 *  Метод getInstance ()
 *      Возвращает объект пользователя. В этом объекте могут быть данные о имени, дате регистрации,
 *      количестве сообщений и так далее. Вы можете отредактировать класс так, чтобы возвращался
 *      ассоциативный массив вместо объекта. Смотрите код и комментарии методов register, login и logout
 *      @ Return Object
 
 */
class User {
    protected static $instance = null;
    protected static $logged = false;
 
    public static function check () {
        Session::start();
        if ($data = Session::get('User')) {
            $data = unserialize($data);
            self::$logined  = $data['logined'];
            self::$instance = $data['instance'];
        } else {
            // Не может быть сессии без переменной User. Должно быть, это ошибка
            Session::restart();
            // Пользователь будет незалогиненым
            self::logout();
        }
    }
 
    public static function isLogged () {
        return self::$logged;
    }
 
    public static function register ($nick, $pass) {
        // В этом блоке if надо проверить, нету ли уже пользователя с ником $nick
        // Если есть - вернуть ошибку. Отредактируйте так, чтобы подходило под ваш код
        if (Db_Get_User::byNick($nick)) {
            return 'NickBusy';
        } else {
            // Стоит создать пользователя с таким ником в базе
            $user = new Object_User();
            $user->setNick($nick);
            $user->setPass($pass, true);
            self::$instance = Db_Put_User::create($user);
            // Пользователь уже создан и в свойство класса добавлена его сущность
            // Например - объект, или ассоциативный массив
 
            self::$logined  = true;
            self::addToSession();
            return true;
        }
    }
 
    public static function login ($nick, $pass) {
        // Из базы надо попробовать получить пользователя с таким НикНеймом.
        $user = Db_Get_User::byNick($nick);
        if ($user) {
            // Если такой пользователь его - сравниваем хеш пароля, который ввел
            // пользователь со значением в базе
            if ($user->getPass() === Make::hash($pass)) {
                // Если совпало - значит вход совершен
                self::$instance = $user;
                self::$logined  = true;
                self::addToSession();
                return true;
            } else {
                return "WrongPass";
            }
        } else {
            return "WrongNick";
        }
    }
 
    public static function logout () {
        // Надо указать, что сущность пользователя теперь - гость и
        // записать это значение в сессию
        self::$instance = new Object_Guest;
        self::$logined  = false;
        self::addToSession();
    }
 
    public static function getInstance () {
        return self::$instance;
    }
 
    private static function addToSession () {    
        Session::set("User", serialize(array(
            "instance" => self::$instance,
            "logined" => self::$logined
        )));
    }
}
 
?>