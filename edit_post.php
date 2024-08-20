<?php
require_once 'post.php';
require_once 'Validator.php';

$errors = [];
$post = new Post();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];


    $validator = new Validator();


    [$errors, $title, $content, $author] = $validator->validatePostData($title, $content, $author);

    if (empty($errors)) {
        $post->title = $title;
        $post->content = $content;
        $post->author = $author;

        if ($post->update($_POST['id'])) {
            header('Location: view_post.php?id=' . $_POST['id']);
            exit;
        } else {
            $errors[] = "Failed to update post.";
        }
    }
} elseif (isset($_GET['id'])) {
    if (!$post->read($_GET['id'])) {
        echo "Post not found.";
        exit;
    }
} else {
    echo "No post ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Post</h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($post->id): ?>
            <form action="edit_post.php" method="post">
                <input type="hidden" name="id" value="<?php echo $post->id; ?>">

                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $post->title; ?>" required><br>

                <label for="content">Content:</label>
                <textarea id="content" name="content" required><?php echo $post->content; ?></textarea><br>

                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="<?php echo $post->author; ?>" required><br>

                <input type="submit" value="Update Post">
            </form>

            <br>
            <a href="index.php">Back to list</a>
        <?php endif; ?>
    </div>
</body>

</html>