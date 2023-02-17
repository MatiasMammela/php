<?php
require 'connect.php';
class auth extends connect
{


    public function register($name, $pass, $pass2)
    {
        if ($pass != $pass2) {
            setcookie("msg", "Passwords do not match", time() + (86400 * 30), "/");
            return header("Location: ../views/index.php");
        }
        try {
            $GetUsers = "SELECT * FROM users WHERE name = '$name'";
            $result = $this->conn()->query($GetUsers);
            if (mysqli_num_rows($result) == 1) { //checking if username already exists
                setcookie("msg", "Username already exists", time() + (86400 * 30), "/");
                header("Location: ../views/index.php");
            } else {
                $sql = "INSERT INTO users (name,pass) VALUES ('$name','$pass')"; //inserting data into database
                $this->conn()->query($sql);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        header("Location: ../views/index");
    }

    public function login($name, $pass)
    {
        $msg = urlencode("Some error occured");
        try {
            $sql = "SELECT * FROM users WHERE name = '$name' AND pass = '$pass'";
            $result = $this->conn()->query($sql);
            if (mysqli_num_rows($result) == 1) {
                $msg = urlencode("Login Success");
                $_SESSION['username'] = $name;
                return header("Location: ../views/home");
            } else {
                $msg = urlencode("Invalid username or password");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        header("Location: ../views/index.php");
        setcookie("msg", $msg, time() + (86400 * 30), "/");
    }
}
