<?php

class Hlp {
    
    public static function html($string) {
       echo htmlspecialchars($string, ENT_QUOTES, "UTF-8"); 
    }
    
    public static function hash(string $pass) {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
    
    public static function isImage($ext) {
        $patterns = ["~^jpg|jpeg$~i", "~^png$~i", "~^gif$~i", "~^svg$~i"];
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $ext)) {
                return true;
            }
        }
        return false;
    }
    
    // https://stackoverflow.com/questions/17316873/convert-array-to-an-ini-file
    public static function arr2ini(array $arr) {
        $out = "";
        foreach ($arr as $k => $v) {
            $out .= "$k=\"$v\"" . PHP_EOL;
        }
        return $out;
    }
    
    public static function img($ini, $add=[]) {
        $attr = parse_ini_string($ini);
        $attr = array_merge($attr, $add);
        $out = "";
        foreach ($attr as $k => $v) {
            $out .= " $k=\"$v\"";
        }
        echo sprintf("<img%s>",$out);
    }
}
