<?php

    /***********************************************************************
     * autocomplete_meds.php
     *
     * MYM
     *
     * Queries the 'medication' table in the database to generate JSON
     * object, for autocomplete
     *
     **********************************************************************/

    // configuration
    require("../includes/config.php");

    if (isset($_POST))
    {
    	$matches = query("SELECT DISTINCT proprietary_name, proprietary_name_suffix FROM medication WHERE CONCAT(proprietary_name, ' ', proprietary_name_suffix) LIKE CONCAT(?, '%') AND 
    		(creator_id = ? OR creator_id = '0')", $_POST["name_startsWith"], $_SESSION["u_id"]);

    	echo json_encode($matches);
    }

?>