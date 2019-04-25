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

    public function deleteItem($id){
        $id = intval($id);
        $sql = "DELETE FROM Item WHERE id = ".$id;

        $this->connection->query($sql);
    }

    public function deleteList($id){
        $id = intval($id);

        $sql1 = "DELETE FROM Item WHERE list_id = ".$id;
        $sql2 = "DELETE FROM List WHERE id = ".$id;

        $this->connection->query($sql1);
        $this->connection->query($sql2);
    }

    public function addItem($list_id, $title){
        
        $sql = "INSERT INTO Item (title, isDone, datetime, list_id) VALUES ('$title', 0, NOW(), $list_id)";
        $this->connection->query($sql) or die($this->connection->error);

        return $this->connection->insert_id;
    }

    public function editItem($item_id, $new_title){
        $sql = "UPDATE Item SET title  = '$new_title' WHERE id = $item_id";
        $this->connection->query($sql) or die($this->connection->error);

        return $this->connection->insert_id;
    }

    public function togglePointState($point_id, $state){
        //prevent refreshing time
        $sql = "SELECT * FROM Item WHERE id = $point_id LIMIT 1";
        $row = $this->connection->query($sql)->fetch_assoc();
        $datetime = $row[0]['datetime'];

        $sql = "UPDATE Item SET isDone = $state, datetime = datetime WHERE id = $point_id";
        $this->connection->query($sql);
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
        $sql = "SELECT * FROM Item WHERE list_id = ".$id." ORDER BY datetime DESC";

        $result = $this->connection->query($sql);
        
        $lists = array();

        while($row = $result->fetch_assoc()) {
            $lists[] = $row;
        }

        return $lists;
    }

    public function checkListExistance($id){
        $id = intval($id);
        $sql = "SELECT * FROM List WHERE id = ".$id;

        $result = $this->connection->query($sql)->fetch_assoc();
        return $result ? true : false;
    }

}

?>