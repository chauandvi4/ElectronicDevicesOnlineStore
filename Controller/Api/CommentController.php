<?php

// Order status:
// Pending
// Paid
// Delivering
// Delivered
// Cancel

class CommentController extends BaseController
{
        /**
         * "/user/list" Endpoint - Get list of users
         */
        public function listAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $commentModel = new CommentModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();

                return $commentModel->getAll($offset, $limit);
        }

        public function countAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $commentModel = new CommentModel();

                return $commentModel->count();
        }

        public function getOneAction()
        {
                $this->isGET();

                $commentModel = new CommentModel();
                $id = $this->getIdParam();

                return $commentModel->getOne($id);
        }

        public function createAction()
        {
                $this->isPOST();
                $commentModel = new CommentModel();
                $data = $this->getPostData();

                // TODO: Validate inputs 

                return $commentModel->create($data);
        }

        public function updateAction()
        {
                $this->isPUT();
                //isAdmin();

                $commentModel = new CommentModel();

                $id = $this->getIdParam();
                $data = $this->getPostData();

                // TODO: Validate inputs 

                return $commentModel->update($id, $data);
        }

        public function deleteAction()
        {
                $this->isDELETE();
                $commentModel = new CommentModel();
                $id = $this->getIdParam();

                return $commentModel->delete($id);
        }

        public function getCommentsAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $commentModel = new CommentModel();
                $id = $this->getIdParam();

                return $commentModel->getComments($id);
        }
}
