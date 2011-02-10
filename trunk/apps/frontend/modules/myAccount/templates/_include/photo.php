<div id="profilePicture" style="margin-left: 20px">
<?php
	$userSiteObj = UserSite::getCurrentUser();
	$userSiteId  = $userSiteObj->getId(true);
	$imagePath   = $userSiteObj->getImagePath();
	
//	echo image_tag($imagePath, array('align'=>'left'));
?>
<?php echo __('leftBar.hello') ?>, <b><?php echo MyTools::getAttribute('firstName'); ?></b>

<br/>
<br/>

</div>