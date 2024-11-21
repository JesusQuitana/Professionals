<?php
namespace Controller;

use Intervention\Image\Colors\Profile;
use MVC\Router;
use Model\Profesional;
use Model\Usuarios;

abstract class AdminController {
    public static function inicio() {
        verificarSession("/");

        Router::views("dashboardAdmin/profesionales", [
            
        ], true);
    }

    public static function addProfesionales() {
        $profesional = new Profesional();
        if($_SERVER["REQUEST_METHOD"]==="POST") {

            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
            $profesional->sincronizarDatos($_POST, $_FILES);

            if(empty($profesional->validar()["error"])) {
                //Setear los Atributos
                $profesional->setAtributos();
                //Guardar en la Base de Datos
                $guardar = $profesional::insertar();

                if($guardar["resultado"]) {
                    //Guardar Imagen
                    $profesional->guardarImagen();
                    //Redirigir al Admin
                    header("Location: /admin");
                } else {
                    Profesional::setAlertas("error", $guardar["error"]);
                }
            }
        }

        $alertas = Profesional::getAlertas();
        Router::views("dashboardAdmin/profesional", [
            "profesional" => $profesional,
            "alertas" => $alertas
        ], true);
    }

    public static function editarProfesional() {
        $id = $_GET["p"];
        $registro = Profesional::where("id", $id);
        $profesional = $registro["registro"];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
            $profesional->sincronizarDatos($_POST, $_FILES);
            $imagenAnterior = $profesional->imagen;

            if(empty($profesional->validar()["error"])) {
                //Setear los Atributos
                $profesional->setAtributos();
                //Actualizamos en la Base de Datos
                $actualizar = $profesional::actualizar();

                if($actualizar["resultado"]) {
                    if($_FILES["img"]["name"] !== "") {
                        //Guardar Imagen
                        $profesional->guardarImagen();
                        //Elimina Imagen Anterior
                        $profesional->eliminarImagen($imagenAnterior);
                    }
                    //Redirigir al Admin
                    header("Location: /admin");
                } else {
                    header("Location: /admin");
                }
            }
        }

        $alertas = Profesional::getAlertas();
        Router::views("dashboardAdmin/profesional", [
            "alertas" => $alertas,
            "profesional" => $profesional,
            "redes" => json_decode($profesional->redes)
        ], true);
    }

    public static function proyectos() {
        verificarSession("/");

        Router::views("dashboardAdmin/proyecto", [

        ], true);
    }

    public static function usuarios() {
        verificarSession("/");

        Router::views("dashboardAdmin/usuarios", [

        ], true);
    }

    public static function editarUsuarios() {
        $id = $_GET["p"];
        $registro = Usuarios::where("id", $id);
        $usuario = $registro["registro"];

        $alertas = Usuarios::getAlertas();
        Router::views("dashboardAdmin/usuario", [
            "alertas" => $alertas,
            "profesional" => $usuario
        ], true);
    }
}