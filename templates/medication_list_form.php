Medication list

<table>
<?php

  // make a nice two-column row for each medication entry
  foreach($rows as $row)
  {
    echo "<tr>";
      echo "<td>";
        echo "<div><b>Name: </b>$row[\"proprietary_name\"] $row[\"proprietary_name_suffix\"]</div>";
        echo "<div><b>Details: </b>$row[\"details\"];
      echo "</td>";
  
      echo "<td>";
        echo 
    
    
      echo "</td>";
    echo "</tr>";
  }

?>
</table>
