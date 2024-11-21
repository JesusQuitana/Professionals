<?php
namespace Controller;

use Model\Profesional;
use Model\Proyectos;
use Model\ProyectosProfesionals;
use Model\Usuarios;

abstract class ApiController {
    public static function confirmar() {
        //241452
        $token = $_POST["token"];
        //Verificar que exista el usuario y el token sea valido
        $registro = Usuarios::where("token", $token);
        if($registro["resultado"]) {
            $usuario = $registro["registro"];
            $usuario->token = 0;
            $usuario->confirmado = 1;
            $usuario->setAtributos();
            jsonDebug($usuario::actualizar());
        } else {
            jsonDebug($registro);
        }
    }

    public static function count() {
        $respuesta = Profesional::count();

        jsonDebug($respuesta);
    }

    public static function paginacion() {
        $limit = $_POST["limit"];
        $offset = $_POST["offset"];
        
        $sql = "SELECT id, CONCAT(nombre, ' ', apellido) as nombre, CONCAT(pais,' ', ciudad) as ubicacion FROM profesionales LIMIT ".$limit." OFFSET ".$offset;

        $registros = Profesional::consultarSql($sql);

        jsonDebug($registros);
    }

    public static function editarProfesional() {
        $id = $_POST["id"];
        $respuesta = Profesional::delete($id);

        jsonDebug($respuesta);
    }

    public static function countUsers() {
        $respuesta = Usuarios::count();

        jsonDebug($respuesta);
    }

    public static function paginacionUsers() {
        $limit = $_POST["limit"];
        $offset = $_POST["offset"];
        
        $sql = "SELECT id, CONCAT(nombre, ' ', apellido) as nombre, email FROM usuarios LIMIT ".$limit." OFFSET ".$offset;

        $registros = Usuarios::consultarSql($sql);

        jsonDebug($registros);
    }

    public static function editarProfesionalUsers() {
        $id = $_POST["id"];
        $respuesta = Usuarios::delete($id);

        jsonDebug($respuesta);
    }

    public static function profesionalesAll() {
        $habilidad = strtolower($_POST["habilidad"]);
        $sql = "SELECT * FROM profesionales WHERE tags LIKE '%$habilidad%'";
        $registro = Profesional::consultarSql($sql);

        jsonDebug($registro);
    }

    public static function projectsAll() {
        $sql = "SELECT * FROM proyectos WHERE usuario_id=".$_POST["id"];
        $registro = Proyectos::consultarSql($sql);

        jsonDebug($registro);
    }

    public static function countProyectos() {
        $respuesta = Proyectos::count();

        jsonDebug($respuesta);
    }

    public static function paginacionProyectos() {
        $limit = $_POST["limit"];
        $offset = $_POST["offset"];
        
        $sql = "SELECT * FROM proyectos LIMIT ".$limit." OFFSET ".$offset;

        $registros = Proyectos::consultarSql($sql);

        jsonDebug($registros);
    }

    public static function findUser() {
        $usuario = Usuarios::where("id", $_POST["usuario_id"]);

        jsonDebug($usuario);
    }

    public static function findProfesios() {
        $sql = "SELECT * FROM proyectosprofesionals WHERE proyecto_id = ".$_POST["id"];
        $registros = ProyectosProfesionals::consultarSql($sql)["registro"];

        foreach($registros as $registro) {
            $array[] = Profesional::where("id", $registro->profesional_id);
        }

        jsonDebug(["resultado"=>true, "registro"=>$array]);
    }

    public static function estatusProyecto() {
        $proyecto = Proyectos::where("id", $_POST["proyecto_id"])["registro"];

        if($proyecto->confirmado == 0) {
            $sql = "UPDATE proyectos SET confirmado=1 WHERE id=".$_POST["proyecto_id"];
            jsonDebug(Proyectos::sql($sql));
        } else {
            $sql = "UPDATE proyectos SET confirmado=0 WHERE id=".$_POST["proyecto_id"];
            jsonDebug(Proyectos::sql($sql));
        }
    }

    public static function profesionals() {

        jsonDebug([]);
    }
}