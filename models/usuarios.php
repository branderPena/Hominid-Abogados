<?php


class Usuario extends Validator
{
    private $id = null;
    private $nombres = null;
    private $apellidos = null;
    private $usuario = null;
    private $correo = null;
    private $clave = null;

    /*Metodo para asignar valores */




    public function SetId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombres= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidos = $value;
            return true;
        }else {
            return false;
        }
    }

    public function setUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true; 
        } else {
            return false;
        }
    }

    /*Metodo para obtener valores de los atributos*/


    public function getId()
    {
        return $this->id;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getClave()
    {
        return $this->clave;
    }

    /*Metodo para gestionar la cuenta del usuario */

//Metodo para verificar la existencia de un usuario
    public function checkUser($usuario)
    {
        $sql = 'SELECT id_usuario FROM usuarios WHERE usuario = ?';
        $params = array($usuario);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_usuario'];
            $this->usuario = $usuario;
            return true;
        } else {
            return false;
        }
    }
//Verificar contraseña
    public function checkPassword($password)
    {
        $sql = 'SELECT clave FROM usuarios WHERE id_usuario = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['clave'])) {
            return true;
        } else {
            return false;
        }
    }
//Cambiar Clave del Usuario
    public function changePassword()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios SET clave = ? WHERE id_usuario= ?';
        $params = array($hash, $_SESSION['id_usuario']);
        return Database::executeRow($sql, $params);
    }
//Existencia de un Usuario
    public function readProfile()
    {
        $sql = 'SELECT id_usuario, nombres, apellidos, usuario, correo
                FROM usuarios
                WHERE id_usuario = ?';
        $params = array($_SESSION['id_usuario']);
        return Database::getRow($sql, $params);
    }
//Editar datos del perfil
    public function editProfile()
    {
        $sql = 'UPDATE usuarios
                SET nombres = ?, apellidos = ?, usuario = ?, correo = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->usuario, $this->correo, $_SESSION['id_usuario']);
        return Database::executeRow($sql, $params);
    }

    /*Metodos para realizar operaciones SCRUD */


    public function searchRows($value)
    {
        //Encriptacion de la clave a la base de datos
        $sql = 'SELECT id_usuario, nombres, apellidos, usuario, correo
                FROM usuarios
                WHERE apellidos ILIKE ? OR nombres ILIKE ?
                ORDER BY apellidos';
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }
//Crear Fila de datos
    public function createRow()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO usuarios(nombres, apellidos, usuario, correo, clave)
                VALUES(?, ?, ?, ?, ?)';
        $params = array($this->nombres, $this->apellidos, $this->usuario, $this->correo, $hash);
        return Database::executeRow($sql, $params);
    }
//Leer todos los datos
    public function readAll()
    {
        $sql = 'SELECT id_usuario, nombres, apellidos, usuario, correo
                FROM usuarios
                ORDER BY apellidos';
        $params = null;
        return Database::getRows($sql, $params);
    }
//Leer solo 1 dato
    public function readOne()
    {
        $sql = 'SELECT id_usuario, nombres, apellidos, correo
                FROM usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
//Actualizar Fila
    public function updateRow()
    {
        $sql = 'UPDATE usuarios
                SET nombres = ?, apellidos = ?, correo = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->id);
        return Database::executeRow($sql, $params);
    }
//Eliminar Fila
    public function deleteRow()
    {
        $sql = 'DELETE FROM usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::executeRow($sql,$params);
    }
}