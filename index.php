<?php
header ( 'Content-Type: text/html; charset= utf-8' );
error_reporting(E_ALL);
ini_set('display_errors', true);

$base = function() {
    $protocol = $_SERVER["REQUEST_SCHEME"];
    $host = filter_var($_SERVER["SERVER_NAME"], FILTER_SANITIZE_STRING);

    if ($protocol === "http") {
        $protocol = "http://";
    } else {
        $protocol = "https://";
    }
    return $protocol.$host."/";
};

define("BURI", $base());                        // url сайта со слешем
define("BDIR", __DIR__);                        // путь к корневой директории
define("CTL_DIR", BDIR."/library/controllers/");// путь до директории контроллеров
define("CLS_DIR", BDIR."/library/classes/");    // путь до директории  классов

spl_autoload_register(function ($class) {
    $paths = [CTL_DIR, CLS_DIR];
    foreach ($paths as $path) {
        if (file_exists($path = $path.$class.".php")) {
            include $path;
        }
    }
});

$uri = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_STRING); 
$uri = rawurldecode($uri);

$uri = trim($uri, "/\\");
// определяем название контроллера 
if ($uri === "") {
    $controller = "main";
    $parts = [];
} else  {
    // Нарезаем $uri в массив
    $parts = explode("/", $uri);
    $controller = array_shift($parts);
}

// первый символ буква?
$fc = mb_substr($controller, 0, 1, "UTF-8");
if (preg_match("~^[a-z]$~i", $fc)) {
    $controller = ucfirst($controller);
} else {
    $ac = new Answer();
    $ac->p404();
}
// есть ли файл с таким контроллером?
if (file_exists(CTL_DIR.$controller.".php") === false) {
    $ac = new Answer();
    $ac->p404();
}

$conf = new Config();
$opts = [
    'host'    => $conf->host,
    'user'    => $conf->user,
    'pass'    => $conf->pass,
    'db'      => $conf->db,
    'charset' => $conf->charset
];
$db = new SafeMySQL($opts);

// вызов обнаруженного контроллера
$class = $controller;
$c = new $class($db);

$method = array_shift($parts);
if (empty($method)) {
    $method = "index";
}
if (is_callable(array($c, $method)) == false) {
    $ac = new Answer();
    $ac->p404();
}

if ($parts == []) {
   $c->$method(); 
} elseif (count($parts) === 1) {
    $c->$method($parts[0]); 
} else {
    $c->$method($parts);
}
