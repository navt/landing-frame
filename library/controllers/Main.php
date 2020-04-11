<?php

class Main extends BController {
    
    private $table = "blocks";
    
    public function index() {
        $blocks = $this->db->getAll("SELECT * FROM ?n", $this->table);
        
        foreach ($blocks as $block) {
            $kv[$block["ucode"]] = $block["dictum"];
        }

        $this->view(BDIR."/view/templates/front/page.php",$kv);
    }
    
}
