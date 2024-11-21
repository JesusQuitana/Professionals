<?php
namespace Controller;

use MVC\Router;
use Model\Usuarios;
use Model\Proyectos;
use Model\Profesional;
use Model\ProyectosProfesionals;

abstract class UserController {
    public static function inicio() {
        verificarSession("/");

        $alertas = Proyectos::getAlertas();
        Router::views("dashboardUser/index", [
            "alertas" => $alertas,
            "id" => $_SESSION["id"]
        ], true);
    }

    public static function informacion() {
        verificarSession("/");
        $id = $_SESSION["id"];
        $registro = Usuarios::where("id", $id);
        $usuario = $registro["registro"];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario->sincronizarDatos($_POST, $_FILES);
            $imagenAnterior = $usuario->imagen;

            if(empty($usuario->validar()["error"])) {
                //Hashear Password
                $usuario->hashPassword();
                //Setear los Atributos
                $usuario->setAtributos();
                //Actualizamos en la Base de Datos
                $actualizar = $usuario::actualizar();

                if($actualizar["resultado"]) {
                    if($_FILES["img"]["name"] !== "") {
                        //Guardar Imagen
                        $usuario->guardarImagen();
                        //Elimina Imagen Anterior
                        $usuario->eliminarImagen($imagenAnterior);
                    }
                    //Redirigir al Admin
                    header("Location: /informacion");
                } else {
                    header("Location: /informacion");
                }
            }
        }

        $alertas = Usuarios::setAlertas("exito", "Actualize o Edite su información personal");
        $alertas = Usuarios::getAlertas();
        Router::views("dashboardUser/informacion", [
            "alertas" => $alertas,
            "usuario" => $usuario
        ], true);
    }

    public static function addProyecto() {
        verificarSession("/");
        $id = $_SESSION["id"];
        $registro = Usuarios::where("id", $id);
        $usuario = $registro["registro"];

        $proyecto = new Proyectos();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $_POST["usuario_id"] = $_SESSION["id"];
            $profesionals = explode(",", $_POST["profesional_id"]);
            $proyecto->sincronizarDatos($_POST);
                
                if(empty($proyecto->validar()["error"])) {
                    //Setear Atributos
                    $proyecto->setAtributos();
                    //Insertar en la Base de Datos
                    $guardar = $proyecto::insertar();
                    //Si se Insertar
                    if($guardar["resultado"]) {
                        //Guardar proyecto relacionado a los profesionales
                        foreach($profesionals as $profe) {
                            $datospp = [
                                "proyecto_id" => $guardar["id"],
                                "profesional_id" => $profe
                            ];
                            $pp = new ProyectosProfesionals($datospp);
                            if(empty($pp->validar()["error"])) {
                                $pp->setAtributos();
                                $pp::insertar();
                            }
                        }
                        //Redirigir al Usuario
                        header("Location: /dashboard");
                    } else {
                        //Error
                        Proyectos::setAlertas("error", "Error al guardar Registro");
                    }
                }
        }

        $profesionales = Profesional::consultar()["registro"];
        $alertas = Proyectos::getAlertas();
        Router::views("dashboardUser/proyecto", [
            "alertas" => $alertas,
            "usuario" => $usuario,
            "proyecto" => $proyecto,
            "profesionales" => $profesionales
        ], true);
    }
}