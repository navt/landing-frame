<?php

class Config extends Pimple {
    
    public function __construct() {
        parent::__construct();
        $this->fromFile();
        $this->init();
    }
    
    private function fromFile() {
        $file = BDIR."/library/config/config.php";
        
        if (file_exists($file) === false) {
            throw new AppException("Нет файла конфигурации для приложения.");
        }
        
        $params = include $file;
        
        foreach ($params as $id => $value) {
            $this[$id] = $value;
        }

    }
    
    private function init() {
        
        $this["DB"] = $this->share(function($c) {
            $opt = [
                'host'    => $c["host"],
                'user'    => $c["user"],
                'pass'    => $c["pass"],
                'db'      => $c["db"],
                'charset' => $c["charset"]
            ];
            return new SafeMySQL($opt);
        });
        
        $this["session"] = $this->share(function ($c) {
            return new Session($c["cookieLifeTime"]);
        });
        
        $this["users"] = function ($c) {
            return new Users($c["session"]);
        };
    }
    
}
