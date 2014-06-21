<div class="container-fluid">
<div class="row">
<?php
if (isset($root))
{
	echo '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="position:relative;top:4em;">';
}
else if (isset($login))
	echo '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="position:relative;top:5em;">';
else
{
		echo '<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="position:relative;top:-4.8em;">';
}
?>
<div class="visible-xs" style="height:11em;"></div>
