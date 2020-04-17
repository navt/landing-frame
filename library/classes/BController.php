<?php

class BController extends Controller {
    protected $db;
    
    public function __construct(SafeMySQL $db, Config $conf) {
        $this->db = $db;
        $this->conf = $conf;
    }
    
    protected function jump($uri = "", $code = 302) {
       header("Location: ".BURI.$uri, true, $code);
       exit(0);
    }

}
