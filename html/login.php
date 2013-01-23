<?php

    /***********************************************************************
     * login.php
     *
     * Computer Science 50
     * Final Project
     *
     * Log in user.
     * hcs.harvard.edu/~cs50-mym/login.php
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // query database for user
        $rows = query("SELECT * FROM users WHERE email = ?", $_POST["email"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];

                // redirect to portfolio
                // redirect("index.php");
                echo "Valid login";
            }
        }

        // else apologize
        // apologize("Invalid username and/or password.");
        else
            echo "Invalid login";
    }
    else
    {
        // else render form
        render("login_form.php", array("title" => "Log In"));
    }

?>
