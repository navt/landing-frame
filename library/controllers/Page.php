<?php

class Page extends BController {
    
    private $table = "blocks";
    
    public function __construct($db) {
        parent::__construct($db);
        $this->sess = new Session();
        $this->user = new Users($this->sess);
    }
    
    private function check() {
        if ($this->user->isLogin() === false) {
            $this->jump("staff/viewForm/");
        }
    }
    
    public function create() {
        $this->check();
        $page = ["title" => "Создание блока текста",
            "description" => "",
            "keywords" => ""];
        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/create.php", "");
        $this->view(BDIR."/view/templates/back/foot.php","");
    }
    
    public function blocks() {
        $this->check();
        $page = ["title" => "Вывод всех блоков текста",
            "description" => "",
            "keywords" => ""];
        $blocks = $this->db->getAll("SELECT * FROM ?n", $this->table);
        
        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/blocks.php",["blocks" => $blocks]);
        $this->view(BDIR."/view/templates/back/foot.php","");
    }
    
    public function edit($id) {
        $this->check();
        $row = $this->db->getRow("SELECT * FROM ?n WHERE id=?i", $this->table, $id);
        $page = ["title" => "Редактирование блока текста",
            "description" => "",
            "keywords" => ""];
        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/edit.php", $row);
        $this->view(BDIR."/view/templates/back/foot.php","");
    }
    
    public function insert() {
        $this->check();
        $fields = ["ucode", "dictum"];
        $data = $this->db->filterArray($_POST, $fields);
        if ($data["ucode"] == "" || $data["dictum"] == "") {
            $this->sess->msg = "Поля должны быть заполнены";
            $this->jump("page/create/");
        }
        $this->db->query("INSERT INTO ?n SET ?u", $this->table, $data);
        $this->jump("page/blocks/");
    }
    
    public function delete($id) {
        $this->check();
        $this->db->query("DELETE FROM ?n WHERE id=?i", $this->table, $id);
        $this->jump("page/blocks/");
    }
    
    public function update() {
        $this->check();
        $fields = ["ucode", "dictum"];
        $data = $this->db->filterArray($_POST, $fields);
        $this->db->query("UPDATE ?n SET ?u WHERE id = ?i", $this->table, $data, $_POST['id']);
        $this->jump("page/blocks/");
    }
    
}
