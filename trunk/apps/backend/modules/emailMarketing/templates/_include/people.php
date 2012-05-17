	    <div class="widget">
			<div class="title">
				<span class="titleIcon"><input type="checkbox" checked id="titleCheck" name="titleCheck" /></span>
				<h6>Lista de jogadores do clube</h6>
			</div>
			<table cellpadding="0" cellspacing="0" width="100%" class="display sTable withCheck" id="checkAll">
			    <thead>
					<tr>
						<th width="30"><?php echo image_tag('backend/icons/tableArrows') ?></th>
						<th width="25%">Jogador</th> 
						<th width="20%">Email</th> 
						<th width="15%">Cód. aleatório</th> 
						<th width="15%">Data de envio</th> 
						<th width="15%">Data da leitura</th>
						<th width="10%" colspan="2">Status</th> 
					</tr> 
				</thead> 
				<tbody id="emailPeopleListTbody"> 
					<?php
						$clubId = $sf_user->getAttribute('clubId');
						
						$isUserSite      = $sf_request->getParameter('isUserSite');
    					$isRankingPlayer = $sf_request->getParameter('isRankingPlayer');
    					$emailAddress    = $sf_request->getParameter('emailAddress');
    					$peopleName      = $sf_request->getParameter('peopleName');
						
						$criteria = new Criteria();
						
						// Pesquisa todos os usuários que possuam e-mail (apenas para começar a montar a query)
						$criteria->add( PeoplePeer::EMAIL_ADDRESS, null, Criteria::NOT_EQUAL );
						$criterion1 = $criteria->getNewCriterion( PeoplePeer::ID, null );

						// Aqui lista todas as pessoas dos tipos selecionados
						if( $isUserSite || $isRankingPlayer ){
							
							if( $isUserSite )
								$criterion1->addOr( $criteria->getNewCriterion( PeoplePeer::PEOPLE_TYPE_ID, VirtualTable::getIdByTagName('peopleType', 'userSite') ) );
							
							if( $isRankingPlayer )
								$criterion1->addOr( $criteria->getNewCriterion( PeoplePeer::PEOPLE_TYPE_ID, VirtualTable::getIdByTagName('peopleType', 'rankingPlayer') ) );
						}
						
						
						// Pesquisa todas as pessoas que tenham no nome parte de uma das string da lista
						if( $peopleName ){
							
							$peopleName     = str_replace(' ', '', $peopleName);
							$peopleNameList = explode(',', $peopleName);
							foreach($peopleNameList as $peopleName)
								$criterion1->addOr( $criteria->getNewCriterion( PeoplePeer::FULL_NAME, "%$peopleName%", Criteria::ILIKE ) );
						}
						
						// Pesquisa todas as pessoas que tenham no e-mail parte de uma das string da lista
						if( $emailAddress ){
							
							$emailAddress     = str_replace(' ', '', $emailAddress);
							$emailAddressList = explode(',', $emailAddress);
							foreach($emailAddressList as $emailAddress)
								$criterion1->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, "%$emailAddress%", Criteria::ILIKE ) );
						}
						
						// Aqui ignora todas as condições anteriores e também inclui na lista as pessoas para as quais já foram enviados e-mail 
						$criterion2 = $criteria->getNewCriterion( EmailMarketingPeoplePeer::PEOPLE_ID, null, Criteria::NOT_EQUAL );
						$criterion2->addAnd( $criteria->getNewCriterion( EmailMarketingPeoplePeer::EMAIL_MARKETING_ID, $emailMarketingId ) );
						
						$criterion1->addOr( $criterion2 );
						
						$criteria->add( $criterion1 );
						
						$criteria->addJoin( PeoplePeer::ID, EmailMarketingPeoplePeer::PEOPLE_ID, Criteria::LEFT_JOIN );
						$criteria->setDistinct( PeoplePeer::ID );



						
						$peopleObjList = People::getList($criteria);
						
						foreach($peopleObjList as $peopleObj):
							
							$peopleId = $peopleObj->getId();
							
							$emailMarketingPeopleObj = EmailMarketingPeoplePeer::retrieveByPK($emailMarketingId, $peopleId);
							$emailLogObj             = $emailMarketingPeopleObj->getEmailLog();
							$randomCode              = $emailMarketingPeopleObj->getRandomCode();
							$isNew                   = $emailLogObj->isNew();
							$errorMessage            = $emailLogObj->getErrorMessage();
							$checkPeopleDisabled     = ($errorMessage || $isNew?false:true);
							
							if( $randomCode ){
								
								echo input_hidden_tag('randomCode'.$peopleId, $randomCode, array());
								$randomCodeField = $randomCode;
							}else{
								
								$randomCodeField = input_tag('randomCode'.$peopleId, null, array('class'=>'randomCode'));
							}
							
							$isRead = $emailLogObj->isRead();
							$readAt = $emailLogObj->getReadAt('d/m/Y H:i');
					?>
					<tr class="gradeA" id="emailPeopleListRow-<?php echo $peopleId ?>">
						<td><?php echo checkbox_tag('peopleId', $peopleId, !$checkPeopleDisabled, array('disabled'=>$checkPeopleDisabled, 'class'=>($checkPeopleDisabled?'peopleId disabled':'peopleId'))) ?></td> 
						<td><?php echo $peopleObj->getName() ?></td>
						<td><?php echo $peopleObj->getEmailAddress() ?></td> 
						<td class="randomCodeTd textC" id="randomCodeTd-<?php echo $peopleId ?>"><?php echo $randomCodeField ?></td> 
						<td id="emailPeopleListCreatedAtTd-<?php echo $peopleId ?>" align="center"><?php echo $emailLogObj->getCreatedAt('d/m/Y H:i') ?></td> 
						<td align="center"><?php echo $readAt ?></td> 
						<td id="emailPeopleListStatusTd-<?php echo $peopleId ?>" align="center"><?php echo (!$isNew?image_tag('backend/icons/notifications/'.($errorMessage?'exclamation':'successGreen'), array('title'=>$errorMessage?$errorMessage:'Enviado com sucesso')):'&nbsp;') ?></td> 
						<td id="emailPeopleListReadTd-<?php echo $peopleId ?>"  align="center"><?php echo (!$isNew?image_tag('backend/icons/'.($isRead?'readMail':'unreadMail'), array('title'=>($isRead?'Leitura do e-mail confirmada em '.$readAt:'Sem confirmação de leitura'))):'') ?></td> 
					</tr> 
					<?php endforeach; ?>
				</tbody> 
			</table>
		</div>