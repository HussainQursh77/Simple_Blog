<?php
require_once 'post.php';

if (isset($_GET['id'])) {
    $post = new Post();
    if ($post->read($_GET['id'])) {

    } else {
        echo "Post not found.";
    }
} else {
    echo "No post ID specified.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .meta {
            font-size: 0.9em;
            color: #888;
            margin-bottom: 20px;
            text-align: center;
        }

        .content {
            line-height: 1.6;
            margin-bottom: 30px;
        }

        a.button {
            display: inline-block;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s ease;
        }

        a.button.edit {
            background-color: #f0ad4e;
        }

        a.button.delete {
            background-color: #d9534f;
        }

        a.button:hover {
            opacity: 0.8;
        }

        a.button.delete:hover {
            background-color: #c9302c;
        }

        a.button+a.button {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($post) && $post->id): ?>
            <h1><?php echo htmlspecialchars($post->title); ?></h1>
            <p class="content"><?php echo nl2br(htmlspecialchars($post->content)); ?></p>
            <p class="meta"><strong>Author:</strong> <?php echo htmlspecialchars($post->author); ?> |
                <em>Created at: <?php echo htmlspecialchars($post->created_at); ?></em> |
                <em>Updated at: <?php echo htmlspecialchars($post->updated_at); ?></em>
            </p>
            <a href="edit_post.php?id=<?php echo $post->id; ?>" class="button edit">Edit</a>
            <a href="delete_post.php?id=<?php echo $post->id; ?>"
                onclick="return confirm('Are you sure you want to delete this post?');" class="button delete">Delete</a>
            <br><br>
            <a href="index.php" class="button">Back to list</a>
        <?php endif; ?>
    </div>
</body>

</html>