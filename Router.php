<?php
namespace MVC;
use Controller\InicioController;

abstract class Router {
    protected static $rutasGET = [];
    protected static $rutasPOST = [];

    public static function rutasPOSTvalidas(string $url, array $fn) {
        self::$rutasPOST[$url] = $fn; 
    }
    public static function rutasGETvalidas(string $url, array $fn) {
        self::$rutasGET[$url] = $fn; 
    }

    public static function initApp() {
        $urlActual = strtok($_SERVER["REQUEST_URI"], "?") ?? "/";
        $metodoActual = $_SERVER["REQUEST_METHOD"];

        if($metodoActual === "POST") {
            $fn = self::$rutasPOST[$urlActual];
        } else if($metodoActual === "GET") {
            $fn = self::$rutasGET[$urlActual];
        }
        
        if($fn !== null) {
            call_user_func($fn);
        } else {
            call_user_func([InicioController::class, "notFound"]);
        }
    }

    public static function views(string $view, array $datos = [], bool $dashboard = false) {
        ob_start();
        foreach($datos as $key => $value) {
            $$key = $value;
        }
        include_once __DIR__ . '/views'.'/'.$view.'.php';
        $contenido = ob_get_clean();

        if($dashboard) {
            include __DIR__ . '/views/dashboard.php';
        } else {
            include __DIR__ . '/views/layout.php';
        }
    }
}