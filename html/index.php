<?php

    /***********************************************************************
     * index.php
     *
     * Computer Science 50
     * Final Project
     *
     * Renders the home page.
     * hcs.harvard.edu/~cs50-mym/index.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 
    
    // retrieve the name of the user, along with a bunch of his information.
    $info = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $score = $info[0]["score"];
    
    // retrieve the information about the user's meds.
    $meds = query("SELECT * FROM meds WHERE id = ?", $_SESSION["id"]);
 
    // render portfolio (the home page form), passing in information about the user and his meds.
    render("portfolio.php", array("title" => "Portfolio", "score" => $score, "meds" => $meds));

?>
