<?php ?>

<script type="text/javascript" src="../wp-includes/js/jquery/jquery.js?ver=1.11.2"></script>

<a href="#" id="check">Check</a><br />
<a href="#" id="import">Import</a>
<div id="result"></div>

<script type="text/javascript">
	jQuery(document).ready(function(){
	});
	jQuery("#check").on("click", function(){
		var url = "check.php",
			result = jQuery("#result");
		result.empty();
		result.append("loading...");
		jQuery.get(url, function(data){
			result.empty();
			result.append(data);
		})
	});
	jQuery("#import").on("click", function(){
		var url = "import.php",
			result = jQuery("#result");
		result.empty();
		result.append("loading...");
		jQuery.get(url, function(data){
			result.empty();
			result.append(data);
		})
	});
</script>