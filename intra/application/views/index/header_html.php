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
