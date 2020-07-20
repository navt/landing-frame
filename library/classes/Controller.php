<?php

abstract class Controller {
    
    protected function view($path,$data) {
        
        if (is_array($data) && $data != []) {
            extract($data);
        }

        if (file_exists($path)) {
            include $path;
        } else {
            trigger_error(__METHOD__.": Нет файла шаблона.", E_USER_ERROR);
        }
        
    }
    
    protected function jump($uri = "", $code = 302) {
       header("Location: ".BURI.$uri, true, $code);
       exit(0);
    }
}
