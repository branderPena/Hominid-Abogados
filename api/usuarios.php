<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/usuarios.php');


if (isset($_GET['action'])) {
    
    session_start();

    $usuario = new Usuario;

    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);

    if (isset($_SESSION['id_usuario'])) {
        
        switch ($_GET['action']) {
            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesion eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrio un problema al cerrar sesion';
                }
                break;
            case 'readProfile':
                if ($result['dataset'] = $usuario->readProfile()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                }
                break;
            case 'editProfile':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNombres($_POST['nombres_perfil'])) {
                    if ($usuario->setApellidos($_POST['apellidos_perfil'])) {
                        if ($usuario->setUsuario($_POST['usuario_perfil'])) {
                            if ($usuario->setCorreo($_POST['correo_perfil'])) {
                                if ($usuario->editProfile()) {
                                    $result['status'] = 1;
                                    $_SESSION['usuario'] = $usuario->getUsuario();
                                    $result['message'] = 'Perfil modificado correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Correo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                    }else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                }else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'changePassword':
                if ($usuario->setId($_SESSION['id_usuario'])) {
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->checkPassword($_POST['clave_actual'])) {
                        if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                            if ($usuario->setClave($_POST['clave_nueva_1'])) {
                                if ($usuario->changePassword()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Contraseña cambiada correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = $usuario->getPasswordError();
                            }
                        } else {
                            $result['exception'] = 'Claves nuevas diferentes';
                        }
                    } else {
                        $result['exception'] = 'Clave actual incorrecta';
                    }
                }else {
                    $result['exception'] = 'Usuario incorrecto';
                }
                break;
            case 'readAll':
                if ($result['dataset'] = $usuario->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exceptio'] = 'No hay usuarios registrados';
                    }
                }
                break;
            case 'search':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $usuario->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'se encontraron ' . $rows . 'coincidencias';
                        } else {
                            $result['message'] = 'solo existe una coincidencia';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
                case 'create':
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->setNombres($_POST['nombres'])) {
                        if ($usuario->setApellidos($_POST['apellidos'])) {
                            if ($usuario->setUsuario($_POST['usuario'])) {
                                if ($usuario->setCorreo($_POST['correo'])) {
                                    if ($_POST['clave'] == $_POST['confirmar_clave']) {
                                        if ($usuario->setClave($_POST['clave'])) {
                                            if ($usuario->createRow()) {
                                                $result['status'] = 1;
                                                $result['mesage'] = 'Usuario creado Exitosamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = $usuario->getPasswordError();
                                        }
                                    } else {
                                        $result['exception'] = 'Claves diferentes';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Usuario Incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Apellidos incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Nombres Incorrectos';
                    }
                    break;
                    case 'readOne':
                        if ($usuario->setId($_POST['id_usuario'])) {
                            if ($result['dataset'] = $usuario->readOne()) {
                                $result['status'] = 1;
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'Usuario inexistente';
                                }
                            }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                        break;
                    case 'update':
                        $_POST = $usuario->validateForm($_POST);
                        if ($usuario->setId($_POST['id_usuario'])) {
                            if ($usuario->readOne()) {
                                if ($usuario->setNombres($_POST['nombres'])) {
                                    if ($usuario->setApellidos($_POST['apellidos'])) {
                                        if ($usuario->setCorreo($_POST['correo'])) {
                                            if ($usuario->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Usuario modificado correctamente';
                                            } else {
                                                $result['exception'] = Database::getException();
                                            }
                                        } else {
                                            $result['exception'] = 'Correo incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Apellidos incorrectos';
                                    }
                                } else {
                                    $result['exception'] = 'Nombres incorrectos';
                                }
                            } else {
                                $result['exception'] = 'Usuario inexistente';
                            }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                        break;
                case 'delete':
                    if ($_POST['id_usuario'] !=$_SESSION['id_usuario']) {
                        if ($usuario->setId($_POST['id_usuario'])) {
                            if ($usuario->readOne()) {
                                if ($usuario->deleteRow()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Usuario eliminado correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Usuario inexistente';
                            }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                    } else {
                        $result['exception'] = 'No se puede eliminar a si mismo';
                    }
                    break;
            default:
                $result['exception'] = 'Accion no disponible dentro de la sesion ';
        }
    } else {

        switch ($_GET['action']) {
            case 'readAll':
                if ($usuario->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existe al menos un usuario registrado';
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen usuarios registrados';
                    }
                }
                break;
            case 'register':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setNombres($_POST['nombres'])) {
                    if ($usuario->setApellidos($_POST['apellidos'])) {
                        if ($usuario->setUsuario($_POST['usuario'])) {
                            if ($usuario->setCorreo($_POST['correo'])) {
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($usuario->setClave($_POST['clave1'])) {
                                        if ($usuario->createRow()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Usuario registrado correctamente';
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    }else {
                                        $result['exception'] = $usuario->getPasswordError();
                                    }
                                }else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            }else {
                                $result['exception'] = 'Correo incorreto';
                            }
                        }else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                    }else {
                        $result['exception'] = 'Apellidos incorrecto';
                    }
                }else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'logIn':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->checkUser($_POST['usuario'])) {
                    if ($usuario->checkPassword($_POST['clave'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Autenticacion correcta';
                        $_SESSION['id_usuario'] = $usuario->getId();
                        $_SESSION['usuario'] = $usuario->getUsuario();
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Clave incorrecta';
                        }
                    }
                }else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Usuario incorrecto';
                    }
                }
                break;
            default:
                $result['exception'] = 'Accion no disponible fuera de la sesion';
        }
    }

    header('content-type: application/json; charset=utf-8');

    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}