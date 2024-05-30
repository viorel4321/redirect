<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';
include 'methods.php';
class Database
{

    public $connectMysqli = null;
    public $conect = null;

    function verifyConnectHost()
    {
        if ($this->connectMysqli == null) {

            $this->connectMysqli = new mysqli(HOST, USER, PASSWORD);
            if ($this->connectMysqli != null) {
                $createDataBaseIfNoExist = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
                $this->connectMysqli->query($createDataBaseIfNoExist);
                // echo "Success connected to host";
                return $this->connectMysqli;
            } else {
                echo "Can not connect to host";
                return;
            }
        }
    }


    function connectDB(){
        if($this->conect != null){
            return $this->conect;
        } else {
            if($this->verifyConnectHost() != null) {
                $this->conect = new mysqli(HOST, USER, PASSWORD, DB_NAME);
                // echo "<br> Connected to DataBase";
                return $this->conect;
            } else {
                echo "<br> Can not connect to DataBase";
                return;
            }
        }
    }

    


}




?>