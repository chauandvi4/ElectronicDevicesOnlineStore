<?php
class WishlistController extends BaseController
{
        public function listAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $wishlistModel = new WishlistModel();
                ['offset' => $offset, 'limit' => $limit, 'userId' => $userId] = $this->getQueryParams();

                return $wishlistModel->getAll($offset, $limit, $userId);
        }

        public function productListAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $productModel = new ProductModel();
                $wishlistModel = new WishlistModel();
                ['offset' => $offset, 'limit' => $limit, 'userId' => $userId] = $this->getQueryParams();
                $wishList = $wishlistModel->getAll($offset, $limit, $userId);
                $idProductList = array_map(fn ($item): int => $item['product_id'], $wishList);
                return $productModel->getManyIds($idProductList);
        }

        public function countAction()
        {
                // this function will throw an error if not true;
                $this->isGET();

                $wishlistModel = new WishlistModel();
                ['userId' => $userId] = $this->getQueryParams();


                return $wishlistModel->count($userId);
        }

        public function getOneAction()
        {
                $this->isGET();

                $wishlistModel = new WishlistModel();
                ['userId' => $userId, 'productId' => $productId] = $this->getQueryParams();

                return $wishlistModel->getOne($userId, $productId);
        }

        public function addAction()
        {
                $this->isPOST();

                $wishlistModel = new WishlistModel();

                $data = $this->getPostData();

                // TODO: Validate inputs 

                return $wishlistModel->add($data);
        }

        public function deleteAction()
        {
                $this->isDELETE();

                $wishlistModel = new WishlistModel();
                ['userId' => $userId, 'productId' => $productId] = $this->getQueryParams();


                return $wishlistModel->delete($userId, $productId);
        }
}
