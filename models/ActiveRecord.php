<?php
namespace Model;
use PDO;
use Exception;

abstract class ActiveRecord {
    protected static $columnasDB = [];
    protected static $atributos = [];
    protected static $tabla = "";
    protected static $conexionDB;
    protected static $alertas = ["exito", "error"];
    
    public static function conectarDataBase() {
        self::$conexionDB = conectarDB();
    }

    public static function setAlertas(string $tipo, string $mensaje) : void {
        self::$alertas[$tipo] = [$mensaje];
    }

    public static function getAlertas() : array {
        return self::$alertas;
    }

    public static function newObject(array $registros) : object {
        $object = new static;
        foreach($registros as $key=>$value) {
            if(property_exists($object, $key)) {
                $object->$key = $value;
            }
        }
        return $object;
    }

    public static function insertar() : array {
        $query = "INSERT INTO ".static::$tabla." (";
        $query .= join(", ", array_keys(static::$atributos)) . ") VALUES (:";
        $query .= join(", :", array_keys(static::$atributos)) . ")";
        
        try {
            $consulta = self::$conexionDB->prepare($query);
            foreach(static::$atributos as $key=>$value) {
                $consulta->bindValue(":".$key, $value);
            }
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                return ["resultado" => true, "id" => self::$conexionDB->lastInsertId()];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => $e];
        }
    }

    public static function consultar() {
        $query = "SELECT * FROM ".static::$tabla;
        try {
            $consulta = self::$conexionDB->prepare($query);
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
                foreach($registros as $registro) {
                    $resultado[] = self::newObject($registro);
                }
                return ["resultado" => true, "registro" => $resultado];
            } else {
             return ["resultado" => false, "error" => "Registro no encontrado"];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => "Error 500"];
        }
    }

    public static function sql($sql) {
        try {
            $consulta = self::$conexionDB->prepare($sql);
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                return ["resultado" => true];
            } else {
             return ["resultado" => false, "error" => "Registro no encontrado"];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => "Error: ". $e];
        }
    }

    public static function consultarSql($sql) {
        try {
            $consulta = self::$conexionDB->prepare($sql);
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
                foreach($registros as $registro) {
                    $resultado[] = self::newObject($registro);
                }
                return ["resultado" => true, "registro" => $resultado];
            } else {
             return ["resultado" => false, "error" => "Registro no encontrado"];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => "Error: ".$e];
        }
    }

    public static function count() {
        $query = "SELECT COUNT(*) as cantidad FROM ".static::$tabla;
        try {
            $consulta = self::$conexionDB->prepare($query);
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                $respuesta = array_shift($consulta->fetchAll(PDO::FETCH_ASSOC));
                return ["resultado" => true, "cantidad" => $respuesta["cantidad"]];
            } else {
                return ["resultado" => false, "error" => "Registro no encontrado"];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => "Error 500"];
        }
    }

    public static function where(string $columna, $valor) : array {
        $query = "SELECT * FROM ".static::$tabla." WHERE {$columna}=:{$columna}";
        try {
            $consulta = self::$conexionDB->prepare($query);
            $consulta->bindValue(":{$columna}", $valor);
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                $registro = array_shift($consulta->fetchAll(PDO::FETCH_ASSOC));
                $resultado = self::newObject($registro);
                return ["resultado" => true, "registro" => $resultado];
            } else {
             return ["resultado" => false, "error" => "Registro no Válido"];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => "Error 500"];
        }
    }

    public static function actualizar() {
        foreach(static::$atributos as $key=>$value) {
            $array[] = "{$key}=:{$key}";
        }
        $query = "UPDATE ".static::$tabla." SET ";
        $query .= join(", ", array_values($array));
        $query .= " WHERE id=:id";

        try {
            $consulta = self::$conexionDB->prepare($query);
            foreach(static::$atributos as $key=>$value) {
                $consulta->bindValue(":".$key, $value);
            }
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                return ["resultado" => true, "mensaje" => "Confirmado con exito"];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => "Error al Actualizar Registro"];
        }
    }

    public static function delete(string $id) {
        $query = "DELETE FROM ".static::$tabla." WHERE id=:id";
        try {
            $consulta = self::$conexionDB->prepare($query);
            $consulta->bindValue("id", $id);
            $consulta->execute();
            if($consulta->rowCount()!=0) {
                return ["resultado" => true, "mensaje" => "Registro Eliminado"];
            } else {
                return ["resultado" => false, "error" => "Registro no encontrado"];
            }
        }
        catch(Exception $e) {
            return ["resultado" => false, "error" => "Error al Eliminar Registro"];
        }
    }
}