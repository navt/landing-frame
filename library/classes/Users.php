<?php

class Users {
    private $items = [];
    private $sess;
    
    public function __construct(Session $sess) {
        $this->sess = $sess;
        $this->loadItems();

        if (!isset($this->items["token"])) {
            $bytes = openssl_random_pseudo_bytes(12);
            $this->items["token"] = bin2hex($bytes);
            $this->sess->user = $this->items;
        }

    }
    
    private function loadItems() {
        $this->items = $this->sess->user;
    }
    
    public function __get($name) {
        
        if (empty($this->items[$name])) {
            return null;
        }

        return $this->items[$name];
    }
    
    public function isLogin() {
        $flag = false;

        if ($this->items != []) {
            
            if (is_numeric($this->id) && filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $flag = true;
            }

        }

        return $flag;
    }
    
    public function isAdmin() {
        $flag = false;

        if ($this->isLogin() && $this->role === 'Administrator') {
            $flag = true;
        }

        return $flag;
    }
    
    public function tokenLive() {
        
        if ($_POST !== []) {
            $in = filter_input(INPUT_POST, "token");

            if ($in !== $this->token) {
                http_response_code(403);
                exit("Доступ закрыт.");
            }

        }
        
    }
}
