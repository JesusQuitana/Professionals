<?php
namespace Model;

use Exception;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class Usuarios extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = [
        "id",
        "nombre",
        "apellido",
        "email",
        "imagen",
        "password",
        "token",
        "confirmado",
        "admin"
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $imagen;
    public $imagenFile;
    public $password;
    public $password_repeat;
    public $token;
    public $confirmado;
    public $admin;

    public function __construct($datos = [], $imagen = [])
    {
        $this->sincronizarDatos($datos, $imagen);
    }

    public function sincronizarDatos(array $datos, array $imagen) {
        $this->nombre = $datos["nombre"] ?? "";
        $this->apellido = $datos["apellido"] ?? "";
        $this->email = $datos["email"] ?? "";
        $this->imagenFile = $imagen["img"] ?? "";
        $this->password = $datos["password"] ?? "";
        $this->password_repeat = $datos["password_repeat"] ?? "";
        $this->token = $datos["token"] ?? 0;
        $this->confirmado = $datos["confirmado"] ?? 0;
        $this->admin = $datos["admin"] ?? 0;
    }

    public function validar() {
        if($this->nombre == "" || $this->apellido == "" || $this->email == "" || $this->password == "") {
            static::setAlertas("error", "Todos los campos son obligatorios");
        }
        if($this->password !== $this->password_repeat || strlen($this->password)<6) {
            static::setAlertas("error", "Las contraseñas deben coincidir y contener al menos 6 caracteres");
        }
        if($this->imagenFile["error"] == 1 || $this->imagenFile["size"]>1000000) {
            static::setAlertas("error", "Tamaño max de imagen: 1Mb");
        }
        if(empty(static::$alertas["error"])) {
            if($this->confirmado == 0) {
                $this->token = rand(100000, 999999);
            }

            if($this->imagenFile["name"] !== "") {
                $this->imagen = md5(uniqid(rand(), true));
            } else {
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

    public function hashPassword() {
        $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);
        $this->password = $passwordHash;
    }

    public function guardarImagen() {
        //Generar un nombre de Imagen
        $carpetaImagen = dirname(__DIR__).'/public/build/img/users';

        //Crear carpeta para las Imagenes
        if(!is_dir($carpetaImagen)) {
            mkdir($carpetaImagen, 0755, true);
        }
        
        //Crear y guardar la Imagen
        $manager = ImageManager::gd();

        try {
            $imagenpng = $manager->read($this->imagenFile["tmp_name"])->cover(800, 800);
            $imagenwebp = $manager->read($this->imagenFile["tmp_name"])->cover(800, 800);

            $imagenpng->save($carpetaImagen . "/" . $this->imagen . ".png", 75);
            $imagenwebp->save($carpetaImagen . "/" . $this->imagen . ".webp", 75);

            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

    public static function eliminarImagen($imagen) {
        $carpetaImagen = dirname(__DIR__).'/public/build/img/users';

        if(file_exists($carpetaImagen . "/" . $imagen . ".webp") && $imagen !== "user") {
            unlink($carpetaImagen . "/" . $imagen . ".webp");
        }
        if(file_exists($carpetaImagen . "/" . $imagen . ".png") && $imagen !== "user") {
            unlink($carpetaImagen . "/" . $imagen . ".png");
        }
    }
}