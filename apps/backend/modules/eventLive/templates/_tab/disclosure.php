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
			<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Enviar para os selecionados</span>', '#sendEmailToCheckedPeople()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
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
							<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
							<th>Status</th> 
							<th>Email</th> 
							<th>Data de envio</th> 
							<th>Data da leitura</th>
						</tr> 
					</thead> 
					<tbody id="emailPeopleListTbody"> 
						<?php
							$clubId = $sf_user->getAttribute('clubId');
							
							foreach(ClubPeer::getPlayerList($clubId, PeoplePeer::EMAIL_ADDRESS) as $peopleObj):
								
								$eventLivePlayerObj  = EventLivePlayerPeer::retrieveByPK( $eventLiveObj->getId(), $peopleObj->getId() );
								$emailLogObj         = $eventLivePlayerObj->getEmailLog();
								$checkPeopleDisabled = (is_object($emailLogObj)?($emailLogObj->getErrorMessage()?false:true):false);
								$emailLogObj         = is_object($emailLogObj)?$emailLogObj:new EmailLog();
						?>
						<tr class="gradeA" id="emailPeopleListRow-<?php echo $peopleObj->getId() ?>">
							<td><?php echo checkbox_tag('peopleId[]', $peopleObj->getId(), false, array('disabled'=>($checkPeopleDisabled?true:false))) ?></td> 
							<td id="emailPeopleListStatusTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo ($emailLogObj->getCreatedAt()?image_tag('backend/icons/notifications/'.($emailLogObj->getErrorMessage()?'exclamation':'success'), array('title'=>$emailLogObj->getErrorMessage())):'&nbsp;') ?></td> 
							<td><?php echo $peopleObj->getEmailAddress() ?></td> 
							<td id="emailPeopleListCreatedAtTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo $emailLogObj->getCreatedAt('d/m/Y H:i:s') ?></td> 
							<td align="center"><?php echo $emailLogObj->getReadAt('d/m/Y H:i:s') ?></td> 
						</tr> 
						<?php endforeach; ?>
					</tbody> 
				</table>
			</div>		
		</div>
				
	</div>