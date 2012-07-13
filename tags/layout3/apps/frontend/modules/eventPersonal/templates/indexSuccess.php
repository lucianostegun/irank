<?php
	$messageList = array();
	
	if( $userSiteObj->getEventPersonalCount()==0 )
		$messageList = array('!'.__('eventPersonal.noEvents').' '.__('eventPersonal.newEventInvite', array('%clickHere%'=>link_to(__('ClickHere'), 'eventPersonal/new'))));
	
	include_partial('home/component/commonBar', array('pathList'=>array(__('eventPersonal.title')=>'eventPersonal/index'), 'messageList'=>$messageList));
?>
<div class="moduleIntro">
	<?php echo __('eventPersonal.intro') ?>
</div>
<?php
	echo form_tag('eventPersonal/search', array('id'=>'eventPersonalSearchForm', 'onsubmit'=>'doEventPersonalSearch(); return false'));
	echo input_hidden_tag('isIE', null);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th colspan="2" class="first">Produto</th>
		<th>Quantidade</th>
		<th>Vl. unitário</th>
		<th>Vl. total</th>
	</tr>
	<?php
		$className = 'odd';
	?>
	<tbody id="eventPersonalListContent">
		<tr class="<?php echo $className ?>">
			<th><?php echo image_tag('temp/thumb/tshirt1') ?></th>
			<th>Camiseta: I'm bluffing / I'm All In</th>
			<th><?php echo input_tag('amount', 1, array('size'=>2)) ?></th>
			<th>R$ 39,90</th>
			<th>R$ 39,90</th>
		</tr>
	</tbody>
</table>
</form>