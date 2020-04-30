<?php

class Page extends BController {
    
    private $table = "blocks";
    
    public function __construct($conf) {
        parent::__construct($conf);
        $this->sess = $this->conf->getSession();
        $this->user = $this->conf->getUser();
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
    
    public function delete() {
        $this->check();
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $row = $this->db->getRow("SELECT * FROM ?n WHERE id=?i", $this->table, $id);
        
        // если это какой либо файл, то нужно его удалить
        if (preg_match("~(src=|href=)~", $row["dictum"], $matches)) {
            $flag = $matches[0];
            $attr = parse_ini_string($row["dictum"]);
            switch ($flag) {
                case "src=":
                    $absolute = BDIR. "/{$attr["src"]}";
                    break;
                case "href=":
                    $absolute = BDIR. "/{$attr["href"]}";
                    break;
            }
            if (file_exists($absolute)) {
                unlink($absolute);
            }
        }

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
    
    public function saveFile() {
        $this->check();
        $data = $this->db->filterArray($_POST, ["ucode"]);
        if ($data["ucode"] == "") {
            $this->sess->msg = "Поле ucode должно быть заполнено";
            $this->jump("page/create/");
        }
        $file = (object)$_FILES["userfile"];
        if ($file->error !== 0) {
            $this->sess->msg = "Код ошибки при загрузке файла $file->error";
            $this->jump("page/create/");
        }
        if ($file->size > $this->conf->maxFileSize) {
            $this->sess->msg = "Размер файла более {$this->conf->maxFileSize}";
            $this->jump("page/create/");
        }
        // является файл изображением или файлом с разрешенным расширением
        $ext = pathinfo($file->name, PATHINFO_EXTENSION);
        if (Hlp::isImage($ext) === true) {
            $dir = "files/images/";
        } elseif (Hlp::allowType($ext) === true) {
            $dir = "files/others/";
        } else {
            $this->sess->msg = "Неразрешенное расширение файла $ext";
            $this->jump("page/create/");
        }
        
        $relative = sprintf("%s%s.%s", $dir, $data["ucode"], $ext);
        $absolute = BDIR. "/{$relative}";
        
        if (move_uploaded_file($file->tmp_name, $absolute) === true) {
            if (Hlp::isImage($ext) === true) {
                $img["src"] = $relative;
                $img["alt"] = $data["ucode"];
                $data["dictum"] = Hlp::arr2ini($img);
            } else {
                $f["href"] = $relative;
                $f["text"] = "Скачать {$data["ucode"]}";
                $data["dictum"] = Hlp::arr2ini($f);
            }
        } else {
            $this->sess->msg = "Файл не загужен на сервер";
            $this->jump("page/create/");
        }

        $this->db->query("INSERT INTO ?n SET ?u", $this->table, $data);
        $this->jump("page/blocks/");
    }
    
}
