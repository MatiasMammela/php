<?php
include 'threads.php';
$threads = new threads();
if (isset($_POST['submit'])) {
    $content = $_POST['content'];
    $author = $_SESSION['username'];
    $thread_id = $_POST['submit'];
    $target_file = $_FILES["fileToUpload"]["name"];
    $threads->createPost($thread_id, $content, $author, $target_file);
    header("Location: ../views/thread?id=$thread_id");
}
