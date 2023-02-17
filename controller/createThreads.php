<?php
include 'threads.php';
$threads = new threads();
if (isset($_POST['submit'])) {
    $headline = $_POST['headline'];
    $content = $_POST['content'];
    $author = $_SESSION['username'];
    $target_file = $_FILES["fileToUpload"]["name"];
    $threads->createThread($headline, $content, $author, $target_file);
    header("Location: ../views/home");
}
