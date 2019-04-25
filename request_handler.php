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
        $data = addslashes($_POST['data']);
        $args = explode("|", $data);

        if ($_POST['item'] === "point"){
            echo $db->addItem($args[0], $args[1]);

        } else if ($_POST['item'] === "list"){
            $db->deleteList($_POST['data']);
        }
    }

    if ($_POST['action'] === "edit"){
        $db = new DB();
        $data = addslashes($_POST['data']);
        $args = explode("|", $data);

        if ($_POST['item'] === "point"){
            echo $db->editItem($args[0], $args[1]);

        } else if ($_POST['item'] === "list"){
            $db->deleteList($_POST['data']);
        }
    }

    if ($_POST['action'] === "cross"){
        $db = new DB();
        $args = explode("|", $_POST["data"]);

        $args[1] = ($args[1] === "true") ? 0 : 1;

        $db->togglePointState($args[0], $args[1]);
    }
}

?>