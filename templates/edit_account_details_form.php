<h2>Account Details</h2>

<div>
    <form action="edit_account_details.php" method="post">
        <fieldset>
            <table class="table table-striped">
                <tr>
                    <td style="text-align:right; vertical-align: middle">
                        What's your name?
                    </td>
                    <td style="vertical-align: middle">
                        <input autofocus name="full_name" placeholder= "<?= $full_name_placeholder ?>" type="text" id="full_name"/>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right; vertical-align: middle">
                        What's your email?
                    </td>
                    <td valign="top">
                        <input name="email" placeholder= "<?= $email_placeholder ?>" type="text" id="email"/>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right; vertical-align: middle">
                        What's your phone number?
                    </td>
                    <td valign="top">
                        <input name="phone_number" placeholder= "<?= $phone_placeholder; ?>" type="text" id="phone_number"/>
                    </td>
                </tr>
            </table>

            <div class="control-group">
                <button type="submit" class="btn">Update!</button>
            </div>
        </fieldset>
    </form>
    <br/>
    <a href="change_password.php"> Click Here to change your password</a>
</div>