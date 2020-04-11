<?php

class BController extends Controller {
    protected $db;
    
    public function __construct(SafeMySQL $db) {
        $this->db = $db;
    }
    
    protected function jump($uri = "", $code = 302) {
       header("Location: ".BURI.$uri, true, $code);
       exit(0);
    }

}
