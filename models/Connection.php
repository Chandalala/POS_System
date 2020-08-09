<?php

class Connection{

    private $dbHost="localhost:4406";
    private $dbUser="root";
    private $dbPassword="";
    private $dbName="salesPOS";
    private $conn;

    public function connect(){

        $data_source="mysql:host=".$this->dbHost.';dbname='.$this->dbName;
        $this->conn=new PDO($data_source, $this->dbUser,$this->dbPassword);

        $this->conn->exec('set names utf8');

        return $this->conn;

    }

}