<?php

    /***********************************************************************
     * highscores.php
     *
     * Computer Science 50
     * Final Project
     *
     * Renders the high scores table.
     * hcs.harvard.edu/~cs50-mym/highscores.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
    
    // create an array of users, descending in score
    $rows = query("SELECT * FROM users ORDER BY score DESC");
    
    // render highscores_form.php
    render("highscores_form.php", array("title" => "High Scores", "rows" => $rows));

?>
