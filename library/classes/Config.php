<?php

class Config {
    
    private $data;
    
    public function __construct() {
        $this->data = $this->fromFile();
    }
    
    public function fromFile() {
        $file = BDIR."/library/config/config.php";
        if (file_exists($file)) {
            return include $file;
        } else {
            trigger_error(__METHOD__.": Нет файла конфигурации.", E_USER_ERROR);
        }
    }
    
    public function __get($key) {
        if (empty($this->data[$key])) {
            return null;
        } 
        return $this->data[$key];
    }
    
    public function __set($key, $value) {
        $this->data[$key] = $value;
    }
    
    public function getDB() {
        $opts = [
            'host'    => $this->host,
            'user'    => $this->user,
            'pass'    => $this->pass,
            'db'      => $this->db,
            'charset' => $this->charset
        ];

        return new SafeMySQL($opts);
    }
    
    public function getSession() {
        $this->session = new Session($this->cookieLifeTime);
        return $this->session;
    }
    
    public function getUser() {
        if (!isset($this->data["session"])) {
            $this->getSession();
        }
        
        return new Users($this->session);
    }
}
