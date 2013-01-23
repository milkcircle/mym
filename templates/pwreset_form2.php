<script>
    $('#logintoggle').hide('slow');
    $('#regtoggle').hide('slow');
    $('#pwtoggle').hide('slow');
    $('#abouttoggle').hide();
    $('#pwtoggle2').show('slow');
</script>

<div id="pwtoggle2" style="display: block">
    <div>
        Return here once you have the code from the email we sent you.
    </div><br>
    <form action="pwreset2.php" method="post">
        <fieldset>
            <div class="control-group">
                <input autofocus name="code" placeholder="Code" type="password"/>
            </div>
            <div class="control-group">
                <input name="password" placeholder="New Password" type="password"/>
            </div>
            <div class="control-group">
                <input name="confirmation" placeholder="Repeat:" type="password"/>
            </div>
            <div class="control-group">
                <button type="submit" class="btn">Set Password</button>
            </div>
        </fieldset>
    </form>
</div>
