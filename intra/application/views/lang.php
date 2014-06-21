<div id="langue" style='border:1px solid black;width:100px;margin-top:10px;padding:10px;'>
<p>Language:
<?php
 if ($langue != 'fr')
 		echo anchor(base_url().'framework/change_lang/fr', 'fran&ccedil;ais');
 if ($langue != 'eng')
 		echo anchor(base_url().'framework/change_lang/eng', 'english');
?></p>
</div>
