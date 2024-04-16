<?php

class connection
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "tugasqw";
    private $connection;

    function __construct()
    {
        $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->db_name);
    }

    function connected()
    {
        return $this->connection;
    }
    function __destruct()
    {
        $this->connection->close();
    }
}

$db = new connection();
$connected = $db->connected();
