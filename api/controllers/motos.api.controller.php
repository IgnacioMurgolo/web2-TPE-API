<?php
require_once 'api/models/api.motos.model.php';

class MotosApiController extends ApiController
{
    private $motosModel;
    private $apiView;

    public function __construct(){
        $this->motosModel = new MotosModel();
        $this->apiView = new ApiView();
    }
    public function getMoto($params = [])
    {
        if (empty($params)) {

            $sort = isset($_GET['sort']) ? $_GET['sort'] : null;
            $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'ASC';

            $motos = $this->motosModel->getMotos();
            if ($motos) {
                if ($sort && $order) {
                    switch ($sort) {
                        case 'marca':
                            $motosOrdenadas = $this->motosModel->getMotosByMarca($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        case 'modelo':
                            $motosOrdenadas = $this->motosModel->getMotosByModelo($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        case 'anio':
                            $motosOrdenadas = $this->motosModel->getMotosByAnio($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        case 'precio':
                            $motosOrdenadas = $this->motosModel->getMotosByPrecio($order);
                            $this->apiView->response($motosOrdenadas, 200);
                            break;
                        default:
                            $this->apiView->response("no hay motos para mostrar", 404);
                            break;
                    }
                } else {
                    $this->apiView->response($motos, 200);
                }
            } else {
                $this->apiView->response("no hay motos para mostrar", 404);
            }

        } else if (isset($params[':ID'])) {
            $id = $params[':ID'];
            $moto = $this->motosModel->getMotoById($id);
            if ($moto) {
                if (isset($params[':subrecurso'])) {
                    switch ($params[':subrecurso']) {
                        case 'marca':
                            $this->apiView->response($moto->marca, 200);
                            break;
                        case 'modelo':
                            $this->apiView->response($moto->modelo, 200);
                            break;
                        case 'anio':
                            $this->apiView->response($moto->anio, 200);
                            break;
                        case 'precio':
                            $this->apiView->response($moto->precio, 200);
                            break;
                        default:
                            $this->apiView->response('La moto no contiene ' . $params[':subrecurso'] . '.', 404);
                            break;
                    }
                } else {
                    $this->apiView->response($moto, 200);
                }
            } else {
                $this->apiView->response('no existe moto con la id = ' . $id, 404);
            }
        }
    }

    public function deleteMoto($params = [])
    {
        if (isset($params[':ID'])) {
            $id = $params[':ID'];
            $existeId = $this->motosModel->getMotoById($id);
            if ($existeId) {
                $this->motosModel->deleteMoto($id);
                $this->apiView->response('se eliminó la moto con éxito la moto con id = ' . $id, 200);
                $this->getMoto();
            } else {
                $this->apiView->response('no existe moto con ese id', 404);
            }
        }
    }

    public function editMoto($params = [])
    {
        if (isset($params[':ID'])) {
            $id = $params[':ID'];
            $existeId = $this->motosModel->getMotoById($id);
            if ($existeId) {
                $body = $this->getData();
                if (isset($body->marca) && isset($body->modelo) && isset($body->anio) && isset($body->precio)) {
                    $this->motosModel->updateMoto($id, $body->marca, $body->modelo, $body->anio, $body->precio);
                    $this->apiView->response('se actualizó la moto con exito', 200);
                    $this->getMoto();
                } else {
                    $this->apiView->response('complete todos los campos', 400);
                }
            } else {
                $this->apiView->response('no existe moto con esa id', 404);
            }
        } else {
            $this->apiView->response('seleccione la moto', 400);
        }
    }

    public function insertMoto()
    {
        $body = $this->getData();
        if (isset($body->marca) && isset($body->modelo) && isset($body->anio) && isset($body->precio)) {
            $moto = $this->motosModel->getMoto($body->marca, $body->modelo, $body->anio, $body->precio);
            if (!$moto) {
                $this->motosModel->addMoto($body->marca, $body->modelo, $body->anio, $body->precio);
                $this->apiView->response('se agregó la moto correctamente', 201);
                $this->getMoto();
            } else {
                $this->apiView->response('la moto ya existe', 404);
            }
        } else {
            $this->apiView->response('complete todos los campos', 400);
        }
    }

    public function getMotoFiltrada($params = [])
    {
        $marca = isset($_GET['marca']) ? $_GET['marca'] : null;
        $modelo = isset($_GET['modelo']) ? $_GET['modelo'] : null;
        $anio = isset($_GET['anio']) ? $_GET['anio'] : null;
        $precio = isset($_GET['precio']) ? $_GET['precio'] : null;

        if ($marca != null) {
            $motosByMarca = $this->motosModel->getMotosFiltroMarca($marca);
            $this->apiView->response($motosByMarca, 200);
        } elseif ($modelo != null) {
            $motosByMarca = $this->motosModel->getMotosFiltroModelo($modelo);
            $this->apiView->response($motosByMarca, 200);
        } elseif ($anio != null) {
            $motosByMarca = $this->motosModel->getMotosFiltroAnio($anio);
            $this->apiView->response($motosByMarca, 200);
        } elseif ($precio != null) {
            $motosByMarca = $this->motosModel->getMotosFiltroPrecio($precio);
            $this->apiView->response($motosByMarca, 200);
        }

    }
}
?>