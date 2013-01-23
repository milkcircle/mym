<div>
    <table class="table table-striped" align="center">
        <thead>
            <tr>
                <th>Medicine</th>
                <th>Dosage</th>
                <th>Frequency per day</th>
            </tr>
        </thead>
        <?php
        
            // print medicine information.
            foreach($rows as $row)
            {
                print("<tr>");
                print("<td>" . $row["name"] . "</td>");
                print("<td>" . $row["dosage"] . "</td>");
                print("<td>" . $row["freq"] . "</td>");
                print("</tr>");
            }
            
        ?>
    </table>
</div>

<div>
Don't need to take a medicine anymore? Delete it from your list!</br></br>
<form action="medlist.php" method="post">
    <fieldset>
        <div>
            <select name="med">
                <option value='null'></option>
                <?php
                    foreach($rows as $row)
                    {
                        $name = $row["name"];
                        echo "<option value='$name'>
                         $name</option>\n";
                    }
                ?>
            </select>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Delete</button>
        </div>
    </fieldset>
</form>
</div>

