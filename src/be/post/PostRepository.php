<?php

require_once '..\modelclasses\Post.class.php';
require_once '..\SQL.php';

class PostRepository {
    private $sql;

    public function __construct(SQL $sql){
        $this->sql = $sql;
    }

    // Adds post data to the database
    public function createPost(Post $post) {
        $data = [
            'id' => $post->get_id(),
            'title' => $post->get_title(),
            'author_id' => $post->get_author_id(),
            'date_posted' => $post->get_date_posted(),
            'category_id' => $post->get_category_id(),
            'parent_id' => $post->get_parent_id()
        ];
        return $this->sql->insert($post->get_table_name(), $data);
    }

    // Update an existing post
    public function updatePost(Post $post) {
        $data = [
            'title'         => $post->get_title(),
            'author_id'     => $post->get_author_id(),
            'date_posted'   => $post->get_date_posted(),
            'category_id'   => $post->get_category_id(),
            'parent_id'     => $post->get_parent_id()
        ];
        return $this->sql->update($post->get_table_name(), $data, "id = '{$post->get_id()}'");
    }

    // Delete a post
    public function deletePost($id) {
        return $this->sql->delete('post', "id = '$id'");
    }

    // Retrieve data of a specific post
    public function getPostByPostID($id) {
        $result = $this->sql->select('post', '*', "id = '$id'");
        if (count($result) > 0) {
            $postData = $result[0];
            return new Post(
                $postData['id'],
                $postData['title'],
                $postData['author_id'],
                $postData['date_posted'],
                $postData['category_id'],
                $postData['parent_id']
            );
        } else {
            return null;
        }
    }

    // Retrieve data of all posts from the same author
    public function getPostsByAuthorId($author_id) {
        $result = $this->sql->select('post', '*', "author_id = '$author_id'");
        $posts = [];
        foreach ($result as $postData) {
            $posts[] = new Post(
                $postData['id'],
                $postData['title'],
                $postData['author_id'],
                $postData['date_posted'],
                $postData['category_id'],
                $postData['parent_id']
            );
        }
        return $posts;
    }

    // Retrieve the most recent posts
    public function getRecentPosts($limit) {
        $result = $this->sql->select('post', '*', null, 'date_posted DESC', $limit);
        return $this->createPostsArray($result);
    }

    // Retrieve all posts that belong to a certain category
    public function getPostsByCategoryId($categoryId) {
        $result = $this->sql->select('post', '*', "category_id = '$categoryId'");
        return $this->createPostsArray($result);
    }

    // Retrieve all posts from a specific date
    public function getPostsByDate($date) {
        $result = $this->sql->select('post', '*', "DATE(date_posted) = '$date'");
        return $this->createPostsArray($result);
    }

    // Retrieve all posts that contain a specific keyword in the title or content
    public function getPostsByKeyword($keyword) {
        $result = $this->sql->select('post', '*', "title LIKE '%$keyword%' OR content LIKE '%$keyword%'");
        return $this->createPostsArray($result);
    }

    // Retrieve the count of posts written by a specific author
    public function getCountByAuthorId($author_id) {
        $result = $this->sql->select('post', 'COUNT(*) AS count', "author_id = '$author_id'");
        return $result[0]['count'] ?? 0;
    }

    // Retrieve the count of posts within a specific category
    public function getCountByCategoryId($category_id) {
        $result = $this->sql->select('post', 'COUNT(*) AS count', "category_id = '$category_id'");
        return $result[0]['count'] ?? 0;
    }

    // Helper method to create an array of Post objects from an array of associative arrays
    private function createPostsArray($result) {
        $posts = [];
        foreach ($result as $postData) {
            $posts[] = new Post(
                $postData['id'],
                $postData['title'],
                $postData['author_id'],
                $postData['date_posted'],
                $postData['category_id'],
                $postData['parent_id']
            );
        }
        return $posts;
    }

    public function getPostsOrderedByLikes() {
        $query = "
            SELECT 
                p.id, 
                p.title, 
                COUNT(l.id) AS like_count
            FROM 
                post AS p
            LEFT JOIN 
                likes AS l ON p.id = l.post_id
            GROUP BY 
                p.id, 
                p.title
            ORDER BY 
                like_count DESC
        ";

        $result = $this->sql->rawQuery($query);

        return $this->createPostsArrayWithLikes($result);
    }

    private function createPostsArrayWithLikes($result) {
        $posts = [];
        foreach ($result as $postData) {
            $post = new Post(
                $postData['id'],
                $postData['title'],
                $postData['author_id'],
                $postData['date_posted'],
                $postData['category_id'],
                $postData['parent_id']
            );
            $post->set_likes($postData['like_count']);
            $posts[] = $post;
        }
        return $posts;
    }
}
?>
