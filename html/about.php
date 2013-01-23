<?php

    /***********************************************************************
     * about.php
     *
     * Computer Science 50
     * Final Project
     *
     * Simply renders the About Us page.
     * hcs.harvard.edu/~cs50-mym/about.php
     **********************************************************************/
    
    // configuration
    require("../includes/config.php"); 
    
    // render form
    render("about_form.php", array("title" => "About"));
?>
