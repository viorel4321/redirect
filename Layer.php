
<?php
include 'Database.php';


class Layer extends Database
{
    public $sql = null;
    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->createUsersTable();
        $this->createLinkTable();
    }

    private function createUsersTable()
    {
        $this->sql = "create table if not exists users (id INT AUTO_INCREMENT PRIMARY KEY, login VARCHAR(255), password VARCHAR(255), grup INT, dateTime DATETIME );";
        $result = $this->connectDB()->query($this->sql);
        if ($result) {
             //echo "users table created";
        } else {
            echo "users table is not created";
        }

    }

    public function createLinkTable()
    {
        $this->sql = "create table if not exists link (id INT AUTO_INCREMENT PRIMARY KEY, link VARCHAR(255), sort_link VARCHAR(255), owner VARCHAR(255), transition INT, dateTime DATETIME );";
        $result = $this->connectDB()->query($this->sql);
        if ($result) {
             //echo " link table created";
        } else {
            echo " link table is not created";
        }
    }
}

$layer = new Layer();
?>