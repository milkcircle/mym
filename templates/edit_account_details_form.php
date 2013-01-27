<div>
    <form action="edit_account_details.php" method="post">
        <fieldset>
            <div class="control-group">
                <input autofocus name="full_name" placeholder= "<?= $full_name_placeholder ?>" type="text" id="full_name"/>
            </div>
            <div class="control-group">
                <input autofocus name="email" placeholder= "<?= $email_placeholder ?>" type="text" id="email"/>
            </div>
            <div class="control-group">
                <input autofocus name="phone_number" placeholder= "<?= $phone_placeholder; ?>" type="text" id="phone_number"/>
            </div>
            <div class="control-group">
                <button type="submit" class="btn">Update!</button>
            </div>
        </fieldset>
    </form>
    <br/>
    <a href="change_password.php"> Click Here to change your password</a>
</div>