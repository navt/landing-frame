<?php

class Answer extends Controller{
    
    public function p404() {
        http_response_code(404);
        $this->view(BDIR."/view/templates/back/p404.php","");
        exit();
    }
}
