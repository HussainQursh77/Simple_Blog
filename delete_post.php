<?php
require_once 'post.php';

if (isset($_GET['id'])) {
    $post = new Post();
    if ($post->delete($_GET['id'])) {
        echo "Post deleted successfully!";
    } else {
        echo "Failed to delete post.";
    }
} else {
    echo "No post ID specified.";
}

header('Location: index.php');
exit;
