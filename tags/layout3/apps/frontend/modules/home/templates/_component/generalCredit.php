<?php
	$userSiteObj = UserSite::getCurrentUser();
	$quickResume = $userSiteObj->getOptionValue('quickResume');

	$resumeValue = People::getQuickResume($quickResume);
	
	$bankrollTutorialHome = $userSiteObj->getBankrollTutorialHome();
	
	if( $bankrollTutorialHome <= 3 ){
		
		$bankrollTutorialHome++;
		$userSiteObj->setBankrollTutorialHome($bankrollTutorialHome);
		$userSiteObj->save();
	}
?>
<a href="<?php echo url_for('myAccount/bankroll#now') ?>">
	<div class="generalCredit">
		<span class="label">
			Bankroll:
		</span>
		<span class="credit <?php echo ($resumeValue<0?'negative':'positive') ?>">
			<?php echo Util::formatFloat($resumeValue, true) ?>
		</span>
	</div>
</a>

<?php if( $bankrollTutorialHome <= 3 ): ?>
<div id="bankrollTutorial" style="position: absolute">
	<div style="position: absolute; top: -87px; left: 170px; z-index: 1"><?php echo image_tag('tutorial/arrowLeftDown') ?></div>
	<div style="position: absolute; top: -95px; left: 275px; z-index: 1"><?php echo image_tag('tutorial/bankroll') ?></div>
</div>
<?php endif; ?>