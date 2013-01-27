<?php

    /***********************************************************************
     * login.php
     *
     * MYM
     *
     * Log in user.
     **********************************************************************/

    // configuration
    require("../includes/config.php"); 

    // if form was submitted

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // query database for user (USING USERNAME)
        $rows = query("SELECT * FROM user WHERE username = ?", $_POST["username"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["u_id"] = $row["u_id"];

                // take us to our account
                redirect("index.php");
            }

            // if password is incorrect
            else
            {
                apologize("Incorrect login information.");
            }
        }

        else
            apologize("Incorrect login information.");
    }

    else
    {
        // else render form
        render("frontpage_form.php", array("title" => "Log In / Register"));
    }

?>
