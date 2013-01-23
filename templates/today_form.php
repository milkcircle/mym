<div>

    You need to take:</br></br>
    
    <table class="table table-striped" align="center">
    <ul>
        <?php
        
            // iterate through meds table
            foreach($rows as $row)
            {
                $dosage = $row["dosage"];
                $name = $row["name"];
                $current = $row["current"];
                print("<tr><td>");
                print("<li>");
                
                // congratulate for taking meds
                if ($current == 0)
                {
                    print("<b><font color=\"green\">");
                    print("You finished taking $name for today!");
                    print("</font></b>");
                }
                
                // enter number of times remaining into table
                else
                {
                    print($dosage . " of " . $name . " " . $current . " more time(s) today.");
                }
                print("</li>");
                print("</td>");
                print("<td align=\"left\" id=\"buttons\">");
                print("<form action=\"today.php\" method=\"post\">");
                print("<fieldset><div class=\"control-group\">");
                
                // calculate and print the number of checkmark buttons
                $i = 0;
                while ($i < $current)
                {
                    print("<button name=\"minus\" type=\"submit\" class=\"btn\" value=\"$name\">");
                    print("&#x2713</button> ");
                    $i++;
                }
                print("</div></fieldset></form>");
                print("</td></tr>");
            }
        ?>
    </ul>
    </table>
</div>
