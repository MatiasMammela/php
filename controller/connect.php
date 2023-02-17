<?php
session_start();
class connect
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "tietokanta";

    protected function conn()
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        return $conn;
    }
}
