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
    
    /**
     * метод-заглушка эмулирует прием данных из формы
     */
    public function dummy() {
        if (filter_input(INPUT_POST, "button") !== "send" || filter_input(INPUT_POST, "phone") === "") {
            $this->jump();
        }
        // затем, проверка введённых в форму данных        
        // если данные из формы корректны то, например,
        // запись необходимых сведений в БД или отправка e-mail(sms) администратору.
        // уведомление клиенту, что форма обработана
        $this->view(BDIR."/view/templates/front/dummy.php",["title"=>"dummy page"]);
    }
    
}
