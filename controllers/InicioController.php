<?php
namespace Controller;

use MVC\Router;
use Model\Usuarios;
use Model\Mail;
use Model\Profesional;

abstract class InicioController {
    public static function notFound() {
        
        Router::views("inicio/notFound", [
            
        ]);
    }

    public static function registro() {
        $usuario = new Usuarios();

        if($_SERVER["REQUEST_METHOD"]==="POST") {
            $usuario->sincronizarDatos($_POST, $_FILES);

            if(empty($usuario->validar()["error"])) {
                //Hashear Password
                $usuario->hashPassword();
                //Set Atributos
                $usuario->setAtributos();
                //Guardar en la Base de Datos
                $guardar = $usuario::insertar();

                if($guardar["resultado"]) {
                    //Guardar Imagen
                    $usuario->guardarImagen();
                    //Redirigir al Usuario y Enviar Correo con token
                    Mail::enviarConfirmacion($usuario->email, $usuario->nombre." ".$usuario->apellido, $usuario->token);
                    header("Location: /confirmar");
                } else {
                    $usuario::setAlertas("error", $guardar["error"]);
                }
                
            }
        }

        $alertas = Usuarios::getAlertas();
        Router::views("log/registro", [
            "alertas" => $alertas,
            "usuario" => $usuario
        ]);
    }

    public static function olvido() {

        Router::views("log/registro", [

        ]);
    }

    public static function login() {

        if($_SERVER["REQUEST_METHOD"]==="POST") {
            $email = sanitizarEntradas($_POST["email"]);
            $password = sanitizarEntradas($_POST["password"]);

            $registro = Usuarios::where("email", $email);
            if($registro["resultado"]==false) {
                Usuarios::setAlertas("error", "Usuario Invalido");
            } else {
                $usuario = $registro["registro"];
                if(password_verify($password, $usuario->password) && $usuario->confirmado == 1) {
                    session_start();
                    $_SESSION["id"] = $usuario->id;
                    $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                    $_SESSION["login"] = true;
                    $_SESSION["admin"] = $usuario->admin;
                    if($usuario->admin !== 1) {
                        header("Location: /dashboard");  
                    } else {
                        header("Location: /admin");
                    }
                } else {
                    Usuarios::setAlertas("error", "Contraseña Incorrecta");
                }
            }
        }

        $alertas = Usuarios::getAlertas();
        Router::views("log/login", [
            "alertas" => $alertas
        ]);
    }

    public static function logOut() {
        session_start();
        if($_SESSION["login"]) {
            session_destroy();
            header("Location: /");
        }
    }

    public static function confirmar() {

        Router::views("log/confirmar", [

        ]);
    }

    public static function inicio() {
        
        Router::views("inicio/index", [
            
        ]);
    }

    public static function contacto() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            switch($_POST) {
                case($_POST["name"]=="") :
                    Usuarios::setAlertas("error", "Ingrese un nombre");
                    break;
                case($_POST["mensaje"]=="") :
                    Usuarios::setAlertas("error", "Ingrese un mensaje");
                    break;
                case($_POST["contacto"] == 0) :
                    Usuarios::setAlertas("error", "Ingrese un metodo de contacto");
                    break;
                default :
                    Usuarios::setAlertas("exito", "Mensaje Enviado");
            }
        }

        $alertas = Usuarios::getAlertas();
        Router::views("inicio/contacto", [
            "alertas" => $alertas
        ]);
    }

    public static function boletos() {

        Router::views("inicio/boletos", [

        ]);
    }

    public static function profesionales() {
        $profesionales = Profesional::consultar()["registro"];

        Router::views("inicio/profesionals", [
            "profesionales" => $profesionales
        ]);
    }
}