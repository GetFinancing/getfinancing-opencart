<script type="text/javascript" src="https://cdn.getfinancing.com/libs/1.0/getfinancing.js">
</script>
<script type="text/javascript">


var onComplete = function() {
  window.location.href="<?php echo $redirector_success; ?>";
};

var onAbort = function() {
    window.location.href="<?php echo $redirector_failure; ?>";
};


 setTimeout(function(){
   document.getElementById("loadingGetFinancing").innerHTML="";
   new GetFinancing("<?php echo $action; ?>", onComplete, onAbort);
 },3000);


/*    $(function() {
         document.getElementById("loadingGetFinancing").innerHTML="";
         new GetFinancing("<?php echo $action; ?>", onComplete, onAbort);
       });
*/
</script>

<p id="loadingGetFinancing">Loading...</p>
