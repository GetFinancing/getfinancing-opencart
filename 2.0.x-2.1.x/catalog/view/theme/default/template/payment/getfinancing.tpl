<script type="text/javascript">


var onComplete = function() {
  window.location.href="<?php echo $redirector_success; ?>";
};

var onAbort = function() {
    window.location.href="<?php echo $redirector_failure; ?>";
};
new GetFinancing("<?php echo $action; ?>", onComplete, onAbort);
</script>
