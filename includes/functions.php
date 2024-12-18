<?php

//CONEXION A LA BASE DE DATOS
function conectarDB() : PDO {
    try {
        $conexion = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}; charset=utf8", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    }
    catch(Exception $e) {
        return "Error: ".$e->getMessage();
    }
}

//HELPERS
function debugear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function jsonDebug($json) {
    echo json_encode($json);
    exit;
}
function alertas(array $alertas) {
    if(isset($alertas["error"])) {
        foreach($alertas["error"] as $alerta) {
            echo "<p class='alerta error'>".$alerta."</p>";
        }
    }
    if(isset($alertas["exito"])) {
        foreach($alertas["exito"] as $alerta) {
            echo "<p class='alerta exito'>".$alerta."</p>";
        }
    }
}
function verificarSession(string $location) {
    session_start();
    if(empty($_SESSION)) {
        header("Location: ".$location);
    }
}
function sanitizarEntradas(string $entrada) {
    $entradaSanitizada = preg_replace('/[^a-zA-Z0-9\s\@\-_.]/', '', $entrada);
    return filter_var($entradaSanitizada, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
function scripts(string $script) {
    echo "<script src='/build/js/{$script}.js'></script>";
}