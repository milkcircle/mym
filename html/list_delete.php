<?

    /***********************************************************************
     * list_delete.php
     *
     * Computer Science 50
     * Final Project
     *
     * Deletes a notification.
     * hcs.harvard.edu/~cs50-mym/list_delete.php
     **********************************************************************/
    
    // require config 
    require("../includes/config.php");

    // delete the notification given the notification identifier and the medicine and session id
    query("UPDATE reminders SET send = 0 WHERE id = ? AND med = ? AND counter = ?", $_SESSION["id"], $_SESSION["med"], $_SESSION["counter"]);
                
    // redirect to portfolio
    redirect("list.php");

?>
