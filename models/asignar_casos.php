<?
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Casos extends Validator
{
    // Declaración de atributos (propiedades).
    private $id_caso = null;
    private $nombre_caso = null;
    private $id_abogado = null;
    private $id_estado_caso = null;
    private $fecha_inicio = null;
    private $fecha_finalizacion = null;
    private $observaciones = null;
    private $id_materia = null;

/* Métodos para validar y asignar valores de los atributos */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_caso = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAbogado($value)
    {
        if ($this->validateAlphanumeric($value, 1,150)) {
            $this->nombre_caso = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_abogado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->id_estado_caso = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setMateria($value)
    {
        if ($this->validateBoolean($value)) {
            $this->id_materia = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFechaInicio($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha_inicio = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFehcaFinalizacion($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha_finalizacion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setObservaciones($value)
    {
        if ($this->validateAlphanumeric($value, 1,500)) {
            $this->id_observaciones = $value;
            return true;
        } else {
            return false;
        }
    }
    
  
    /*
    *   Métodos para obtener valores de los atributos.
    */

    public function getIdCaso()
    {
        return $this->id_Caso;
    }

    public function getNombreCaso()
    {
        return $this->nombre_caso;
    }

    public function getIdAbogado()
    {
        return $this->id_abogado;
    }

    public function getIdEstadoCaso()
    {
        return $this->id_estado_caso;
    }

    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    public function getFechaFinalizacion()
    {
        return $this->fecha_finalizacion;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function getIdMateria()
    {
        return $this->id_materia;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_caso, nombre_caso, id_abogado, id_estado_caso, fecha_inicio, fecha_finalizacion, observaciones, id_materia
                FROM casos INNER JOIN abogados USING(id_abogado)
                WHERE nombre_caso ILIKE ? OR id_abogado ILIKE ?
                ORDER BY nombre_caso';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO caso(nombre_caso, id_abogado, id_estado_caso, fecha_inicio, fecha_finalizacion, observaciones, id_materia)
                VALUES(?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_caso, $this->id_abogado, $this->id_estado_caso, $this->fecha_inicio, $this->fecha_finalizacion, $this->observaciones, $_SESSION['id_materia']);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_caso, nombre_caso, id_abogado, id_estado_caso, fecha_inicio, fecha_finalizacion, observaciones, id_materia
                FROM caso INNER JOIN abogados USING(id_abogados)
                ORDER BY nombre_caso';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_caso, nombre_caso, id_abogado, id_estado_caso, fecha_inicio, fecha_finalizacion, observaciones, id_materia
                FROM caso
                WHERE id_caso = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM casos
                WHERE id_caso = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
