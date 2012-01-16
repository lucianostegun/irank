<div id="topBar" id="topLeftBar">
	<?php
		if( $isAuthenticated )
			include_partial('home/component/generalCredit', array());
		else
			echo link_to(image_tag($culture.'/layout/signUp'), '/sign');
	?>
</div>