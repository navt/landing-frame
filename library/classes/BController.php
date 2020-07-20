<?php

class BController extends Controller {
    
    protected $conf;
    protected $db;

    public function __construct(Config $conf) {
        $this->conf = $conf;
        $this->db = $this->conf["DB"];
    }

}
