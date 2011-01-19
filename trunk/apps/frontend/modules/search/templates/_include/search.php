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
		Ops! Nenhum jogador foi encontrado pelo username/e-mail informado.<br/><br/>
		<b><?php echo link_to('Clique aqui', 'friendInvite/index') ?></b> para convidá-los ao <b>iRank</b></td>
</tr>
<?php
	endif;
?>