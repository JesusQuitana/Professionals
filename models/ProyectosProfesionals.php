<?php
namespace Model;

class ProyectosProfesionals extends ActiveRecord {
    protected static $tabla = "proyectosprofesionals";
    protected static $atributos = [];
    protected static $columnasDB = [
        "proyecto_id",
        "profesional_id"
    ];
    public int $proyecto_id;
    public int $profesional_id;

    public function __construct($datos = [])
    {
        $this->sincronizarDatos($datos);
    }

    public function sincronizarDatos(array $datos) {
        $this->proyecto_id = $datos["proyecto_id"] ?? 0;
        $this->profesional_id = $datos["profesional_id"] ?? 0;
    }

    public function setAtributos() {
        foreach(static::$columnasDB as $columna) {
            static::$atributos[$columna] = $this->$columna;
        }
    }

    public function validar() {
        if($this->proyecto_id == 0 || $this->profesional_id == 0) {
            static::setAlertas("error", "Debe asignar al menos 1 Profesional");
        }
        return static::$alertas;
    }
}