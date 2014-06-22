<!DOCTYPE html>
<html lang="en">
<head>
<title>WTF ?</title>

<link rel="icon" type="image/png" href="<?php echo base_url();?>asset/images/mafavicon.png" />

<!-- upload button -->
<script type="text/javascript">
function getfile(){
    document.getElementById('userfile').click();
}
</script>


<!-- install bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" type="text/css"  href='<?php echo base_url()."asset/css/bootstrap.min.css"?>'>

<!-- Optional theme -->
<link rel="stylesheet" type="text/css"  href='<?php echo base_url()."asset/css/bootstrap-theme.min.css"?>'>

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<!-- end install bootstrap -->


<!-- Install Multiselect -->
<!-- Include Twitter Bootstrap and jQuery: -->
<link rel="stylesheet" href='<?php echo base_url()."asset/css/bootstrap-2.3.2.min.css"?>' type="text/css"/>
<script type="text/javascript" src='<?php echo base_url()."asset/js/jquery.min.js"?>'></script>
<script type="text/javascript" src='<?php echo base_url()."asset/js/bootstrap-2.3.1.min.js"?>'></script>
<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src='<?php echo base_url()."asset/js/bootstrap-multiselect.js" ?>'></script>
<link rel="stylesheet" href='<?php echo base_url()."asset/css/bootstrap-multiselect.css" ?>' type="text/css"/>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.multiselect').multiselect({
				onChange: function(option, checked) {

				var selectedOptions = $('.multiselect option:selected');
				var url = window.location.href;
				res = url.split("/");
				size = res[9];

				if (selectedOptions.length >= size) {

				var nonSelectedOptions = $('.multiselect option').filter(function() {
				return !$(this).is(':selected');
				});

				var dropdown = $('.multiselect').siblings('.multiselect-container');
				nonSelectedOptions.each(function() {
				var input = $('input[value="' + $(this).val() + '"]');
				input.prop('disabled', true);
				input.parent('li').addClass('disabled');
				});
				}
				else {
				var dropdown = $('.multiselect').siblings('.multiselect-container');
				$('.multiselect option').each(function() {
				var input = $('input[value="' + $(this).val() + '"]');
				input.prop('disabled', false);
				input.parent('li').addClass('disabled');
				});
				}
				}
				});
				});
		</script>
<!-- End install multiselect -->

<script type="text/javascript">
$(document).ready(function(){
    $(".popover-examples a").popover({
        title : 'Change Password',
        html : true
    });
});
</script>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

</head>

<body>
