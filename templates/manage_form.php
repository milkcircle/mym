<!-- the start of the table with information about stocks -->

<div>
    <table class="table" align="center">
        <thead>
            <tr>
                <th><b>Manage your account details here.</b></th>
            </tr>
        </thead>
        
        <tr>
            <td>Change your password:</td>
        </tr>
        
        <form action="manage.php" method="post">
            <fieldset>
                <tr>
                    <td>Current password:</td>
                    <td><input name="pass" placeholder="Password" type="text"/></td>
                </tr>
                
        
    </table>
</div>

<div>
    </br></br>
    <a href="logout.php">Log Out</a>
</div>

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
            <input name="freq" placeholder="0" type="text"/>            
        </div>
        
        <div class="control-group">
            <button type="submit" class="btn">Add</button>
        </div>
    </fieldset>
</form>
