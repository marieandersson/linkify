<?php

require __DIR__.'/../../autoload.php';

function saveNewComment($db, $replyTo = null)
{
    $published = date('Y-m-d H:i:s');
    $insertCommentIntoDb = 'INSERT INTO comments (comment, published, user_id, post_id, reply_to)
	VALUES (:comment, :published, :user_id, :post_id, :reply_to)';
    prepareAndExecute($db, $insertCommentIntoDb, [
        ':comment' => $_POST['comment'],
        ':published' => $published,
        ':user_id' => $_SESSION['login']['id'],
        ':post_id' => $_POST['postId'],
        ':reply_to' => $replyTo,
    ]);
}

function deleteComment($db)
{
    $deleteCommentInDb = 'DELETE FROM comments WHERE id = :commentId OR reply_to = :commentId';
    prepareAndExecute($db, $deleteCommentInDb, [
        ':commentId' => $_POST['commentId'],
    ]);
}

function editComment($db)
{
    $edited = true;
    $editDate = date('Y-m-d H:i:s');
    $editCommentInDb = 'UPDATE comments SET comment = :comment,
	edited = :edited, edit_date = :editDate WHERE id = :commentId';
    prepareAndExecute($db, $editCommentInDb, [
        ':comment' => $_POST['editComment'],
        ':edited' => $edited,
        ':editDate' => $editDate,
        ':commentId' => $_POST['commentIdForEdit'],
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleSubmits($db);
}
function handleSubmits($db)
{
    // escape input to avoid exploit attempts
    foreach ($_POST as $input => $value) {
        $_POST[$input] = escapeInput($value);
    }
    if (isset($_POST['commentPost'])) {
        // check if comment has content
        if (empty($_POST['comment'])) {
            http_response_code(406);
            echo 'Write a comment before posting.';
            exit();
        }
        saveNewComment($db);
        // return new comment to js response
        $commentId = $db->lastInsertId();
        $getNewCommentQuery = "SELECT comments.id, comments.user_id, comments.comment, comments.published, comments.reply_to,
		comments.edited, users.username FROM comments INNER JOIN users ON comments.user_id = users.id
		WHERE comments.id = '{$commentId}' AND comments.post_id = '{$_POST['postId']}'";
        $getNewCommentStatement = queryToDb($db, $getNewCommentQuery);
        $comment = $getNewCommentStatement->fetch(PDO::FETCH_ASSOC);
        $post['id'] = $_POST['postId'];
        include __DIR__.'/../../views/partials/comment.block.php';
        http_response_code(200);
    }
    if (isset($_POST['deleteComment'])) {
        deleteComment($db);
    }
    if (isset($_POST['saveEditComment'])) {
        // Check if comment has content
        if (empty($_POST['editComment'])) {
            http_response_code(406);
            echo "Comment can't be empty.";
            exit();
        }
        editComment($db);
    }
    if (isset($_POST['replySubmit'])) {
        // Check if comment has content
        if (empty($_POST['comment'])) {
            http_response_code(406);
            echo "Comment can't be empty.";
            exit();
        }
        $replyTo = $_POST['commentId'];
        saveNewComment($db, $replyTo);
        // return new reply to js response
        $commentId = $db->lastInsertId();
        $getReplyQuery = "SELECT comments.id, comments.user_id, comments.comment, comments.published, comments.reply_to,
		comments.edited,users.username FROM comments INNER JOIN users ON comments.user_id = users.id
		WHERE comments.id = '{$commentId}' AND comments.post_id = '{$_POST['postId']}'";
        $getReplyStatement = queryToDb($db, $getReplyQuery);
        $reply = $getReplyStatement->fetch(PDO::FETCH_ASSOC);

        include __DIR__.'/../../views/partials/reply.block.php';
        http_response_code(200);
    }
}
