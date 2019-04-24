<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=UTF-8>
    <meta name=viewport content=width=device-width, initial-scale=1.0>
    <link rel=stylesheet href=style.css>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script defer src=script.js></script>
    <title>To Do Management</title>
</head>
<body>
    <header>
        <span class="header-title">To Do Management</span>
    </header>

    <?php

    $id = $_GET['list_id'];
    $db = new DB();
    $stat = $db->getListStat($id);
    $name = $db->getListName($id);

    echo '<p class="current-list-title">
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

        $done_toggle = ($items[$i]['isDone'] === '0') ? "crossed-item" : "";

        echo '<div class="list-item">
            <div class="item-title '.$done_toggle.'">'.
                $items[$i]['title']
            .'</div>
            <button class="item-button" style="color: #40acff"><span class="fas fa-pen"></span></button>
            <button class="item-button" style="color: #ff9f9f"><span class="fas fa-trash"></span></button>
        </div>';

        }

        ?>

        <!-- <div class="list-item">
            <div class="item-title crossed-item">
                Something else what already done
            </div>
            <button class="item-button" style="color: #40acff"><span class="fas fa-pen"></span></button>
            <button class="item-button" style="color: #ff9f9f"><span class="fas fa-trash"></span></button>
        </div> -->
    </div>
</body>