<?php

class Validator
{
    public function validatePostData($title, $content, $author)
    {
        $errors = [];

        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $content = filter_var($content, FILTER_SANITIZE_STRING);
        $author = filter_var($author, FILTER_SANITIZE_STRING);


        if (empty($title)) {
            $errors[] = "Title is required.";
        }

        if (empty($content)) {
            $errors[] = "Content is required.";
        }

        if (empty($author)) {
            $errors[] = "Author is required.";
        }

        if (!preg_match("/^[a-zA-Z0-9.-_-]{2,25}$/", $title)) {
            $errors[] = 'Enter a valid title.';
        }
        if (!preg_match("/^[a-zA-Z0-9.-_-]{2,25}$/", $content)) {
            $errors[] = 'Enter valid content.';
        }
        if (!preg_match("/^[a-zA-Z0-9.-_-]{2,25}$/", $author)) {
            $errors[] = 'Enter a valid author.';
        }

        return [$errors, $title, $content, $author];
    }
}
