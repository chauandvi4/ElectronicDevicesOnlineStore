<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class ProductModel extends Database
{
    public $fields = 'id,name,description,price,status, category, rate, freeShip,height,length,weight,width, image_url,created_at,updated_at';
    public function count()
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `products`");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT ' . $this->fields . '
            FROM products 
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getManyIds($array_ids)
    {
        $stmt = $this->pdo->prepare('
        SELECT ' . $this->fields . '
        FROM products 
        WHERE id IN (' . $this->arrayToQuestionMarks($array_ids) . ')
        ');

        $stmt->execute($array_ids);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countFilter($priceFrom, $priceTo, $category, $name)
    {

        $param['priceFromValue'] = $param['priceFromValue1'] = !empty($priceFrom) ?  $priceFrom  : null;
        $param['priceToValue'] = $param['priceToValue1']  = !empty($priceTo)  ? $priceTo  : null;
        $param['categoryValue'] = $param['categoryValue1']  = !empty($category)  ? $category  : null;
        $param['nameValue'] = $param['nameValue1']  = !empty($name)  ? "%" . $name . "%" : null;
        // var_dump($param);
        $sql = 'SELECT count(*)
                    FROM products 
                    WHERE (price >= :priceFromValue or :priceFromValue1 is null)
                    AND (price <= :priceToValue or :priceToValue1  is null)
                    AND (category = :categoryValue or :categoryValue1  is null)
                    AND (name LIKE :nameValue or :nameValue1 is null)';


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($param);

        return $stmt->fetchColumn();
    }

    public function getListFilter($offset, $limit, $priceFrom, $priceTo, $category, $name)
    {
        $param['priceFromValue'] = $param['priceFromValue1'] = !empty($priceFrom) ?  $priceFrom  : null;
        $param['priceToValue'] = $param['priceToValue1']  = !empty($priceTo)  ? $priceTo  : null;
        $param['categoryValue'] = $param['categoryValue1']  = !empty($category)  ? $category  : null;
        $param['nameValue'] = $param['nameValue1']  = !empty($name)  ? "%" . $name . "%" : null;
        $param['offsetValue'] = $offset;
        $param['limitValue'] = $limit;

        $sql = 'SELECT ' . $this->fields . '
                    FROM products 
                    WHERE (price >= :priceFromValue or :priceFromValue1 is null)
                    AND (price <= :priceToValue or :priceToValue1  is null)
                    AND (category = :categoryValue or :categoryValue1  is null)
                    AND (name LIKE :nameValue or :nameValue1 is null)
                    ORDER BY id DESC 
                    LIMIT :offsetValue,:limitValue';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($param);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOne($id)
    {
        $stmt = $this->pdo->prepare('
            SELECT ' . $this->fields . '
            FROM products 
            WHERE id=?
        ');

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO products (name,description,price,status,category,rate,freeShip,height,length,weight,width,image_url)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
        ');

        return $stmt->execute([$data->name, $data->description, $data->price, $data->status, $data->category, $data->rate, $data->freeShip, $data->height, $data->length, $data->weight, $data->width, $data->image_url]);
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
                height = ?,
                length = ?,
                weight = ?,
                width = ?,
                image_url = ?
            WHERE id = ?
        ');

        return $stmt->execute([$data->name, $data->description, $data->price, $data->status, $data->category,  $data->rate, $data->freeShip, $data->height, $data->length, $data->weight, $data->width, $data->image_url, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM products WHERE id = ?
        ');

        return $stmt->execute([$id]);
    }
}
