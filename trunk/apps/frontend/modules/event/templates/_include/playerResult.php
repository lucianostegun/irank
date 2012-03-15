<?php
	$isMyEvent     = $eventObj->isMyEvent();
  	$peopleIdMe    = MyTools::getAttribute('peopleId');
  	$peopleIdOwner = null;
  	
  	$rankingObj = $eventObj->getRanking();
  	
  	if( is_object($rankingObj) )
  		$peopleIdOwner = $rankingObj->getUserSite()->getPeopleId();
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable" style="width: 650px">
  <tr class="header">
    <th class="first"><?php echo __('Player') ?></th>
    <th class="noBorder">&nbsp;</th>
  </tr>
  <?php
  	$eventPlayerObjList = $eventObj->getPlayerList();
  	foreach($eventPlayerObjList as $eventPlayerObj):
  		
  		$peopleObj = $eventPlayerObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  ?>
  <tr title="<?php echo __('event.playersTab.togglePresence') ?>" onclick="togglePresenceResult(<?php echo $peopleId ?>)" onmouseover="this.addClassName('hover green')" onmouseout="this.removeClassName('hover green')">
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td align="center" class="icon">
    	<?php
    		$inviteStatus = $eventPlayerObj->getInviteStatus();
    		$icon = ($inviteStatus=='yes'?'ok':'nok');
    		$image = image_tag('icon/'.$icon, array('id'=>'presenceImage'.$peopleId));
    		
    		echo $image;
    	?>
    </td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="5"><?php echo __('event.playersTab.noGuests') ?></td>
  </tr>
  <?php endif; ?>
</table>