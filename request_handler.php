<?php

require_once("db_wrapper.php");

if (isset($_POST['action'])){
    $result = array();
    
    if ($_POST['action'] === "delete"){
        $db = new DB();

        if ($_POST['item'] === "point"){
            $db->deleteItem($_POST['data']);

        } else if ($_POST['item'] === "list"){
            $db->deleteList($_POST['data']);
        }
    }

    if ($_POST['action'] === "add"){
        $db = new DB();
        $args = explode("|", $_POST["data"]);

        if ($_POST['item'] === "point"){
            echo $db->addItem($args[0], $args[1]);

        } else if ($_POST['item'] === "list"){
            $db->deleteList($_POST['data']);
        }
    }
}

?>