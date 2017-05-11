<?php

// conncetion to database
$connectionString = 'mysql:host=localhost;port=8889;dbname=linkify;charset=utf8';
$user = 'admin';
$password = 'secret';
try {
    $db = new PDO($connectionString, $user, $password);
} catch (PDOException $connectionException) {
    echo 'Connection failed: ', $connectionException->getMessage();
}
// insert data
function prepareAndExecute($db, $query, $arguments)
{
    try {
        $insertStatement = $db->prepare($query);

        return $insertStatement->execute($arguments);
    } catch (PDOException $exception) {
        var_dump($exeption->getMessage());
        die();
    }
}
// get data
function queryToDb($db, $query)
{
    try {
        return $queryStatement = $db->query($query);
    } catch (PDOException $exception) {
        var_dump($exeption->getMessage());
        die();
    }
}
