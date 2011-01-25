<div id="profilePicture">
<?php
	$userSiteObj = UserSite::getCurrentUser();
	$userSiteId  = $userSiteObj->getId(true);
	$imagePath   = $userSiteObj->getImagePath();
	
	echo image_tag($imagePath, array('align'=>'left'));
?>
<?php echo __('leftBar.hello') ?>, <b><?php echo MyTools::getAttribute('firstName'); ?></b>

<br/>
<br/>
	<div style="float: left; margin-top: -10px; margin-top: -25px !ie">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="85" height="22" id="uploadEventPhoto" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="false" />
			<param name="FlashVars" value="usid=<?php echo $userSiteId ?>" />
			<param name="movie" value="/uploads/eventPhoto.swf?usid=<?php echo $userSiteId ?>&time=<?php echo time() ?>" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#D9D8D9" />
			<embed src="/uploads/eventPhoto.swf?usid=<?php echo $userSiteId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#ffffff" width="85" height="22" name="uploadEventPhoto" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
		</object>
	</div>
</div>