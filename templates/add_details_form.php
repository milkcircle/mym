<script>
    $(function() {
        $( "#datepicker" ).datepicker( {
            dateFormat: 'yy-mm-dd'
            defaultDate: '<?= $refill?>'
            }
        );
    });
</script>

<div>
    <form action="add_details.php" method="post">
        <fieldset>
            <div class="control-group">
                <p>Refill Date: <input type="text" id="datepicker" /></p>
            </div>
        </fieldset>
    </form>
</div>
