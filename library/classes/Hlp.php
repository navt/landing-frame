<?php

class Hlp {
    
    public static function html($string) {
       echo htmlspecialchars($string, ENT_QUOTES, "UTF-8"); 
    }
    
    public static function hash(string $pass) {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
    
    public static function isImage($ext) {
        $patterns = ["~^(jpg|jpeg)$~i", "~^png$~i", "~^gif$~i", "~^svg$~i"];
        return self::compare($patterns, $ext);
    }
    
    // дообавьте сюда свои паттерны, если нужно загружать файлы с другими расширениями
    public static function allowType($ext) {
        $patterns = ["~^(xls|xlsx)$~i", "~^pdf$~i"];
        return self::compare($patterns, $ext);
    }
    
    private static function compare($patterns, $ext) {
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
    
    // пример использования в /view/templates/front/page.php
    public static function img($ini, $add=[]) {
        $attr = parse_ini_string($ini);
        $attr = array_merge($attr, $add);
        $out = self::inside($attr);
        echo sprintf("<img%s>",$out);
    }
    
    // пример использования в /view/templates/front/page.php
    public static function a($ini, $add=[]) {
        $attr = parse_ini_string($ini);
        $attr = array_merge($attr, $add);
        $text = $attr["text"];
        unset($attr["text"]);
        $out = self::inside($attr);
        echo sprintf("<a%s>%s</a>",$out, $text);
    }
    
    private static function inside(array $attr) {
        $out = "";

        foreach ($attr as $k => $v) {
            $out .= " $k=\"$v\"";
        }
        
        return $out;
    }
}
