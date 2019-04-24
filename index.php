<?php

require("db_wrapper.php");

if (isset($_GET)){
    if ($_GET['list_id'] && !empty($_GET['list_id'])){
        
        $db = new DB();
        $exist = $db->checkListExistance($_GET['list_id']);

        include("todo-page.php");
    } else {
        include("lists.php");
    }
}

?>