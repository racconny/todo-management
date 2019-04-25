<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=UTF-8>
    <meta name=viewport content=width=device-width, initial-scale=1.0>
    <link rel=stylesheet href=style.css>
    <script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script defer src="script_todo.js"></script>
    <title>To Do Management</title>
</head>
<body>
    <header>
        <span class="header-title"><a href="index.php"><span class="fas fa-chevron-left" style="display: inline-block; margin-right: 10px; color: white;"></span></a>To Do Management</span>
    </header>

    <?php
    $id = $_GET['list_id'];
    $db = new DB();

    $stat = $db->getListStat($id);
    $name = $db->getListName($id);

    echo '<p id="title" data-id="'.$id.'"class="current-list-title">
        '.$name.'
    </p>
    <span class="list-stat">
        <span class="list-stat-done">'.$stat[0].'</span>
        of
        <span class="list-stat-all">'.$stat[1].'</span>
        done
    </span>';

    ?>

    <div class="new-item">
        <input type="text" class="new-item-title" placeholder="Add something new...">
        <button class="add-btn"> Add</button>
    </div>
    <div class="todos-container">

        <?php

        $items = $db->getItemsForList($id);

        for ($i = 0; $i < sizeof($items); $i++){

        $done_toggle = ($items[$i]['isDone'] === '1') ? "crossed-item" : "";

        echo '<div class="list-item">
            <div data-id="'.$items[$i]['id'].'" class="item-title '.$done_toggle.'">'.
                $items[$i]['title']
            .'</div>
            <button data-id="'.$items[$i]['id'].'" class="item-button edit-btn" style="color: #40acff"><span class="fas fa-pen"></span></button>
            <button data-id="'.$items[$i]['id'].'" class="item-button delete-btn" style="color: #ff9f9f"><span class="fas fa-trash"></span></button>
        </div>';

        }

        ?>
    </div>
</body>