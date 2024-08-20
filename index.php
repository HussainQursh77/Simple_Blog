<?php
require_once 'post.php';

$post = new Post();
$posts = $post->listAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List Posts</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>All Posts</h1>
        <a href="create_post.php" class="button">Create New Post</a>
        <ul class="post-list">
            <?php foreach ($posts as $p): ?>
                <li>
                    <div class="post-title"><?php echo htmlspecialchars($p['title']); ?></div>
                    <div class="post-actions">
                        <a href="view_post.php?id=<?php echo $p['id']; ?>" class="button view">View Post</a>
                        <a href="edit_post.php?id=<?php echo $p['id']; ?>" class="button edit">Edit</a>
                        <a href="delete_post.php?id=<?php echo $p['id']; ?>" class="button delete"
                            onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>