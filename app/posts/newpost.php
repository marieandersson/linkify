<?php

require __DIR__.'/../../autoload.php';

function saveNewPost($db)
{
    $published = date('Y-m-d H:i:s');
    $insertPostIntoDb = 'INSERT INTO posts (user_id, subject, url, description, published)
	VALUES (:user_id, :subject, :url, :description, :published)';
    prepareAndExecute($db, $insertPostIntoDb, [
        ':user_id' => $_SESSION['login']['id'],
        ':subject' => $_POST['subject'],
        ':url' => $_POST['url'],
        ':description' => $_POST['description'],
        ':published' => $published,
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['postLink'])) {
        // escape input to avoid exploit attempts
        foreach ($_POST as $input => $value) {
            $_POST[$input] = escapeInput($value);
        }
        // check if all fields has correct input
        $result = validateNewPostFields($_POST['url']);

        if ($result == MISSING_POST_INPUT) {
            http_response_code(406);
            echo 'Please fill out all fields.';
            exit();
        }
        if ($result == INVALID_URL) {
            http_response_code(406);
            echo 'Invalid url format.';
            exit();
        }
        saveNewPost($db);
        // return new post to js response
        $postId = $db->lastInsertId();
        $getNewPostQuery = "SELECT posts.id, posts.description, posts.subject,
		posts.url, posts.published, posts.edited, posts.user_id,	users.username FROM posts
		INNER JOIN users ON posts.user_id = users.id WHERE posts.id = '{$postId}'";
        $getNewPostStatement = queryToDb($db, $getNewPostQuery);
        $post = $getNewPostStatement->fetch(PDO::FETCH_ASSOC);
        include __DIR__.'/../../views/partials/post.block.php';
        http_response_code(200);
    }
}
