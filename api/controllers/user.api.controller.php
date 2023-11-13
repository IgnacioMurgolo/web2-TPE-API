<?php
    require_once 'api/controllers/api.controller.php';
    require_once 'api/helpers/auth.api.helper.php';
    require_once 'api/models/user.model.php';
    require_once 'api/views/api.view.php';

    class UserApiController extends ApiController {
        private $model;
        private $authHelper;
        private $apiView;

        function __construct() {
            parent::__construct();
            $this->authHelper = new AuthHelper();
            $this->model = new UserModel();
            $this->apiView = new ApiView();
        }

        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders();

            if(empty($basic)) {
                $this->apiView->response('No envió encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic);

            if($basic[0]!="Basic") {
                $this->apiView->response('Los encabezados de autenticación son incorrectos.', 401);
                return;
            }

            $userpass = base64_decode($basic[1]);
            $userpass = explode(":", $userpass); 

            $username = $userpass[0];
            $password = $userpass[1];

            $user = $this->model->getByUsername($username);

            $userdata = [ "name" => $user];
       
            if($user && password_verify($password, $user->password)) {
                            
                $token = $this->authHelper->createToken($userdata);
                $this->apiView->response($token, 200);
                return;
            } else {
                $this->apiView->response('El usuario o contraseña son incorrectos.', 401);
                return;
            }
        }
    }