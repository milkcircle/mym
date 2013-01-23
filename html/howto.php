<?php

    /***********************************************************************
     * howto.php
     *
     * Computer Science 50
     * Final Project
     *
     * Simply renders a form detailing how to use the website.
     * hcs.harvard.edu/~cs50-mym/howto.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    // render form
    render("howto_form.php", array("title" => "Using This Site"));

?>
