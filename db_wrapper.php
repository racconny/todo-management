<?php

class DB
{

    private $connection;

    public function __construct()
    {
        $servername = "localhost";
        $username = "admin";
        $password = "admin";
        $database = "todo_management";

        $this->connection = new mysqli($servername, $username, $password, $database);
        $this->connection->set_charset("utf8");
    }

    public function getAllLists(){
        $sql = "SELECT * FROM List";
        $result = $this->connection->query($sql);

        $lists = array();

        while($row = $result->fetch_assoc()) {
            $lists[] = $row;
        }

        return $lists;
    }

    public function getListName($id){
        $sql = "SELECT * FROM List WHERE id = ".$id;
        $result = $this->connection->query($sql)->fetch_assoc();

        return $result['name'];
    }

    public function getListStat($id){
        $id = intval($id);
        $sql1 = "SELECT COUNT(*) FROM Item WHERE isDone = 0 AND list_id = ".$id;
        $sql2 = "SELECT COUNT(*) FROM Item WHERE list_id = ".$id;

        $done = $this->connection->query($sql1)->fetch_array();
        $all = $this->connection->query($sql2)->fetch_array();

        return array($done["COUNT(*)"], $all["COUNT(*)"]);
    }

    public function getItemsForList($id){
        $id = intval($id);
        $sql = "SELECT * FROM Item WHERE list_id = ".$id." ORDER BY datetime";

        $result = $this->connection->query($sql);
        
        $lists = array();

        while($row = $result->fetch_assoc()) {
            $lists[] = $row;
        }

        return $lists;

    }

}

?>