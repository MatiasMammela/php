<?php
session_start();
$_SESSION['username'] = "Anonymous";
header("Location: ../views/home.php");
