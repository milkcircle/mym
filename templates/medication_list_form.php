Medication list

<table>
<?php

  // make a nice two-column row for each medication entry
  foreach($rows as $row)
  {
    echo "<tr>";
    
      // print medication details
      echo "<td>";
        echo "<div><b>Name: </b>$row[\"proprietary_name\"] $row[\"proprietary_name_suffix\"]</div>";
        echo "<div><b>Details: </b>$row[\"details\"]";
      echo "</td>";
  
      // print buttons for different actions
      echo "<td>";
        echo "<form action=\"medication_list.php\" method=\"post\">";
          echo "<button type=\"submit\" class=\"btn\" value=\"$row[\"a_id\"]\">Edit Details</button>";
          echo "";
        echo "</form>";
      echo "</td>";
    echo "</tr>";
  }

?>
</table>
