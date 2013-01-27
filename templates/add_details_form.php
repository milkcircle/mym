<script>
    $(function() {
        $( "#datepicker" ).datepicker( {
            dateFormat: 'yy-mm-dd'
            }
        );
    });
</script>

<div>
    <form action="add_details.php" method="post">
        <fieldset>
            <div class="control-group">
                <p>Refill Date: <input type="text" id="datepicker" placeholder="<?= $refill?>"/></p>
            </div>
        </fieldset>
    </form>
</div>
