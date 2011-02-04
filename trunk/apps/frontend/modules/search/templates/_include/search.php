<?php
	foreach($userSiteObjList as $userSiteObj):
	
		$emailAddress = $userSiteObj->getPeople()->getEmailAddress();
		$emailAddress = ereg_replace('@.*', '@...', $emailAddress);
?>
<tr>
    <td><?php echo $userSiteObj->getUserName() ?></td>
    <td><?php echo $emailAddress ?></td>
    <td><?php echo $userSiteObj->getCreatedAt('d/m/Y') ?></td>
</tr>
<?php
	endforeach;
  	
	if( count($userSiteObjList)==0 ):
?>
<tr>
	<td colspan="6">
		<?php echo __('search.noUserResult') ?><br/><br/>
		<b><?php echo link_to(__('ClickHere'), 'friendInvite/index') ?></b> <?php echo __('search.inviteSuggest') ?></td>
</tr>
<?php
	endif;
?>