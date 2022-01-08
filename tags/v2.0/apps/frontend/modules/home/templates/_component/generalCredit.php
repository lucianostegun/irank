<?php
	$userSiteObj = UserSite::getCurrentUser();
	$quickResume = $userSiteObj->getOptionValue('quickResume');
	
	$resumeValue = People::getQuickResume($quickResume);
?>
<span class="generalCredit"><?php echo __('generalCredit.'.$quickResume) ?>:</span> <span class="<?php echo ($resumeValue<0?'negative':'positive') ?>Credit"><?php echo Util::formatFloat($resumeValue, true) ?></span>