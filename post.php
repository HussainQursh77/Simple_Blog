<?php
include 'database.php';
class Post
{
    private $db;
    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create()
    {
        $query = "INSERT INTO posts (title, content, author, created_at, updated_at) VALUES (:title, :content, :author, NOW(), NOW())";
        $params = [
            ':title' => $this->title,
            ':content' => $this->content,
            ':author' => $this->author
        ];
        return $this->db->execute($query, $params);
    }

    public function read($id)
    {
        $query = "SELECT * FROM posts WHERE id = :id";
        $params = [':id' => $id];
        $result = $this->db->fetch($query, $params);
        if (!empty($result)) {
            $post = $result[0];
            $this->id = $post['id'];
            $this->title = $post['title'];
            $this->content = $post['content'];
            $this->author = $post['author'];
            $this->created_at = $post['created_at'];
            $this->updated_at = $post['updated_at'];
            return true;
        }
        return false;
    }

    public function update($id)
    {
        $query = "UPDATE posts SET title = :title, content = :content, author = :author, updated_at = NOW() WHERE id = :id";
        $params = [
            ':title' => $this->title,
            ':content' => $this->content,
            ':author' => $this->author,
            ':id' => $id
        ];
        return $this->db->execute($query, $params);
    }

    public function delete($id)
    {
        $query = "DELETE FROM posts WHERE id = :id";
        $params = [':id' => $id];
        return $this->db->execute($query, $params);
    }

    public function listAll()
    {
        $query = "SELECT * FROM posts ORDER BY created_at DESC";
        return $this->db->fetch($query);
    }
}
