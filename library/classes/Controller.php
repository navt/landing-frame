<?php

abstract class Controller {
    
    protected function view($path,$data) {
        
        if (is_array($data) && $data != []) {
            extract($data);
        }

        if (file_exists($path)) {
            include $path;
        } else {
            throw new AppException(sprintf("Нет файла шаблона: %s", $path));
        }
        
    }
    
    protected function jump($uri = "", $code = 302) {
       header("Location: ".BURI.$uri, true, $code);
       exit(0);
    }
}
