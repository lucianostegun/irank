<div id="profilePictureDiv" style="margin-left: 20px">
<?php
	$userSiteObj = UserSite::getCurrentUser();
	$userSiteId  = $userSiteObj->getId(true);
	$imagePath   = $userSiteObj->getImagePath(true, true);
	
	echo link_to(image_tag($imagePath.'?time='.time(), array('align'=>'left', 'id'=>'profilePicture')), 'myAccount/index');
?>
<?php echo __('leftBar.hello') ?>, <b><?php echo MyTools::getAttribute('firstName'); ?></b>

<br/>
<br/>

</div>