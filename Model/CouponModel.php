<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class CouponModel extends Database
{
    public function count()
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `coupons`");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT id,name,discount_amount,expiry_date,status,usage_times,created_at,updated_at 
            FROM coupons 
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id)
    {
        $stmt = $this->pdo->prepare('
            SELECT id,name,discount_amount,expiry_date,status,usage_times,created_at,updated_at 
            FROM coupons 
            WHERE id=?
        ');

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO coupons (name,discount_amount,expiry_date,status,usage_times)
            VALUES (?,?,?,?,?)
        ');

        return $stmt->execute([$data->name, $data->discount_amount, $data->expiryDate, $data->status, $data->usageTimes]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('
            UPDATE coupons SET 
                name = ?, 
                discount_amount = ?, 
                expiry_date = ?, 
                status = ?, 
                usage_times = ?
            WHERE id = ?
        ');

        return $stmt->execute([$data->name, $data->discount_amount, $data->expiryDate, $data->status, $data->usageTimes, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM coupons WHERE id = ?
        ');

        return $stmt->execute([$id]);
    }
}
