<?php
include 'auth.php';
$authObj = new auth();
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    $authObj->register($name, $pass, $pass2);
}
