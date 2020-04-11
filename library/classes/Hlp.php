<?php

class Hlp {
    
    public static function html($string) {
       echo htmlspecialchars($string, ENT_QUOTES, "UTF-8"); 
    }
    
    public static function hash(string $pass) {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

}
