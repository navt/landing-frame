<?php
class Session {
    
    private $lifeTime;
    
    public function __construct($lifeTime=1440) {
        $this->lifeTime = $lifeTime;
    }
    
    protected function tryRun() {
        
        switch (session_status()) {
            case PHP_SESSION_DISABLED;
                trigger_error(__METHOD__.": Механизм сессий отключен.", E_USER_ERROR);
                break;
            case PHP_SESSION_NONE:
                $name = strtoupper(str_replace([".", "-"], ["", ""], $_SERVER["SERVER_NAME"]));
                session_name($name);
                session_start(["cookie_lifetime" => $this->lifeTime]);
                
                // сессия жива, но ip адрес уже переменился - алярм!
                // этот код будет срабатывать и при динамическом ip-адресе, в этом случае
                // здесь нужна коррекция кода
                if (isset($this->ip) && ($this->ip !== $_SERVER["REMOTE_ADDR"])) {
                    http_response_code(403);
                    exit("Ваш ip адрес внезапно изменился!");
                }

                if (!isset($this->ip)) {
                    $this->ip = $_SERVER["REMOTE_ADDR"];
                }

                break;
            default:           // PHP_SESSION_ACTIVE
                break;
        }
        
    }
    
    public function __get($name) {
        $this->tryRun();

        if (empty($_SESSION[$name])) {
            return null;
        }

        return $_SESSION[$name];
    }
    
    public function __set($name, $value) {
        $this->tryRun();
        $_SESSION[$name] = $value;
    }
    
    public function __isset($name) {
        $this->tryRun();
        return isset($_SESSION[$name]);
    }
   
   
    public function __unset($name) {
        $this->tryRun();
        $_SESSION[$name] = null;
    }
    
    public function destroy() {
        $this->tryRun();
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), "", time()-3600, "/");
        }
        
        session_destroy();
    }
}

// https://www.php.net/manual/ru/function.session-start.php
// https://qna.habr.com/q/166223