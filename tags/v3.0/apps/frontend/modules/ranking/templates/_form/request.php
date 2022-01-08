<div class="tabbarIntro">
	Este ranking possui <?php echo $pendingRequests ?> nova<?php echo ($pendingRequests==1?'':'s') ?> solicitaç<?php echo ($pendingRequests==1?'ão':'ões') ?> de inscrição</div>

<div id="rankingSubscriptionRequestDiv">
	<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable">
		<tr class="header">
			<th width="40%">Nome</th>
			<th width="25%">E-mail</th>
			<th width="15%">Data pedido</th>
			<th colspan="2"></th>
		</tr>
		<?php
			$criteria = new Criteria();
			$criteria->add( RankingSubscriptionRequestPeer::REQUEST_STATUS, 'pending' );
			$rankingSubscriptionRequestObjList = $rankingObj->getRankingSubscriptionRequestList($criteria);
			foreach($rankingSubscriptionRequestObjList as $rankingSubscriptionRequestObj):
				
				$peopleObj  = $rankingSubscriptionRequestObj->getUserSiteRelatedByUserSiteId()->getPeople();
				$peopleId   = $peopleObj->getId();
				$userSiteId = $rankingSubscriptionRequestObj->getUserSiteId();
		?>
		<tr class="boxcontent" id="rankingPlayer<?php echo $userSiteId ?>Tr">
			<td><?php echo $peopleObj->getName() ?></td>
			<td><?php echo $peopleObj->getEmailAddress() ?></td>
			<td class="textC"><?php echo $rankingSubscriptionRequestObj->getCreatedAt('d/m/Y H:i') ?></td>
			<td class="textC" id="rankingSubscriptionRequestAgree-<?php echo $userSiteId ?>"><?php echo button_tag('subscriptionRequestAgree-'.$userSiteId, 'Aceitar', array('onclick'=>'toggleSubscriptionRequest('.$userSiteId.', "agree")', 'image'=>'ok.png', 'style'=>'top: 0px')) ?></td>
			<td class="textC" id="rankingSubscriptionRequestDecline-<?php echo $userSiteId ?>"><?php echo button_tag('subscriptionRequestDecline-'.$userSiteId, 'Recusar', array('onclick'=>'toggleSubscriptionRequest('.$userSiteId.', "decline")', 'image'=>'nok.png', 'style'=>'top: 0px')) ?></td>
		</tr>
		<?php
			endforeach;
			
			if( count($rankingSubscriptionRequestObjList)==0 ):
		?>
		<tr class="footer">
			<td colspan="5">Este ranking não possui pedidos de inscrição pendentes</td>
		</tr>
		<?php else: ?>
		<tr class="footer">
			<td colspan="5">Os jogadores não serão notificados caso o pedido seja recusado.</td>
		</tr>
		<?php endif; ?>
	</table>
</div>
