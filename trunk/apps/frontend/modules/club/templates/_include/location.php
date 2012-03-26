<?php
	$linkMaps = $clubObj->getMapsLink();
	$linkMaps .= '&amp;output=embed';
?>
<div align="center">
<iframe width="770" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $linkMaps ?>"></iframe><br /><a href="<?php echo $linkMaps ?>" target="_blank"><br/>Visualizar mapa ampliado</a>
</div>