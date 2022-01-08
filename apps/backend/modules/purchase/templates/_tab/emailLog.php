<div class="widget">
	<div class="title">
		<h6>Histórico de envio de e-mail</h6>
	</div>                          
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
	    <thead>
			<tr>
				<td widtd="15%">Data de envio</td> 
				<td widtd="20%">Email</td> 
				<td>Assunto</td> 
				<td widtd="10%" colspan="2">Status</td> 
				<td widtd="15%">Data da leitura</td>
			</tr> 
		</thead> 
		<tbody id="emailLogListTbody"> 
			<?php
				$purchaseStatusLogIdList = array();
				$resultSet = Util::executeQuery("SELECT id FROM purchase_status_log WHERE purchase_id = $purchaseId", null, 'log');
				while($resultSet->next())
					$purchaseStatusLogIdList[] = $resultSet->getInt(1);
				
				$criteria = new Criteria();
				$criterion = $criteria->getNewCriterion( EmailLogPeer::CLASS_NAME, 'PurchaseStatusLog' );
				$criterion->addAnd( $criteria->getNewCriterion( EmailLogPeer::OBJECT_ID, $purchaseStatusLogIdList, Criteria::IN ) );
				
				$criterion2 = $criteria->getNewCriterion( EmailLogPeer::CLASS_NAME, 'Purchase' );
				$criterion2->addAnd( $criteria->getNewCriterion( EmailLogPeer::OBJECT_ID, $purchaseId ) );
				
				$criterion->addOr( $criterion2 );
				$criteria->add( $criterion );
				
				foreach(EmailLog::getList($criteria) as $emailLogObj):
					
					$errorMessage = $emailLogObj->getErrorMessage();
					$isRead       = $emailLogObj->isRead();
					$readAt       = $emailLogObj->getReadAt('d/m/Y H:i');
			?>
			<tr class="gradeB clean">
				<td class="textC"><?php echo $emailLogObj->getCreatedAt('d/m/Y H:i') ?></td> 
				<td><?php echo $emailLogObj->getEmailAddress() ?></td> 
				<td><?php echo $emailLogObj->getEmailSubject() ?></td> 
				<td width="30" class="textC"><?php echo image_tag('backend/icons/notifications/'.($errorMessage?'exclamation':'successGreen'), array('title'=>$errorMessage?$errorMessage:'Enviado com sucesso')) ?></td> 
				<td width="30" class="textC"><?php echo image_tag('backend/icons/'.($isRead?'readMail':'unreadMail'), array('title'=>($isRead?'Leitura do e-mail confirmada em '.$readAt:'Sem confirmação de leitura'))) ?></td> 
				<td class="textC"><?php echo $readAt ?></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table>
</div>