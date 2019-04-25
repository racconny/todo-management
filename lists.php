<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

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
    <script defer src="scriptt.js"></script>
    <title>To Do Management</title>
</head>
<body>
    <header>
        <span class="header-title">To Do Management</span>
    </header>
    <div class="lists-container">
        <a href="javascript:addList(1)">
        <div class="list-card" style="background-color: #8eceff">
                <span class="center-big-icon">    
                    <span class="fas fa-file-medical"></span>
                </span>
                <span class="add-new-sign">
                    <span>New list...</span>
                </span>
            </div>
        </a>

        <?php
        $db = new DB();
        $lists = $db->getAllLists();

        for ($i = 0; $i < sizeof($lists); $i++){
           $stat = $db->getListStat($lists[$i]['id']); 

            echo '<a href="index.php?list_id='.$lists[$i]['id'].'">
            <div class="list-card" data-id="123">
            <div class="list-title">'.$lists[$i]['name'].'</div>
                <div class="list-items-stat">
                    <span class="stat-done">'.$stat[0].'</span>
                    <span> of </span>
                    <span class="stat-all">'.$stat[1].'</span>
                    <span> done</span>
                </div>
                </a>
                <div class="bottom-panel">
                    <button class="inv-button delete-btn" style="color: #58aeff">
                        <span class="fas fa-trash"></span>
                    </button>
                    <button class="inv-button edit-btn">
                        <span class="fas fa-pen" style="color: #58aeff"></span>
                    </button>
                </div>
            </div>';

        }

        ?>
    </div>
</body>
</html>
