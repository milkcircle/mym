<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Mind Your Meds</title>
        <?php endif ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
        
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>

    </head>

    <body>

        <div class="container-fluid">

            <div id="middle">
            
            <!-- NAVBAR -->
                        
            <div>
                <div data-dropdown="dropdown" class="topbar" id="navbar">
                    <span class="alignleft"><b>MYM</b></span>
                    <span class="middle">
                        <ul class="nav nav-pills">
                            <li><a href="index.php">DASHBOARD</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#">MEDICINES &nbsp &#9660;</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="today.php">TODAY'S MEDS</a></li>
                                        <li><a href="medlist.php">MEDICINE LIST</a></li>
                                        <li><a href="add.php">ADD A MEDICINE</a></li>
                                    </ul>
                            <!--<li><a href="highscores.php">High Scores</a></li>-->
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#">MANAGE ACCOUNT &nbsp &#9660;</a>
                                 <ul class="dropdown-menu">
                                    <li><a href="list.php">NOTIFICATIONS</a></li>
                                    <li><a href="pwchange.php">CHANGE PASSWORD</a></li>
                                    <li><a href="emailchange.php">CHANGE EMAIL</a></li> 
                                    <li><a href="userchange.php">CHANGE USERNAME</a></li>
                                    <li><a href="phonechange.php">CHANGE/ADD PHONE</a></li>
                                </ul>
                            </li>
                            <li><a href="logout.php">LOG OUT</a></li>
                        </ul>   
                    <span class="alignright"><b><i>Score = 
                        <?php
                        
                            $score = query("SELECT score FROM users WHERE id = ?", $_SESSION["id"]);
                            
                            $score = $score[0]["score"];
                            
                            echo $score;
                            
                        ?>
                    </b></i></span> 
                </div>
            </div>​
