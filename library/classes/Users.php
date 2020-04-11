<?php

class Users {
    private $items = [];
    private $sess;
    
    public function __construct(Session $sess) {
        $this->sess = $sess;
        $this->loadItems();
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
        if ($this->items !== []) {
            if (is_numeric($this->items['id']) && filter_var($this->items['email'], FILTER_VALIDATE_EMAIL)) {
                $flag = true;
            } 
        }
        return $flag;
    }
    
    public function isAdmin() {
        $flag = false;
        if ($this->isLogin() && $this->items['role'] === 'Administrator') {
            $flag = true;
        }
        return $flag;
    }
}
