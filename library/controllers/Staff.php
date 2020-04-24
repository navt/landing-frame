<?php

class Staff extends BController {
    
    public  $sess;
    private $user;
    private $table = "users";
    private $roles = ["Administrator", "Editor"];

    public function __construct($conf) {
        parent::__construct($conf);
        $this->sess = $this->conf->getSession();
        $this->user = $this->conf->getUser();
    }
    
    private function check() {
        if ($this->user->isAdmin() === false) {
            $this->viewForm();
        }
    }
    
    public function index() {
        
        $msg = "Некорректная пара: логин/пароль";

        if (empty($_POST["button"])) {
            $this->jump("");
        }

        $email = filter_input(INPUT_POST, "login");
        $pass = filter_input(INPUT_POST, "password");
        
        if ($email === "" || $pass === "") {
            $this->sess->msg = $msg." #0";
            $this->viewForm();
        }
        // оба поля заполнены, запоминаем их в сессию
        $this->sess->inEmail = $email;
        $this->sess->inPass = $pass;
        
        // считаем, что brute force, если 5 неудачных попыток входа
        if (!isset($this->sess->count)) {
            $this->sess->count = 1;
        } else {
            $this->sess->count++;
        }
        if ($this->sess->count > 5) {
            sleep(1);
        }
        
        if (mb_strlen($email) > 40 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->sess->msg = $msg." #1";
            $this->viewForm();
        }

        $person = $this->db->getRow("SELECT * FROM ?n WHERE email=?s", $this->table, $email);
        if ($person === null) {
            $this->sess->msg = $msg." #2";
            $this->viewForm();
        }

        if (password_verify($pass, $person["hash"])) {
            unset($person["hash"]);
            $this->sess->user = $person;
            // подчищаем сессию
            $this->sess->msg = null;
            $this->sess->inEmail = null;
            $this->sess->inPass = null;
            $this->sess->count = null;
            $this->jump("page/blocks/");
        } else {
            $this->sess->msg = $msg." #3";
            $this->viewForm();
        }
    }
    
    public function viewForm() {
        if ($this->user->isLogin()) {
            $this->jump("page/blocks/");
        }
        $page = ["title" => "Вход", "description" => "", "keywords" => ""];
        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/form.php", "");
        $this->view(BDIR."/view/templates/back/foot.php","");
        exit(0);
    }
    
    public function all() {
        $this->check();
        $page = ["title" => "Все пользователи", "description" => "", "keywords" => ""];

        $users = $this->db->getAll("SELECT * FROM ?n", $this->table);
        
        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/allUsers.php",["users" => $users]);
        $this->view(BDIR."/view/templates/back/foot.php","");
    }
    
    public function create() {
        $this->check();
        $page = ["title" => "Создание пользователя", "description" => "", "keywords" => ""];

        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/createUser.php", "");
        $this->view(BDIR."/view/templates/back/foot.php","");
    }
    public function insert() {
        $this->check();
        $fields = ["email", "hash", "role"];
        $data = $this->db->filterArray($_POST, $fields);
        $this->sess->inEmail = $data["email"];
        $this->sess->inHash = $data["hash"];
        if (filter_var($data["email"], FILTER_VALIDATE_EMAIL) === false) {
            $this->sess->msg = "Некорректный e-mail: ".$data["email"];
            $this->jump("staff/create/");
        }
        if ($data["hash"] === "") {
            $this->sess->msg = "Поле пароль обязательно для заполнения";
            $this->jump("staff/create/");
        } else {
            $data["hash"] = password_hash($data["hash"], PASSWORD_DEFAULT);
        }
        if (in_array($data["role"], $this->roles) === false) {
            $this->sess->msg = "Необходимо выбрать роль";
            $this->jump("staff/create/");
        }
        $this->db->query("INSERT INTO ?n SET ?u", $this->table, $data);
        $this->sess->inEmail = null;
        $this->sess->inHash = null;
        $this->jump("staff/all/");
    }
    
    public function delete($id) {
        $this->check();
        $this->db->query("DELETE FROM ?n WHERE id=?i", $this->table, $id);
        $this->jump("staff/all/");
    }
    
    public function edit($id) {
        $this->check();
        $row = $this->db->getRow("SELECT * FROM ?n WHERE id=?i", $this->table, $id);
        $page = ["title" => "Редактирование пользователя",
            "description" => "",
            "keywords" => ""];
        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/editUser.php", $row);
        $this->view(BDIR."/view/templates/back/foot.php","");
    }
    
    public function update() {
        $this->check();
        $fields = ["email", "hash", "role"];
        $data = $this->db->filterArray($_POST, $fields);
        $id = (integer)$_POST['id'];

        if (filter_var($data["email"], FILTER_VALIDATE_EMAIL) === false) {
            $this->sess->msg = "Некорректный e-mail: ".$data["email"];
            $this->jump("staff/edit/{$id}");
        }
        if (in_array($data["role"], $this->roles) === false) {
            $this->sess->msg = "Необходимо выбрать роль";
            $this->jump("staff/edit/{$id}");
        }
        $this->db->query("UPDATE ?n SET ?u WHERE id = ?i", $this->table, $data, $_POST['id']);
        $this->jump("staff/all/");
    }
    
    public function refresh($id) {
        $this->check();
        $row = $this->db->getRow("SELECT * FROM ?n WHERE id=?i", $this->table, $id);
        $page = ["title" => "Редактирование пользователя",
            "description" => "",
            "keywords" => ""];
        $this->view(BDIR."/view/templates/back/head.php",$page);
        $this->view(BDIR."/view/templates/back/refreshPass.php", $row);
        $this->view(BDIR."/view/templates/back/foot.php","");
    }
    
    public function updatePass() {
        $this->check();
        $fields = ["id", "hash"];
        $data = $this->db->filterArray($_POST, $fields);
        $id = (integer)$_POST['id'];
        if ($data["hash"] === "") {
            $this->sess->msg = "Поле пароль обязательно для заполнения";
            $this->jump("staff/refresh/{$id}/");
        } else {
            $data["hash"] = password_hash($data["hash"], PASSWORD_DEFAULT);
        }
        $this->db->query("UPDATE ?n SET ?u WHERE id = ?i", $this->table, $data, $_POST['id']);
        $this->jump("staff/all/");
    }
    
    public function logout() {
        $this->check();
        $this->sess->destroy();
        $this->jump("");
    }
}
