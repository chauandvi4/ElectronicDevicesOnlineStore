<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class WishlistModel extends Database
{
    public $fields = 'id,user_id,product_id,created_at,updated_at';
    public function count($userId)
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `wishlist` WHERE user_id = ?");

        $stmt->execute([$userId]);

        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit, $userId)
    {
        $stmt = $this->pdo->prepare('
            SELECT ' . $this->fields . '
            FROM wishlist 
            WHERE user_id = ?
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$userId,$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function getProductList($offset, $limit, $userId)
    {
        $stmt = $this->pdo->prepare('
            SELECT ' . $this->fields . '
            FROM wishlist 
            WHERE user_id = ?
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$userId,$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($userId, $productId)
    {
        $stmt = $this->pdo->prepare('
            SELECT ' . $this->fields . '
            FROM wishlist 
            WHERE user_id=?
            AND product_id=?
        ');

        $stmt->execute([$userId, $productId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO wishlist (user_id,product_id)
            VALUES (?,?)
        ');

        return $stmt->execute([$data->user_id, $data->product_id]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('
            UPDATE products SET 
                name = ?, 
                description = ?, 
                price = ?, 
                status = ?,
                category = ?,
                rate = ?,
                freeShip = ?,
                image_url = ?
            WHERE id = ?
        ');

        return $stmt->execute([$data->name, $data->description, $data->price, $data->status, $data->category,  $data->rate, $data->freeShip, $data->image_url, $id]);
    }

    public function delete($userId, $productId)
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM wishlist WHERE user_id = ? AND product_id = ?
        ');

        return $stmt->execute([$userId, $productId]);
    }
}
