<?php
	if( is_object($criteria) ):
		
	$criteria->add( UserSitePeer::ACTIVE, true );	
	$criteria->add( UserSitePeer::ENABLED, true );	
	$criteria->add( UserSitePeer::VISIBLE, true );	
	$criteria->add( UserSitePeer::DELETED, false );	
	$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );	
	$userSiteObjList = UserSitePeer::doSelect($criteria);
  	
	foreach($userSiteObjList as $userSiteObj):
?>
<tr class="boxcontent">
    <td><?php echo $userSiteObj->getUserName() ?></td>
    <td><?php echo $userSiteObj->getPeople()->getEmailAddress() ?></td>
</tr>
<?php
	endforeach;
  	
	if( count($userSiteObjList)==0 ):
?>
<tr class="boxcontent">
	<td colspan="6">
		Ops! Não encontramos seu amigo pelo username/e-mail informados.<br/><br/>
		<b><?php echo link_to('Clique aqui', '#showInviteForm()') ?></b> para convidá-los ao <b>iRank</b></td>
</tr>
<?php
		endif;
	endif;
?>