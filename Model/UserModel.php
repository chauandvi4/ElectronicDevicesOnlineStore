<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    private $table_name = "users";

    // object properties
    public $id;
    public $full_name;
    public $is_admin;
    public $email;
    public $password;

    public function count()
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `users`");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT id,email,full_name,is_admin,phone,address,image_url,status,created_at,updated_at 
            FROM users 
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id)
    {
        $stmt = $this->pdo->prepare('
            SELECT id,email,full_name,is_admin,phone,address,image_url,status,created_at,updated_at 
            FROM users 
            WHERE id=?
        ');

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO users (email,full_name,phone,address,status,password)
            VALUES (?,?,?,?,?,"123456")
        ');

        return $stmt->execute([$data->email, $data->full_name, $data->phone, $data->address, $data->status]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('
            UPDATE users SET 
                email = ?, 
                full_name = ?, 
                phone = ?, 
                address = ?, 
                status = ?
            WHERE id = ?
        ');

        return $stmt->execute([$data->email, $data->full_name, $data->phone, $data->address, $data->status, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM users WHERE id = ?
        ');

        return $stmt->execute([$id]);
    }

    // create new user record
    function register()
    {
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
             SET
                 full_name = :full_name,
                 email = :email,
                 password = :password";

        // prepare the query
        $stmt = $this->pdo->prepare($query);

        // sanitize
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        // bind the values
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);

        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
        // execute the query, also check if query was successful
        return $stmt->execute();
    }

    // check if given email exist in the database
    function emailExists()
    {
        // query to check if email exists
        $query = "SELECT id, full_name, password, is_admin
             FROM " . $this->table_name . "
             WHERE email = ?
             LIMIT 0,1";

        // prepare the query
        $stmt = $this->pdo->prepare($query);

        // sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind given email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if ($num > 0) {

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // assign values to object properties
            $this->id = $row['id'];
            $this->full_name = $row['full_name'];
            $this->password = $row['password'];
            $this->is_admin = $row['is_admin'];

            // return true because email exists in the database
            return true;
        }

        // return false if email does not exist in the database
        return false;
    }

    // update a user record
    public function resetPass($password, $id)
    {

        $password = htmlspecialchars(strip_tags($password));
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare('
        UPDATE users SET 
            password = ?
        WHERE id = ?
        ');

        return $stmt->execute([$password_hash, $id]);
    }
}
