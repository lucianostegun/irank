<?php
	$messageList = array();
	
	if( $userSiteObj->getRankingCount()==0 )
		$messageList = array('!Você ainda não está participando de nenhum ranking. <b>'.link_to('Clique aqui', 'ranking/new', array('class'=>'red')).'</b> para criar e compartilhar seu primeiro ranking.');
	else
		$messageList = array();
	
	include_partial('home/component/commonBar', array('pathList'=>array(__('myAccount.title')=>'myAccount/index'), 'messageList'=>$messageList));
		
	echo form_remote_tag(array(
		'url'=>'myAccount/save',
		'success'=>'handleSuccessMyAccount(request.responseText)',
		'failure'=>'handleFailureMyAccount(request.responseText)',
		'encoding'=>'UTF8',
		), array( 'id'=>'myAccountForm' ));
		
	echo input_hidden_tag('password', $userSiteObj->getPassword(), array('id'=>'myAccountPassword'));
	echo input_hidden_tag('passwordConfirm', $userSiteObj->getPassword(), array('id'=>'myAccountPasswordConfirm'));
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
//	$dhtmlxTabBarObj->setSelectedTabBarId($selectedTab);
	$dhtmlxTabBarObj->addTab('main', __('tab.main'), 'myAccount/form/main', array('userSiteObj'=>$userSiteObj));
//	$dhtmlxTabBarObj->addTab('profile', 'Perfil', 'myAccount/form/profile', array('userSiteObj'=>$userSiteObj));
//	$dhtmlxTabBarObj->addTab('options', 'Opções', 'myAccount/form/options', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->addTab('email', 'Notificações', 'myAccount/form/email', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->addTab('schedule', 'Agenda', 'myAccount/form/schedule', array('userSiteObj'=>$userSiteObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
?>
	<div class="buttonTabBar" id="myAccountMainButtonBar">
		<?php echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitMyAccount()')); ?>
		<?php echo getFormLoading('myAccount') ?>
		<?php echo getFormStatus(null, false, __('myAccount.errorMessage'), __('myAccount.successMessage')); ?>
	</div>
</form>