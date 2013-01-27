<?php

  /***********************************************************************
     * delete_med.php
     *
     * MYM
     *
     * "Deletes" a medication by hiding it...but we need it for the history
     * table.
     * 
     * 
     **********************************************************************/

    // configuration
    require("../includes/config.php");
    
    // delete medication
    $a_id = $_SESSION["a_id"];
    query("UPDATE user_medication SET b_hidden = 1 WHERE a_id = ?", $a_id);
    
    redirect("medication_list.php");
?>
