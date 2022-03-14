<?php
class CouponController extends BaseController
{
        /**
         * "/user/list" Endpoint - Get list of users
         */
        public function listAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $couponModel = new CouponModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();

                return $couponModel->getAll($offset, $limit);
        }

        public function countAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $couponModel = new CouponModel();

                return $couponModel->count();
        }

        public function getOneAction()
        {
                $this->isGET();

                $couponModel = new CouponModel();
                $id = $this->getIdParam();

                return $couponModel->getOne($id);
        }

        public function createAction()
        {
                $this->isPOST();

                $couponModel = new CouponModel();

                $data = $this->getPostData();

                // TODO: Validate inputs 
                // Make a private method of this class then call it here,
                // So that the new method can be reuse when CREATE and EDIT.
                // If validation is invalid then throw new Exception400(<message>)

                // Example
                // if (true){
                // throw new Exception400("username must have 5-50 chars");
                // }

                return $couponModel->create($data);
        }

        public function updateAction()
        {
                $this->isPUT();

                $couponModel = new couponModel();

                $id = $this->getIdParam();
                $data = $this->getPostData();

                // TODO: Validate inputs 

                return $couponModel->update($id, $data);
        }

        public function deleteAction()
        {
                $this->isDELETE();

                $couponModel = new CouponModel();
                $id = $this->getIdParam();

                return $couponModel->delete($id);
        }
}
