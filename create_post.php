<?php
require_once 'post.php';
require_once 'Validator.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];


    $validator = new Validator();


    [$errors, $title, $content, $author] = $validator->validatePostData($title, $content, $author);

    if (empty($errors)) {
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        $post->author = $author;

        if ($post->create()) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Failed to create post.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Create a New Post</h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="create_post.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea><br>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required><br>

            <input type="submit" value="Create Post">
        </form>

        <br>
        <a href="index.php">Back to list</a>
    </div>
</body>

</html>