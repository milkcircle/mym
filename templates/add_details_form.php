<script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
</script>

<div>
    <form action="add_details.php" method="post">
        <fieldset>
            <div class="control-group">
                <input autofocus type="text" class="datepicker" id="refill_date"/>
            </div>
        </fieldset>
    </form>
</div>
