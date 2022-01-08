<?php
	echo getPageHeader('Cadastro de ranking');
	if( !$rankingObj->getEnabled() ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;
	
	echo form_remote_tag(array(
		'url'=>'ranking/save',
		'success'=>'handleSuccessRanking( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "rankingForm", "ranking", false, "ranking" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'rankingForm' ));
	
	$rankingId = $rankingObj->getId();
	echo input_hidden_tag('rankingId', $rankingId);

	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Ranking', 'ranking/form/main', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('player', 'Membros', 'ranking/form/player', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('event', 'Eventos', 'ranking/form/event', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->addTab('classify', 'Classificação', 'ranking/form/classify', array('rankingObj'=>$rankingObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabRanking');
	$dhtmlxTabBarObj->build();
?>
	<div class="buttonBarForm" id="rankingMainButtonBar">
		<?php
			echo button_tag('mainSubmit', 'Salvar', array('onclick'=>'doSubmitRanking()'));
			echo button_tag('deleteRanking', 'Excluir ranking', array('onclick'=>'doDeleteRanking()', 'image'=>'../icon/delete', 'style'=>'float: right'));
		?>
		<?php echo getFormLoading('ranking') ?>
		<?php echo getFormStatus(); ?>
	</div>
	<div class="buttonBarForm" id="rankingPlayerButtonBar" style="display: none">
		<?php echo button_tag('addRankingPlayer', 'Novo membro', array('onclick'=>'addRankingPlayer()')) ?>
		<?php echo getFormLoading('rankingPlayerList') ?>
	</div>
</form>
<?php
	DhtmlxWindows::createWindow('rankingPlayerAdd', 'Cadastro de membros', 380, 125, 'ranking/dialog/playerAdd', array('rankingId'=>$rankingId));
?>