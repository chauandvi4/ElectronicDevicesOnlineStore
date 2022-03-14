<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";


class BlogModel extends Database
{
    public $fields = 'id,title,content,status, topic_id, image_url,created_at,updated_at';
    public function count()
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `blogs`");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getAll($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT id,title,content,status,image_url,topic_id,created_at,updated_at
            FROM blogs 
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecent($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT * FROM (
                SELECT * FROM blogs WHERE status =1 ORDER BY id DESC LIMIT 5
            ) sub
            ORDER BY id DESC
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id)
    {
        $stmt = $this->pdo->prepare('
        SELECT  blogs.id, 
            blogs.title,
            blogs.content,
            blogs.image_url,
            blogs.status,
            blogs.topic_id,
            blogs.created_at,
            blogs.updated_at,
            topics.name as topic_name
            FROM blogs 
        LEFT JOIN topics ON blogs.topic_id=topics.id
        WHERE blogs.id=?
        ');

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO blogs (title,content,status,image_url,topic_id)
            VALUES (?,?,?,?,?)
        ');
        return $stmt->execute([$data->title, $data->content, $data->status, $data->image_url, $data->topic_id]);
    }

    public function update($id, $data)
    {
        // var_dump($id);
        $stmt = $this->pdo->prepare('
            UPDATE blogs SET 
                title = ?, 
                content = ?,
                image_url = ?,
                status = ?,
                topic_id =?
            WHERE id = ?
        ');
        // var_dump($id, $stmt);
        return $stmt->execute([$data->title, $data->content, $data->image_url, $data->status, $data->topic_id, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM blogs WHERE id = ?
        ');

        return $stmt->execute([$id]);
    }



    public function countTopic()
    {
        $stmt = $this->pdo->prepare("SELECT count(*) FROM `topics`");

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getAllTopic($offset, $limit)
    {
        $stmt = $this->pdo->prepare('
            SELECT id,name,description,created_at,updated_at
            FROM topics 
            ORDER BY id DESC 
            LIMIT ?,?
        ');

        $stmt->execute([$offset, $limit]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getOneTopic($id)
    {
        $stmt = $this->pdo->prepare('
            SELECT id,name,description,created_at,updated_at
            FROM topics 
            WHERE id=?
        ');

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTopic($data)
    {
        // var_dump($_FILES[$data]);
        $stmt = $this->pdo->prepare('
            INSERT INTO topics (name,description)
            VALUES (?,?)
        ');
        //return $data;
        return $stmt->execute([$data->name, $data->description]);
    }

    public function updateTopic($id, $data)
    {
        // var_dump($id);
        $stmt = $this->pdo->prepare('
            UPDATE topics SET 
                name = ?, 
                description = ?
            WHERE id = ?
        ');
        // var_dump($id, $stmt);
        return $stmt->execute([$data->name, $data->description, $id]);
    }

    public function deleteTopic($id)
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM topics WHERE id = ?
        ');

        return $stmt->execute([$id]);
    }

    public function getListFilter($offset, $limit, $topic_id, $title)
    {
        $param['topicValue'] = $param['topicValue1']  = !empty($topic_id)  ? $topic_id  : null;
        $param['titleValue'] = $param['titleValue1']  = !empty($title)  ? "%" . $title . "%" : null;
        $param['offsetValue'] = $offset;
        $param['limitValue'] = $limit;

        $sql = 'SELECT blogs.id, 
                        blogs.title, 
                        blogs.content, 
                        blogs.image_url,
                        blogs.created_at,
                        blogs.status,
                        topics.name as topic_name
                        FROM blogs 
                        LEFT JOIN topics ON blogs.topic_id=topics.id
                    WHERE (topic_id = :topicValue or :topicValue1  is null)
                    AND (title LIKE :titleValue or :titleValue1 is null)
                    AND (blogs.status=1)
                    ORDER BY id DESC 
                    LIMIT :offsetValue,:limitValue';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($param);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countFilter($topic_id, $title)
    {
        $param['topicValue'] = $param['topicValue1']  = !empty($topic_id)  ? $topic_id  : null;
        $param['titleValue'] = $param['titleValue1']  = !empty($title)  ? "%" . $title . "%" : null;
        // var_dump($param);
        $sql = 'SELECT count(*)
                    FROM blogs 
                    JOIN topics ON blogs.topic_id=topics.id
                    WHERE (topic_id = :topicValue or :topicValue1  is null)
                    AND (title LIKE :titleValue or :titleValue1 is null)
                    AND (blogs.status=1)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($param);

        return $stmt->fetchColumn();
    }
}
