<?php

use \Firebase\JWT\JWT;

class UserController extends BaseController
{
        /**
         * "/user/list" Endpoint - Get list of users
         */
        public function listAction()
        {
                // this function will throw an error if not true;
                $this->isGET();
                isAdmin();

                $userModel = new UserModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();

                return $userModel->getAll($offset, $limit);
        }

        public function countAction()
        {
                // this function will throw an error if not true;
                $this->isGET();
                isAdmin();

                $userModel = new UserModel();

                return $userModel->count();
        }

        public function getOneAction()
        {
                $this->isGET();
                isAdmin();

                $userModel = new UserModel();
                $id = $this->getIdParam();

                return $userModel->getOne($id);
        }

        public function createAction()
        {
                $this->isPOST();
                isAdmin();

                $userModel = new UserModel();

                $data = $this->getPostData();

                // TODO: Validate inputs 
                // Make a private method of this class then call it here,
                // So that the new method can be reuse when CREATE and EDIT.
                // If validation is invalid then throw new Exception400(<message>)

                // Example
                // if (true){
                // throw new Exception400("username must have 5-50 chars");
                // }

                return $userModel->create($data);
        }

        public function updateAction()
        {
                $this->isPUT();
                isAdmin();

                $userModel = new UserModel();

                $id = $this->getIdParam();
                $data = $this->getPostData();

                // TODO: Validate inputs 

                return $userModel->update($id, $data);
        }

        public function deleteAction()
        {
                $this->isDELETE();
                isAdmin();

                $userModel = new UserModel();
                $id = $this->getIdParam();

                return $userModel->delete($id);
        }

        public function registerAction()
        {
                $this->isPOST();

                $userModel = new UserModel();

                $data = $this->getPostData();

                // set product property values
                $userModel->full_name = $data->full_name;
                $userModel->email = $data->email;
                $userModel->password = $data->password;
                // create the user
                if (!empty($userModel->full_name) && !empty($userModel->email) && !empty($userModel->password) && $userModel->register()) {
                        return array("message" => "User was created.");
                } else {
                        return array("message" => "Unable to create user.");
                }
        }

        public function loginAction()
        {
                $this->isPOST();
                $userModel = new UserModel();
                $data = $this->getPostData();
                // set product property values
                $userModel->email = $data->email;
                $email_exists = $userModel->emailExists();

                // check if email exists and if password is correct
                if ($email_exists && password_verify($data->password, $userModel->password)) {
                        $token = array(
                                "iat" => $GLOBALS['issued_at'],
                                "exp" => $GLOBALS['expiration_time'],
                                "iss" => $GLOBALS['issuer'],
                                "data" => array(
                                        "id" => $userModel->id,
                                        "email" => $userModel->email,
                                        "full_name" => $userModel->full_name,
                                        "is_admin" => $userModel->is_admin
                                )
                        );

                        // generate jwt
                        $jwt = JWT::encode($token, $GLOBALS['key']);
                        return
                                array(
                                        "message" => "Successful login.",
                                        "jwt" => $jwt
                                );
                }

                // login failed
                else {
                        throw new Exception400("Invalid Email or Password!");
                }
        }

        public function resetPassAction()
        {
                $this->isPOST();
                $userModel = new UserModel();
                $data = $this->getPostData();
                $currentUser = isLoggedIn();
                return $userModel->resetPass($data->password, $currentUser->data->id);
        }
        // 
        public function meAction()
        {
                $this->isGET();
                $currentUser = isLoggedIn();
                $userModel = new UserModel();
                return $userModel->getOne($currentUser->data->id);
        }

        public function meUpdateAction()
        {
                $this->isPUT();

                $userModel = new UserModel();

                $id = $this->getIdParam();
                $data = $this->getPostData();

                // TODO: Validate inputs

                return $userModel->update($id, $data);
        }

        // public function validateAction()
        // {
        //         $this->isPOST();
        //         $userModel = new UserModel();
        //         // get posted data
        //         $data = $this->getPostData();

        //         // get jwt
        //         $jwt = isset($data->jwt) ? $data->jwt : "";

        //         // if jwt is not empty
        //         if ($jwt) {

        //                 // if decode succeed, show user details
        //                 try {
        //                         // decode jwt
        //                         $decoded = JWT::decode($jwt, $GLOBALS['key'], array('HS256'));
        //                         $userModel->id = $decoded->data->id;
        //                         $data = $userModel->getOne($userModel->id);
        //                         return array(
        //                                 "message" => "Access granted.",
        //                                 "data" => $data
        //                         );
        //                 }

        //                 // if decode fails, it means jwt is invalid
        //                 catch (Exception $e) {

        //                         // set response code
        //                         http_response_code(401);

        //                         // tell the user access denied  & show error message
        //                         echo json_encode(array(
        //                                 "message" => "Access denied.",
        //                                 "error" => $e->getMessage()
        //                         ));
        //                         exit;
        //                 }
        //         }

        //         // show error message if jwt is empty
        //         else {

        //                 // set response code
        //                 http_response_code(401);

        //                 // tell the user access denied
        //                 echo json_encode(array("message" => "Access denied."));
        //                 exit;
        //         }
        // }

}
