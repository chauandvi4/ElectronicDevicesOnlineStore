<?php

class OrderModel extends Database
{
    private $fields = 'id,user_id,status,quantity,shipping_fee,total_amount,payment_id,payer_id,created_at,updated_at';

    public function count()
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `orders`");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT orders.id as id, users.full_name as user_name, user_id,orders.status as status,quantity,shipping_id,shipping_fee,total_amount,payment_id,payer_id,orders.created_at as created_at,orders.updated_at as updated_at 
            FROM orders
            INNER JOIN users
            ON orders.user_id = users.id
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOne($id)
    {
        $stmt = $this->pdo->prepare('
            SELECT ' . $this->fields . '
            FROM orders 
            WHERE id=?
        ');

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO orders (user_id, shipping_fee, total_amount, quantity, paypal_order_id)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([$data->user_id, $data->shipping_fee, $data->total_amount, $data->quantity, $data->paypal_order_id]);

        return ['id' => $this->pdo->lastInsertId()];
    }

    public function setStatusPaid($data)
    {
        $stmt = $this->pdo->prepare('
            UPDATE orders SET 
                status = ?,
                payment_id = ?,
                payer_id = ?
            WHERE paypal_order_id = ?
        ');

        return $stmt->execute(["Paid", $data->payment_id, $data->payer_id, $data->paypal_order_id]);
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
            DELETE FROM orders WHERE id = ?
        ');

        return $stmt->execute([$id]);
    }
}
