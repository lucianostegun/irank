<?php
	$isMyEvent     = $eventObj->isMyEvent();
  	$peopleIdMe    = MyTools::getAttribute('peopleId');
  	$peopleIdOwner = null;
  	
  	$rankingObj = $eventObj->getRanking();
  	
  	if( is_object($rankingObj) )
  		$peopleIdOwner = $rankingObj->getUserSite()->getPeopleId();
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable">
  <tr class="header">
    <th class="first"><?php echo __('Player') ?></th>
    <th>E-mail</th>
    <th colspan="3">&nbsp;</th>
  </tr>
  <?php
  	$eventPlayerObjList = $eventObj->getPlayerList();
  	foreach($eventPlayerObjList as $eventPlayerObj):
  		
  		$peopleObj = $eventPlayerObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  ?>
  <tr>
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td align="center" class="icon">
    	<?php
    		$inviteStatus = $eventPlayerObj->getInviteStatus();
    		$icon = ($inviteStatus=='yes'?'ok':($inviteStatus=='no'?'nok':'help'));
    		$image = image_tag('icon/'.$icon, array('id'=>'presenceImage'.$peopleId));
    		
    		if( $isMyEvent )
    			echo link_to($image, '#togglePresence('.$peopleId.')', array('title'=>__('event.playersTab.togglePresence')));
    		else
    			echo $image;
    	?>
    </td>
    <?php if( $isMyEvent ): ?>
    <td align="center" class="icon">
    	<?php echo link_to(image_tag('icon/delete'), '#removePlayer('.$peopleId.')', array('title'=>__('event.playersTab.removePlayer'))); ?>
    </td>
    <td align="center" class="icon">
    	<?php
    		$allowEdit    = $eventPlayerObj->getAllowEdit();
    		$icon         = ($allowEdit?'unlock':'lock');
    		$shareMessage = ($allowEdit?__('Disable'):__('Enable'));
    		
    		if( $peopleId==$peopleIdMe || $peopleId==$peopleIdOwner )
				echo image_tag('icon/disabled/unlock', array('title'=>__('event.playersTab.unableToShare')));
			else
				echo link_to(image_tag('icon/'.$icon, array('title'=>__('event.playersTab.shareMessage', array('%shareMessage%'=>$shareMessage)), 'id'=>'eventShare'.$peopleId)), '#toggleEventShare('.$peopleId.')', array());
    	?>
    </td>
    <?php endif; ?>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="5"><?php echo __('event.playersTab.noGuests') ?></td>
  </tr>
  <?php else: ?>
  <tr>
    <td colspan="5" class="defaultForm footer">
		<div class="row">
			<div class="labelHalf"><?php echo __('event.playersTab.notify') ?></div>
			<div class="field"><?php echo select_tag('sendNotify', array('ask'=>__('Ask'), '1'=>__('Yes'), '0'=>__('No'))) ?></div>
		</div>
    </td>
  </tr>
  <?php endif; ?>
</table>