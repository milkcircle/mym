<form action="phonechange.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="password" placeholder="Password" type="password"/>
        </div>
        <div class="control-group">
            <input type="radio" name="add_remove" value="add" checked> Add
        </div>     
        <div class="control-group">
            <input name="new" placeholder="New 10 digit number:" type="text"/>
        </div>
        <div class="control-group">
            <input name="confirmation" placeholder="Repeat:" type="text"/><br>
            <table align="center"><tr><td align="left">
            <input type="radio" name="carrier" value="Verizon"> Verizon<br>
            </td></tr><tr><td align="left">
            <input type="radio" name="carrier" value="ATT"> AT&T<br>
            </td></tr><tr><td align="left">
            <input type="radio" name="carrier" value="T-Mobile"> T-Mobile<br>
            </td></tr>
            </table>
        </div>           
        <div>
            <input type="radio" name="add_remove" value="remove"> Or Remove
        </div>
        <div class="control-group">
            <br><button type="submit" class="btn">Submit</button>
        </div>
    </fieldset>
</form>
