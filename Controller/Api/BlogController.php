<?php
class BlogController extends BaseController
{
        /**
         * "/blog/list" Endpoint - Get list of blogs
         */
        public function listAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $blogModel = new BlogModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();

                return $blogModel->getAll($offset, $limit);
        }

        public function listRecentAction()
        {
                // this function will throw an error if not true;
                $this->isGET();
                $blogModel = new BlogModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();
                return $blogModel->getRecent($offset, $limit);
        }

        public function countAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $blogModel = new BlogModel();

                return $blogModel->count();
        }

        public function getOneAction()
        {
                $this->isGET();

                $blogModel = new BlogModel();
                $id = $this->getIdParam();

                return $blogModel->getOne($id);
        }

        public function createAction()
        {
                $this->isPOST();

                $blogModel = new BlogModel();

                $data = $this->getPostData();

                // TODO: Validate inputs 
                // var_dump($data);
                return $blogModel->create($data);
        }

        public function updateAction()
        {
                $this->isPUT();

                $blogModel = new BlogModel();

                $id = $this->getIdParam();
                $data = $this->getPostData();
                // var_dump('update action');
                // var_dump($data);

                // TODO: Validate inputs 

                return $blogModel->update($id, $data);
        }

        public function deleteAction()
        {
                $this->isDELETE();

                $blogModel = new BlogModel();
                $id = $this->getIdParam();

                return $blogModel->delete($id);
        }

        public function listFilterAction()
        {
                // this function will throw an error if not true;
                $this->isGET();
                $blogModel = new BlogModel();
                ['offset' => $offset, 'limit' => $limit, 'topic_id' => $topic_id, 'title' => $title] = $this->getBlogQueryParams();
                // var_dump("controller");
                // var_dump($title);
                // var_dump($topic_id);
                return $blogModel->getListFilter($offset, $limit, $topic_id, $title);
        }

        public function countFilterAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $blogModel = new BlogModel();
                ["topic_id" => $topic_id, 'title' => $title] = $this->getBlogQueryParams();
                return $blogModel->countFilter($topic_id, $title);
        }


        //Topic
        public function listTopicAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $BlogModel = new BlogModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();

                return $BlogModel->getAllTopic($offset, $limit);
        }


        public function countTopicAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $BlogModel = new BlogModel();

                return $BlogModel->countTopic();
        }

        public function getOneTopicAction()
        {
                $this->isGET();

                $BlogModel = new BlogModel();
                $id = $this->getIdParam();

                return $BlogModel->getOneTopic($id);
        }

        public function createTopicAction()
        {
                $this->isPOST();

                $BlogModel = new BlogModel();

                $data = $this->getPostData();

                // TODO: Validate inputs 
                // var_dump($data);
                return $BlogModel->createTopic($data);
        }

        public function updateTopicAction()
        {
                $this->isPUT();

                $BlogModel = new BlogModel();

                $id = $this->getIdParam();
                $data = $this->getPostData();
                // var_dump('update action');
                // var_dump($data);

                // TODO: Validate inputs 

                return $BlogModel->updateTopic($id, $data);
        }

        public function deleteTopicAction()
        {
                $this->isDELETE();

                $BlogModel = new BlogModel();
                $id = $this->getIdParam();

                return $BlogModel->deleteTopic($id);
        }
}
