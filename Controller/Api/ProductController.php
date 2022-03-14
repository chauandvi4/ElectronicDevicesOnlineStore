<?php
class ProductController extends BaseController
{
        /**
         * "/product/list" Endpoint - Get list of Products
         */
        public function listAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $productModel = new ProductModel();
                ['offset' => $offset, 'limit' => $limit] = $this->getQueryParams();

                return $productModel->getAll($offset, $limit);
        }

         public function listFilterAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $productModel = new ProductModel();
                ['offset' => $offset, 'limit' => $limit,'priceFrom' => $priceFrom, 'priceTo' => $priceTo,"category"=>$category, 'name'=>$name] = $this->getQueryParams();

                return $productModel->getListFilter($offset, $limit,$priceFrom,$priceTo,$category,$name);
        }


        public function countFilterAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $productModel = new ProductModel();
                ['priceFrom' => $priceFrom, 'priceTo' => $priceTo,"category"=>$category,'name'=>$name] = $this->getQueryParams();
                

                return $productModel->countFilter($priceFrom,$priceTo,$category,$name);
        }

        public function countAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $productModel = new ProductModel();

                return $productModel->count();
        }

        public function getOneAction()
        {
                $this->isGET();

                $productModel = new ProductModel();
                $id = $this->getIdParam();

                return $productModel->getOne($id);
        }

        public function createAction()
        {
                $this->isPOST();

                $productModel = new ProductModel();

                $data = $this->getPostData();
                // var_dump($data);

                // TODO: Validate inputs 

                return $productModel->create($data);
        }

        public function updateAction()
        {
                $this->isPUT();

                $productModel = new ProductModel();

                $id = $this->getIdParam();
                $data = $this->getPostData();

                // TODO: Validate inputs 

                return $productModel->update($id, $data);
        }

        public function deleteAction()
        {
                $this->isDELETE();

                $productModel = new ProductModel();
                $id = $this->getIdParam();

                return $productModel->delete($id);
        }
}
