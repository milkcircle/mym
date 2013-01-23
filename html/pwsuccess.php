<?php

    /***********************************************************************
     * pwsuccess.php
     *
     * Computer Science 50
     * Final Project
     *
     * Stupid little file that tells you you've successfully reset your 
     * password!
     * hcs.harvard.edu/~cs50-mym/pwsuccess.php
     **********************************************************************/
 
    // require functions
    require("../includes/functions.php"); 
    
    // render form
    render("pwsuccess_form.php", array("title" => "Success!"));
        
?>
