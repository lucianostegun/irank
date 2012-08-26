<?php
	$messageList = array();
	
	if( $userSiteObj->getEventPersonalCount()==0 )
		$messageList = array('!'.__('eventPersonal.noEvents').' '.__('eventPersonal.newEventInvite', array('%clickHere%'=>link_to(__('ClickHere'), 'eventPersonal/new'))));
	
	include_partial('home/component/commonBar', array('pathList'=>array(__('eventPersonal.title')=>'eventPersonal/index'), 'messageList'=>$messageList));
?>
<div class="moduleIntro">
	Para manter seu bankroll atualizado, utilize nossa ferramenta de controle de bankroll<br/>
	cadastrando separadamente todos os eventos que participou durante o ano e controlando tudo o que gastou<br/>
	seus prêmios e mantendo um histórico completo de seu desempenho.
</div>
<?php
	echo form_tag('eventPersonal/search', array('id'=>'eventPersonalSearchForm', 'onsubmit'=>'doEventPersonalSearch(); return false'));
	echo input_hidden_tag('isIE', null);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first"><?php echo __('Event') ?></th>
		<th class="textC"><?php echo __('Date') ?></th>
		<th class="textL"><?php echo __('Place') ?></th>
		<th class="textC"><?php echo __('Players') ?></th>
		<th class="textC"><?php echo __('Position') ?></th>
		<th class="textR">B+R+A</th>
		<th class="textR"><?php echo __('Prize') ?></th>
	</tr>
	<tbody id="eventPersonalListContent">
	<?php
			include_partial('eventPersonal/include/search', array('criteria'=>$criteria));
	?>
	</tbody>
</table>
</form>