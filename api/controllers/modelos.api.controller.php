<?php
require_once 'api/models/api.modelos.model.php';
class ModelosApiController extends ApiController
{
    private $modelosModel;
    private $apiview;
    public function __construct(){
        $this->modelosModel = new ModelosModel();
        $this->apiview = new APIView();
    }

    public function getModelo($params = [])
    {
        if (empty($params)) {
            $sort = isset($_GET['sort']) ? $_GET['sort'] : null;
            $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'ASC';

            $modelos = $this->modelosModel->getModelos();
            if ($modelos) {
                if ($sort && $order) {
                    switch ($sort) {
                        case 'cilindrada':
                            $motosOrdenadas = $this->modelosModel->getModelosByCilindrada($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        case 'velocidad':
                            $motosOrdenadas = $this->modelosModel->getModelosByVelocidad($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        case 'tipo':
                            $motosOrdenadas = $this->modelosModel->getModelosByTipo($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        case 'capacidad':
                            $motosOrdenadas = $this->modelosModel->getModelosByCapacidad($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        default:
                            $this->apiView->response("no hay motos para mostrar", 404);
                            break;
                    }
                } else {
                    $this->apiView->response($modelos, 200);
                }
            } else {
                $this->apiView->response("no hay motos para mostrar", 404);
            }
        } else if (isset($params[':modelo'])) {
            $modelo = $params[':modelo'];
            $moto = $this->modelosModel->getModelosByModelo($modelo);
            if ($moto) {
                if (isset($params[':subrecurso'])) {
                    switch ($params[':subrecurso']) {
                        case 'cilindrada':
                            $this->apiView->response($moto->cilindrada, 200);
                            break;
                        case 'velocidad':
                            $this->apiView->response($moto->velocidad_max, 200);
                            break;
                        case 'tipo':
                            $this->apiView->response($moto->tipo_uso, 200);
                            break;
                        case 'capacidad':
                            $this->apiView->response($moto->capacidad_tanque, 200);
                            break;
                        default:
                            $this->apiView->response('La moto no contiene ' . $params[':subrecurso'] . '.', 404);
                            break;
                    }
                } else {
                    $this->apiView->response($moto, 200);
                }
            } else {
                $this->apiView->response('no existe moto con el modelo = ' . $modelo, 404);
            }
        }
    }

    public function deleteModelo($params = [])
    {
        if (isset($params[':modelo'])) {
            $modelo = $params[':modelo'];
            $existeModelo = $this->modelosModel->getModelosByModelo($modelo);
            $existeMoto = $this->motosModel->getModeloMoto($modelo);
            if ($existeModelo) {
                if (!$existeMoto) {
                    $this->modelosModel->deleteModelo($modelo);
                    $this->apiView->response('se eliminó la moto con éxito la moto con modelo = ' . $modelo, 200);
                    $this->getModelo();
                } else {
                    $this->apiView->response('no se puede borrar, existe moto con ese modelo', 404);
                }
            } else {
                $this->apiView->response('no existe moto con ese modelo', 404);
            }
        }
    }

    public function editModelo($params = [])
    {
        if (isset($params[':modelo'])) {
            $modelo = $params[':modelo'];
            $existeModelo = $this->modelosModel->getModelosByModelo($modelo);
            if ($existeModelo) {
                $body = $this->getData();
                if (isset($body->cilindrada) && isset($body->velocidad_max) && isset($body->tipo_uso) && isset($body->capacidad_tanque)) {
                    $this->modelosModel->updateModelo($modelo, $body->cilindrada, $body->velocidad_max, $body->tipo_uso, $body->capacidad_tanque);
                    $this->apiView->response('se actualizó la moto con exito', 200);
                    $this->getModelo();
                } else {
                    $this->apiView->response('complete todos los campos', 400);
                }
            } else {
                $this->apiView->response('no existe moto con ese modelo', 404);
            }
        } else {
            $this->apiView->response('seleccione la moto', 400);
        }
    }

    public function insertModelo()
    {
        $body = $this->getData();
        if (isset($body->modelo) && isset($body->cilindrada) && isset($body->velocidad_max) && isset($body->tipo_uso) && isset($body->capacidad_tanque)) {
            $modelo = $body->modelo;
            $moto = $this->modelosModel->getModelosByModelo($modelo);
            if (!$moto) {
                $this->modelosModel->addModelo($body->modelo, $body->cilindrada, $body->velocidad_max, $body->tipo_uso, $body->capacidad_tanque);
                $this->apiView->response('se agregó el modelo correctamente', 201);
                $this->getModelo();
            } else {
                $this->apiView->response('la moto ya existe', 404);
            }
        } else {
            $this->apiView->response('complete todos los campos', 400);
        }
    }
}
?>