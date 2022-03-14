<?php

class CommentModel extends Database
{
    private $fields = 'id,user_id,status,quantity,shipping_fee,total_amount,payment_id,payer_id,created_at,updated_at';

    public function count()
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `comments`");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT *
            FROM comments
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOne($id)
    {
        $stmt = $this->pdo->prepare('
        SELECT c.*, p.name
        FROM comments AS c, products AS p
        WHERE c.id=? AND c.product_id = p.id
        ');

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO comments (user_id, product_id, text, star)
            VALUES (?, ?, ?, ?)
        ');

        return $stmt->execute([$data->user_id, $data->product_id, $data->text, $data->star]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('
            UPDATE comments SET 
                star = ?,
                text = ?
            WHERE id = ?
        ');

        return $stmt->execute([$data->star, $data->text, $id]);
    }

    public function setStatusShipping($data)
    {
        $stmt = $this->pdo->prepare('
            UPDATE orders SET 
                status = ?,
                shipping_id = ?
            WHERE id = ?
        ');

        return $stmt->execute(["Delivering", $data->shipping_id, $data->id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM comments WHERE id = ?
        ');

        return $stmt->execute([$id]);
    }

    public function getComments($id)
    {
        $stmt = $this->pdo->prepare('
            SELECT c.*, u.full_name
            FROM comments AS c, users AS u
            WHERE product_id=? AND c.user_id = u.id
        ');

        $stmt->execute([$id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
