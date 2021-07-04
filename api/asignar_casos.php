<?
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/AsignarCasos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $caso = new Casos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_usuario'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $caso->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay casos registrados';
                    }
                }
                break;
                case 'search':
                    $_POST = $caso->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $caso->searchRows($_POST['search'])) {
                            $result['status'] = 1;
                            $rows = count($result['dataset']);
                            if ($rows > 1) {
                                $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                            } else {
                                $result['message'] = 'Solo existe una coincidencia';
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
                        $_POST = $caso->validateForm($_POST);
                        if ($caso->setAbogado($_POST['id_abogado'])) {
                            if ($caso->setNombre($_POST['nombre_caso'])) {
                                if ($caso->setEstado($_POST['estado_caso']) ? 1 : 0) {
                                        if ($caso->setMateria($_POST['materia_caso'])) {
                                            if ($caso->setFechaInicio($_POST['fecha_inicio'])){
                                                if ($caso->setFehcaFinalizacion($_POST['fecha_finalizacion'])){
                                                    if ($caso->setObservaciones($_POST['observaciones'])){
                                                        if ($caso->createRow()) {
                                                                $result['status'] = 1;
                                                                 $result['message'] = 'Caso creado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }   
                                                    } else{
                                                        $result['exception'] = 'Observación inválida';
                                                            $result['exception'] = 'Fecha de finalización incorrecta';
                                                          }
                                                } else{
                                                    $result['exception'] = 'Fecha de inicio incorrecta';
                                                      }
                                            }
                                        } else {
                                          $result['exception'] = 'Materia incorrecta';
                                        }
                                    } else {
                                    $result['exception'] = 'Estado incorrecto';
                                    }
                                } else {
                                   $result['exception'] = 'Caso incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Abogado no disponible';
                        }case 'delete':
                if ($producto->setId($_POST['id_producto'])) {
                    if ($data = $producto->readOne()) {
                        if ($producto->deleteRow()) {
                            $result['status'] = 1;
                            if ($producto->deleteFile($producto->getRuta(), $data['imagen_producto'])) {
                                $result['message'] = 'Producto eliminado correctamente';
                            } else {
                                $result['message'] = 'Producto eliminado pero no se borró la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                } else {
                    $result['exception'] = 'Producto incorrecto';
                }
                case 'delete':
                    if ($caso->setId($_POST['id_producto'])) {
                        if ($data = $caso->readOne()) {
                            if ($caso->deleteRow()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Caso inexistente';
                        }
                    } else {
                        $result['exception'] = 'Caso incorrecto';
                    }
                     break;
                     default:
                     $result['exception'] = 'Acción no disponible dentro de la sesión';
                    }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
