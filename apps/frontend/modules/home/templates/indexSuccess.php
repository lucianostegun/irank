<div id="homeTopContentDiv">
<?php
	$culture = MyTools::getCulture();
	
	if( MyTools::isAuthenticated() && MyTools::hasCredential('iRankSite') )
		include_partial('home/component/resume');
	else
		include_partial('home/component/welcome', (array('culture'=>$culture)));
?>
</div>