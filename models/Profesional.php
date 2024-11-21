<?php
namespace Model;
use Intervention\Image\ImageManager;
use Exception;

class Profesional extends ActiveRecord {
    protected static $tabla = "profesionales";
    protected static $columnasDB = [
        "id",
        "nombre",
        "apellido",
        "ciudad",
        "pais",
        "imagen",
        "tags",
        "redes"
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $ciudad;
    public $pais;
    public $ubicacion;
    public $imagen;
    public $imagenFile;
    public $tags;
    public $redes;

    public function __construct($datos = [], $imagen = [])
    {
        $this->sincronizarDatos($datos, $imagen);
    }

    public function sincronizarDatos(array $datos, array $imagen) {
        $this->nombre = $datos["nombre"] ?? "";
        $this->apellido = $datos["apellido"] ?? "";
        $this->ciudad = $datos["ciudad"] ?? "";
        $this->pais = $datos["pais"] ?? "";
        $this->imagenFile = $imagen["img"] ?? "";
        $this->tags = $datos["tags"] ?? "";
        $this->redes = $datos["redes"] ?? "";
    }

    public function validar() {
        if($this->nombre == "" || $this->apellido == "" || $this->ciudad == "" || $this->pais == "") {
            static::setAlertas("error", "Todos los campos son obligatorios");
        }
        if($this->imagenFile["error"] == 1 || $this->imagenFile["size"]>1000000) {
            static::setAlertas("error", "Tamaño max de imagen: 1Mb");
        }
        if(empty(static::$alertas["error"])) {

            if($this->imagenFile["name"] !== "") {
                $this->imagen = md5(uniqid(rand(), true));
            } else if($this->imagenFile["name"] == "" && $this->imagen == null) {
                $this->imagen = "user";
            }
        }
        return static::$alertas;
    }

    public function setAtributos() {
        foreach(static::$columnasDB as $columna) {
            static::$atributos[$columna] = $this->$columna;
        }
    }

    public function guardarImagen() {
        //Generar un nombre de Imagen
        $carpetaImagen = dirname(__DIR__).'/public/build/img/profes';

        //Crear carpeta para las Imagenes
        if(!is_dir($carpetaImagen)) {
            mkdir($carpetaImagen, 0755, true);
        }
        
        //Crear y guardar la Imagen
        $manager = ImageManager::gd();

        try {
            $imagenpng = $manager->read($this->imagenFile["tmp_name"])->cover(480, 480);
            $imagenwebp = $manager->read($this->imagenFile["tmp_name"])->cover(480, 480);

            $imagenpng->save($carpetaImagen . "/" . $this->imagen . ".png", 75);
            $imagenwebp->save($carpetaImagen . "/" . $this->imagen . ".webp", 75);

            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

    public static function eliminarImagen($imagen) {
        $carpetaImagen = dirname(__DIR__).'/public/build/img/profes';

        if(file_exists($carpetaImagen . "/" . $imagen . ".webp") && $imagen !== "user") {
            unlink($carpetaImagen . "/" . $imagen . ".webp");
        }
        if(file_exists($carpetaImagen . "/" . $imagen . ".png") && $imagen !== "user") {
            unlink($carpetaImagen . "/" . $imagen . ".png");
        }
    }
}