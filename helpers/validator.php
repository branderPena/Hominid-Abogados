<?php

class Validator
{
    private $passwordError = null;
    private $imageError = null;
    private $imageName = null;

    public function getPasswordError()
    {
        return $this->passwordError;
    }

    public function getImageName()
    {
        return $this->ImageName;
    }

    public function getimageError()
    {
        return $this->imageError;
    }

    public function validateForm($fields)
    {
        foreach ($fields as $index => $value){
            $value = trim($value);
            $fields[$index] = $value;
        }
        return $fields;
    }
    public function validateNaturalNumber($value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT, array('min_range =>1'))) {
            return true;
        }else {
            return false;
        }
    }

    public function validateImageFile($file, $maxWidth, $maxHeigth)
    {
        if ($file) {
            if ($file['size'] <= 2097152) {
                list($width, $heigth, $type) = getimagesize($file['tmp_name']);
                if ($width <= $maxWidth && $heigth <= $maxHeigth) {
                    if ($type == 1 || $type == 2 || $type == 3) {
                        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                        $this->imageName = uniqid().'.'.$extension;
                        return true;
                    }else {
                        $this->imageError = 'El tipo de la imagen debe ser gif, jpg o png';
                        return false;
                    }
                }else {
                    $this->imageError = 'La dimensión de la imagen es incorrecta';
                    return false;
                }
            }else {
                $this->imageError = 'El tamaño de la imagen debe ser menor a 2MB';
                return false;
            }
        }else {
            $this->imageError = 'El archivo de la imagen no existe';
            return false;
        }
    }

    public function validateEmail($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else {
            return false;
        }
    }
    
    public function validateBoolean($value)
    {
        if ($value == 1 || $value == 0 || $value == true || $value == false) {
            return true;
        }else {
            return false;
        }
    }

    public function validateString($value, $minimum, $maximum)
    {
       if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\,\;\.\#]{'.$minimum.','.$maximum.'}$/', $value)) {
        return true;
        } else {
        return false;
        }
    }

    public function validateAlphabetic($value, $minimum, $maximum)
    {
        if (preg_match('/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{'.$minimum.','.$maximum.'}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateAlphanumeric($value, $minimum, $maximum)
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]{'.$minimum.','.$maximum.'}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateMoney($value)
    {
        // Se verifica que el número tenga una parte entera y como máximo dos cifras decimales.
        if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePassword($value)
    {
        // Se verifica que la longitud de la contraseña sea de al menos 6 caracteres.
        if (strlen($value) >= 6) {
            return true;
        } else {
            $this->passwordError = 'Clave menor a 6 caracteres';
            return false;
        }
    }
    
    public function validateDUI($value)
    {
        // Se verifica que el número tenga el formato 00000000-0.
        if (preg_match('/^[0-9]{8}[-][0-9]{1}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePhone($value)
    {
        // Se verifica que el número tenga el formato 0000-0000 y que inicie con 2, 6 o 7.
        if (preg_match('/^[2,6,7]{1}[0-9]{3}[-][0-9]{4}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateDate($value)
    {
        // Se dividen las partes de la fecha y se guardan en un arreglo en el siguiene orden: año, mes y día.
        $date = explode('-', $value);
        if (checkdate($date[1], $date[2], $date[0])) {
            return true;
        } else {
            return false;
        }
    }

    public function saveFile($file, $path, $name)
    {
        // Se verifica que el archivo exista.
        if ($file) {
            // Se comprueba que la ruta en el servidor exista.
            if (file_exists($path)) {
                // Se verifica que el archivo sea movido al servidor.
                if (move_uploaded_file($file['tmp_name'], $path.$name)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function deleteFile($path, $name)
    {
        // Se verifica que la ruta exista.
        if (file_exists($path)) {
            // Se comprueba que el archivo sea borrado del servidor.
            if (@unlink($path.$name)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>