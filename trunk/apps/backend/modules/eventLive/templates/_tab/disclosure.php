	<div class="formRow">
		<div id="disclosureMenuShareDiv">
			<br/>
			<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Divulgar por Email</span>', '#showEventLiveEmailOptions()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
			<?php echo link_to(image_tag('backend/icons/light/facebook', array('class'=>'icon')).'<span>Divulgar no facebook</span>', '#eventLiveFacebookShare()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')) ?>
			<?php echo link_to(image_tag('backend/icons/light/twitter', array('class'=>'icon')).'<span>Divulgar no twitter</span>', 'http://twitter.com/home?status='.urlencode($eventLiveObj->getEventShortName().'. Em http://'.MyTools::getRequest()->getHost().'/index.php/eventLive/details/eventLiveId/'.$eventLiveObj->getId()), array('class'=>'button greenB', 'target'=>'_blank', 'style'=>'margin-left: 10px')) ?>
			<br/>
			<br/>
		</div>
		
		<div id="emailSenderOptionsDiv" style="display: none">
			
			<br/>
			<?php echo link_to(image_tag('backend/icons/light/arrowLeft', array('class'=>'icon')).'<span>Voltar</span>', '#hideEventLiveEmailOptions()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
			<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Enviar para os selecionados</span>', '#sendEmailToSelectedPlayers()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
			<br/><br/>
			
			<div id="emailSenderProgressBarDiv" style="display: none">
				<label><b>Enviando</b></label>
	            <div class="formRight">
	                <div id="progress"></div>
	            </div>
	            <br/>
	        </div>
	        
	        <div class="widget">
				<div class="title">
					<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
					<h6>Lista de email do clube</h6>
				</div>                          
				<table cellpadding="0" cellspacing="0" width="100%" class="display sTable withCheck" id="checkAll">
				    <thead>
						<tr>
							<th width="5%"><?php echo image_tag('backend/icons/tableArrows') ?></th>
							<th width="25%">Jogador</th> 
							<th width="20%">Email</th> 
							<th width="15%">Data de envio</th> 
							<th width="15%">Data da leitura</th>
							<th width="10%" colspan="2">Status</th> 
						</tr> 
					</thead> 
					<tbody id="emailPeopleListTbody"> 
						<?php
							$clubId = $sf_user->getAttribute('clubId');
							
							foreach(ClubPeer::getPlayerList($clubId, PeoplePeer::EMAIL_ADDRESS) as $peopleObj):
								
								$eventLivePlayerDisclosureObj = EventLivePlayerDisclosurePeer::retrieveByPK( $eventLiveObj->getId(), $peopleObj->getId() );
								$emailLogObj                  = $eventLivePlayerDisclosureObj->getEmailLog();
								$isNew                        = $emailLogObj->isNew();
								$errorMessage                 = $emailLogObj->getErrorMessage();
								$checkPeopleDisabled          = ($errorMessage || $isNew?false:true);
								
								$isRead = $emailLogObj->isRead();
								$readAt = $emailLogObj->getReadAt('d/m/Y H:i');
						?>
						<tr class="gradeA" id="emailPeopleListRow-<?php echo $peopleObj->getId() ?>">
							<td><?php echo checkbox_tag('peopleId[]', $peopleObj->getId(), !$checkPeopleDisabled, array('disabled'=>$checkPeopleDisabled, 'class'=>($checkPeopleDisabled?'disabled':''))) ?></td> 
							<td><?php echo $peopleObj->getName() ?></td> 
							<td><?php echo $peopleObj->getEmailAddress() ?></td> 
							<td id="emailPeopleListCreatedAtTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo $emailLogObj->getCreatedAt('d/m/Y H:i') ?></td> 
							<td align="center"><?php echo $readAt ?></td> 
							<td id="emailPeopleListStatusTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo ($emailLogObj->getCreatedAt()?image_tag('backend/icons/notifications/'.($errorMessage?'exclamation':'successGreen'), array('title'=>$errorMessage?$errorMessage:'Enviado com sucesso')):'&nbsp;') ?></td> 
							<td id="emailPeopleListReadTd-<?php echo $peopleObj->getId() ?>"  align="center"><?php echo (!$isNew?image_tag('backend/icons/'.($isRead?'readMail':'unreadMail'), array('title'=>($isRead?'Leitura do e-mail confirmada em '.$readAt:'Sem confirmação de leitura'))):'') ?></td> 
						</tr> 
						<?php endforeach; ?>
					</tbody> 
				</table>
			</div>		
		</div>
				
	</div>