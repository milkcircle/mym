<form action="add.php" method="post">
    <fieldset>
    
        <div class="control-group">
            Please input your medicine name.</br></br>
            <input autofocus name="med" placeholder="Medicine Name" type="text"/>
        </div>
            
            Please input your medicine dosage.</br></br>
        <div class="control-group">
            <input name="dosage" placeholder="Dosage Information" type="text"/>
        </div>
        
            How many times per day will you be taking this medication?</br></br>
        <div class="control-group">
            <select name="freq">
                <option value="null"></option>
                <?php
                    $i = 1;
                    while ($i < 6)
                    {
                        echo "<option value='$i'>$i</option>";
                        $i++;
                    }
                ?>
            </select>
        </div>
        
            Would you like to set a reminder for this medicine?
        <div class="control-group">
            <input type="checkbox" name="reminder" value="yes"> &nbspSet Reminder</input>
        </div>
            
        <!--
            <input name="freq" placeholder="0" type="text"/>            
        </div>
        -->
        
        <div class="control-group">
            <button type="submit" class="btn">Add</button>
        </div>
    </fieldset>
</form>

