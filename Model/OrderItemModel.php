<?php

class OrderItemModel extends Database
{
    private $fields = "quantity,name,price,product_id,order_id";

    public function create($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO order_items (' . $this->fields . ')
            VALUES (?,?,?,?,?)
        ');

        $stmt->execute([$data->quantity, $data->name, $data->price, $data->product_id, $data->order_id]);

        return ['id' => $this->pdo->lastInsertId()];
    }

    public function getItemsOfOrder($order_id)
    {
        $stmt = $this->pdo->prepare('
            SELECT ' . $this->fields . '
            FROM order_items 
            WHERE order_id = ?
        ');

        $stmt->execute([$order_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
