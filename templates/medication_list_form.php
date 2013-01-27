Medication list

<table>
<?php

  // make a nice two-column row for each medication entry
  foreach($rows as $row)
  {
    $proprietary_name = $row["proprietary_name"];
    $proprietary_name_suffix = $row["proprietary_name_suffix"];
    $details = $row["details"];
    $a_id = $row["a_id"];

    echo "<tr>";
    
      // print medication details
      echo "<td>";
        echo "<div><b>Name: </b>$proprietary_name $proprietary_name_suffix</div>";
        echo "<div><b>Details: </b>$details";
      echo "</td>";
  
      // print buttons for different actions
      echo "<td>";
        echo "<form action='medication_list.php' method='post'>";
          echo "<button name='submit' type='submit' class='btn' value='details-$a_id'>Edit Details</button>";
          echo " ";
          echo "<button name='submit' type='submit' class='btn' value='reminder-$a_id'>Reminders</button>";
          echo " ";
          echo "<button name='submit' type='submit' class='btn' value='delete-$a_id'>Delete</button>";
        echo "</form>";
      echo "</td>";
      
    echo "</tr>";
  }

?>
</table>
