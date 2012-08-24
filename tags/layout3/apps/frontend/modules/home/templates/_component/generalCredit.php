<?php
	$userSiteObj = UserSite::getCurrentUser();
	$quickResume = $userSiteObj->getOptionValue('quickResume');

	$resumeValue = People::getQuickResume($quickResume);
?>
<a href="<?php echo url_for('myAccount/bankroll#now') ?>">
	<div class="generalCredit">
		<span class="label">
			<?php echo __('generalCredit.'.$quickResume) ?>:
		</span>
		<span class="credit <?php echo ($resumeValue<0?'negative':'positive') ?>">
			<?php echo Util::formatFloat($resumeValue, true) ?>
		</span>
	</div>
</a>