<?php
namespace Model;

use Exception;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class Proyectos extends ActiveRecord {
    protected static $tabla = "proyectos";
    protected static $columnasDB = [
        "id",
        "nombre",
        "descripcion",
        "precio",
        "confirmado",
        "usuario_id"
    ];
    public $id;
    public $nombre;
    public $descripcion;
    public float $precio;
    public int $confirmado;
    public $usuario_id;

    public function __construct($datos = [])
    {
        $this->sincronizarDatos($datos);
    }

    public function sincronizarDatos(array $datos) {
        $this->nombre = $datos["nombre"] ?? "";
        $this->descripcion = $datos["descripcion"] ?? "";
        $this->precio = $datos["precio"] ?? 0;
        $this->confirmado = $datos["confirmado"] ?? 0;
        $this->usuario_id = $datos["usuario_id"] ?? 0;
    }

    public function setAtributos() {
        foreach(static::$columnasDB as $columna) {
            static::$atributos[$columna] = $this->$columna;
        }
    }

    public function validar() {
        if($this->nombre == "" || $this->descripcion == "" || $this->precio == 0) {
            static::setAlertas("error", "Debe asignar Información del proyecto");
        }
        return static::$alertas;
    }

}