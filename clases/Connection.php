<?php

class Connection()
{
    private  $host;
    private  $userName;
    private  $password;
    private  $db;
    private  $conn;
    private  $configFile = "conf.json";

    public function __construct()
    {
        $this->connectÇ();
    }

    public function __destruct()
    {
        if($this->conn){
            $this->conn = null;
        }
    }

    public function connect()
    {
        if (!file_exists($this->configFile)) {
            die("unable to open file!");
        }
        $configData = file_get_contents($this->configFile);
        $config = json_decode($configData, true);

        $this->host = $config['host'];
        $this->userName = $config['userName'];
        $this->password = $config['password'];
        $this->password = $config['db'];
        $this->passw

    }

}


?>