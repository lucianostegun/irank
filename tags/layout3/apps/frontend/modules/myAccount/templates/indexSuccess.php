<?php
	$messageList = array();
	$rankings    = $userSiteObj->getRankingCount();
	
	if( $rankings==0 )
		$messageList['firstRanking'] = '!Você ainda não está participando de nenhum ranking. <b>'.link_to('Clique aqui', 'ranking/new', array('class'=>'red')).'</b> para criar e compartilhar seu primeiro torneio.';
	
	if( $userSiteObj->getStartBankroll()===null )
		$messageList['startBankroll'] = '!Você ainda não definiu seu bankroll inicial. Mantenha seu bankroll sempre atualizado.';
	
	include_partial('home/component/commonBar', array('pathList'=>array('Minha conta'=>'myAccount/index', 'Edição'=>null), 'messageList'=>$messageList));
		
	echo form_remote_tag(array(
		'url'=>'myAccount/save',
		'success'=>'handleSuccessMyAccount(request.responseText)',
		'failure'=>'handleFailureMyAccount(request.responseText)',
		'encoding'=>'UTF8',
		), array( 'id'=>'myAccountForm' ));
		
	echo input_hidden_tag('password', $userSiteObj->getPassword(), array('id'=>'myAccountPassword'));
	echo input_hidden_tag('passwordConfirm', $userSiteObj->getPassword(), array('id'=>'myAccountPasswordConfirm'));
	
	$selectedTab = $sf_request->getParameter('tab', 'main');
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
//	$dhtmlxTabBarObj->setSelectedTabBarId($selectedTab);
	$dhtmlxTabBarObj->addTab('main', __('tab.main'), 'myAccount/form/main', array('userSiteObj'=>$userSiteObj));
//	$dhtmlxTabBarObj->addTab('profile', 'Perfil', 'myAccount/form/profile', array('userSiteObj'=>$userSiteObj));
//	$dhtmlxTabBarObj->addTab('options', 'Opções', 'myAccount/form/options', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->addTab('email', 'Notificações', 'myAccount/form/email', array('userSiteObj'=>$userSiteObj, 'width'=>85));
	if( $userSiteObj->getBetaTester() )
		$dhtmlxTabBarObj->addTab('sms', '<span class="new" title="Novidade">SMS </span>', 'myAccount/form/sms', array('userSiteObj'=>$userSiteObj, 'width'=>58));
	$dhtmlxTabBarObj->addTab('schedule', 'Agenda', 'myAccount/form/schedule', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->setSelectedTabBarId($selectedTab);
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabMyAccount');
	$dhtmlxTabBarObj->build();
?>
	<div class="buttonTabBar" id="myAccountMainButtonBar">
		<?php
			echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitMyAccount()'));
			echo getFormLoading('myAccount');
			echo getFormStatus(null, false, __('myAccount.errorMessage'), __('myAccount.successMessage'));
		?>
	</div>
	<?php if( $rankings==0 ): ?>
	<div id="noRankingTutorial">
		<div style="position: absolute; top: 50px; left: 320px; z-index: 1"><?php echo image_tag('tutorial/arrowUp') ?></div>
		<div style="position: absolute; top: 100px; left: 380px; z-index: 1"><?php echo image_tag('tutorial/noRanking') ?></div>
	</div>
	<?php endif; ?>
</form>
