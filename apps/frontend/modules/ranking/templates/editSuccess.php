<?php
	$pageAction = ($rankingObj->isNew()?__('ranking.creating'):__('ranking.editing'));
	
	if( !$rankingObj->getEnabled() ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;
?>
<div class="commonBar"><span>Rankings/<?php echo $pageAction ?></span></div>
<?php
	
	echo form_remote_tag(array(
		'url'=>'ranking/save',
		'success'=>'handleSuccessRanking( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "rankingForm", "ranking", false, "ranking" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'rankingForm' ));
	
	$rankingId = $rankingObj->getId();
	$isNew     = $rankingObj->isNew();
	
	echo input_hidden_tag('rankingId', $rankingId);
	echo input_hidden_tag('scoreFormula', ($scoreFormula=$rankingObj->getScoreFormula()), array('id'=>'rankingScoreFormula'));
	echo input_hidden_tag('oldScoreSchema', $rankingObj->getScoreSchema(), array('id'=>'rankingOldScoreSchema'));
	echo input_hidden_tag('recalculateScore', null, array('id'=>'rankingRecalculateScore'));

	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Ranking', 'ranking/form/main', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('player', __('ranking.players'), 'ranking/form/player', array('rankingObj'=>$rankingObj, 'hidden'=>$isNew));
	$dhtmlxTabBarObj->addTab('event', __('ranking.events'), 'ranking/form/event', array('rankingObj'=>$rankingObj, 'hidden'=>$isNew));
	$dhtmlxTabBarObj->addTab('classify', __('ranking.classify'), 'ranking/form/classify', array('rankingObj'=>$rankingObj, 'hidden'=>$isNew));
	$dhtmlxTabBarObj->addTab('options', __('ranking.options'), 'ranking/form/options', array('rankingObj'=>$rankingObj, 'hidden'=>$isNew));
	$dhtmlxTabBarObj->addTab('import', __('ranking.import'), 'ranking/form/import', array('rankingObj'=>$rankingObj, 'hidden'=>true));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabRanking');
	$dhtmlxTabBarObj->build();
?>
	<div class="buttonTabBar" id="rankingMainButtonBar">
		<?php echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitRanking()')); ?>
		<?php echo getFormLoading('ranking') ?>
		<?php echo getFormStatus(); ?>
	</div>
	<div class="buttonTabBar" id="rankingPlayerButtonBar" style="display: none">
		<?php echo button_tag('addRankingPlayer', __('button.newPlayer'), array('onclick'=>'addRankingPlayer()')) ?>
		<?php echo getFormLoading('rankingPlayerList') ?>
	</div>
	<div class="buttonTabBar" id="rankingImportButtonBar" style="display: none">
		<?php echo button_tag('importRankingData', __('button.importData'), array('onclick'=>'doImportRankingData()')) ?>
		<?php echo getFormLoading('rankingImport') ?>
	</div>
</form>
<?php
	DhtmlxWindows::createWindow('rankingPlayerAdd', __('ranking.playerRegister'), 380, 125, 'ranking/dialog/playerAdd', array('rankingId'=>$rankingId));
	DhtmlxWindows::createWindow('rankingScoreFormula', __('ranking.scoreFormula'), 580, 280, 'ranking/dialog/scoreFormula', array('rankingId'=>$rankingId, 'scoreFormula'=>$scoreFormula));
?>