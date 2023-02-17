<?php
//login.php
include 'auth.php';
$authObj = new auth();
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $authObj->login($name, $pass);
}
