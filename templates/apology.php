<div id="apology">
<script>
    $('#logintoggle').hide('slow');
    $('#regtoggle').hide('slow');
    $('#pwtoggle').hide('slow');
    $('#abouttoggle').hide();
</script>

<p class="lead text-error">
    Sorry!
</p>
<p class="text-error">
    <?= htmlspecialchars($message) ?>
</p>

</div>

<!--<a href="javascript:history.go(-1);">Back</a>-->
