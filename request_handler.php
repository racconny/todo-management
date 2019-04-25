<?php

require_once("db_wrapper.php");

if (isset($_POST['action'])){
    $result = array();
    
    if ($_POST['action'] === "delete"){
        $db = new DB();
        $args = json_decode($_POST['data']);

        if ($_POST['item'] === "point"){
            $db->deleteItem(intval(addslashes($args)));

        } else if ($_POST['item'] === "list"){
            $db->deleteList(intval(addslashes($args)));
        }
    }

    if ($_POST['action'] === "add"){
        $db = new DB();
        $args = json_decode($_POST['data']);

        if ($_POST['item'] === "point"){
            echo $db->addItem(addslashes($args[0]), addslashes($args[1]));

        } else if ($_POST['item'] === "list"){
            echo $db->addList(addslashes($args));
        }
    }

    if ($_POST['action'] === "edit"){
        $db = new DB();
        $args = json_decode($_POST['data']);

        if ($_POST['item'] === "point"){
            echo $db->editItem(addslashes($args[0]), addslashes($args[1]));

        } else if ($_POST['item'] === "list"){
            echo $db->editList(intval($args[0]), addslashes($args[1]));
        }
    }

    if ($_POST['action'] === "cross"){
        $db = new DB();
        $args = json_decode($_POST['data']);

        $args[1] = ($args[1]) ? 0 : 1;

        echo $args[1];

        $db->togglePointState(addslashes($args[0]), $args[1]);
    }
}

?>