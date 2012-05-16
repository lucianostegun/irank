	    <div class="widget">
			<div class="title">
				<span class="titleIcon"><input type="checkbox" checked id="titleCheck" name="titleCheck" /></span>
				<h6>Lista de jogadores do clube</h6>
			</div>                          
			<table cellpadding="0" cellspacing="0" width="100%" class="display sTable withCheck" id="checkAll">
			    <thead>
					<tr>
						<th width="30"><?php echo image_tag('backend/icons/tableArrows') ?></th>
						<th>Jogador</th> 
						<th width="20%">Email</th> 
						<th width="15%">Data de envio</th> 
						<th width="15%">Data da leitura</th>
						<th width="10%" colspan="2">Status</th> 
					</tr> 
				</thead> 
				<tbody id="emailPeopleListTbody"> 
					<?php
						$clubId = $sf_user->getAttribute('clubId');
						
						$criteria = new Criteria();
						$criteria->add( PeoplePeer::EMAIL_ADDRESS, null, Criteria::NOT_EQUAL );
						$criterion1 = $criteria->getNewCriterion( PeoplePeer::ID, null );

						if( $isUserSite || $isRankingPlayer ){
							
							if( $isUserSite )
								$criterion1->addOr( $criteria->getNewCriterion( PeoplePeer::PEOPLE_TYPE_ID, VirtualTable::getIdByTagName('peopleType', 'userSite') ) );
							
							if( $isRankingPlayer )
								$criterion1->addOr( $criteria->getNewCriterion( PeoplePeer::PEOPLE_TYPE_ID, VirtualTable::getIdByTagName('peopleType', 'rankingPlayer') ) );
						}
						
						$criterion2 = $criteria->getNewCriterion( EmailMarketingPeoplePeer::PEOPLE_ID, null, Criteria::NOT_EQUAL );
						$criterion2->addAnd( $criteria->getNewCriterion( EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $emailMarketingId ) );
						
						$criterion1->addOr( $criterion2 );
						
						$criteria->add( $criterion1 );
						
						$criteria->addJoin( PeoplePeer::ID, EmailMarketingPeoplePeer::PEOPLE_ID, Criteria::LEFT_JOIN );
						$criteria->setDistinct( PeoplePeer::ID );



						
						$peopleObjList = People::getList($criteria);
						
						foreach($peopleObjList as $peopleObj):
							
							$emailMarketingPeopleObj = EmailMarketingPeoplePeer::retrieveByPK($emailMarketingId, $peopleObj->getId());
							$emailLogObj             = $emailMarketingPeopleObj->getEmailLog();
							$isNew                   = $emailLogObj->isNew();
							$errorMessage            = $emailLogObj->getErrorMessage();
							$checkPeopleDisabled     = ($errorMessage || $isNew?false:true);
							
							$isRead = $emailLogObj->isRead();
							$readAt = $emailLogObj->getReadAt('d/m/Y H:i');
					?>
					<tr class="gradeA" id="emailPeopleListRow-<?php echo $peopleObj->getId() ?>">
						<td><?php echo checkbox_tag('peopleId', $peopleObj->getId(), !$checkPeopleDisabled, array('disabled'=>$checkPeopleDisabled, 'class'=>($checkPeopleDisabled?'peopleId disabled':'peopleId'))) ?></td> 
						<td><?php echo $peopleObj->getName() ?></td> 
						<td><?php echo $peopleObj->getEmailAddress() ?></td> 
						<td id="emailPeopleListCreatedAtTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo $emailLogObj->getCreatedAt('d/m/Y H:i') ?></td> 
						<td align="center"><?php echo $readAt ?></td> 
						<td id="emailPeopleListStatusTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo (!$isNew?image_tag('backend/icons/notifications/'.($errorMessage?'exclamation':'successGreen'), array('title'=>$errorMessage?$errorMessage:'Enviado com sucesso')):'&nbsp;') ?></td> 
						<td id="emailPeopleListReadTd-<?php echo $peopleObj->getId() ?>"  align="center"><?php echo (!$isNew?image_tag('backend/icons/'.($isRead?'readMail':'unreadMail'), array('title'=>($isRead?'Leitura do e-mail confirmada em '.$readAt:'Sem confirmação de leitura'))):'') ?></td> 
					</tr> 
					<?php endforeach; ?>
				</tbody> 
			</table>
		</div>