<?php
	$charLimit = 140;
	$defaultMessage = '';

	$charsLeft = $charLimit-strlen(String::removeAccents($defaultMessage));
	$clubId    = $sf_user->getAttribute('clubId');
?>
		<div id="smsSenderOptionsDiv" style="display: none" class="form">
			
			<div class="mt20 mb20">
			<?php echo link_to(image_tag('backend/icons/light/arrowLeft', array('class'=>'icon')).'<span>Voltar</span>', '#hideEventLiveSmsOptions()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
			<?php echo link_to(image_tag('backend/icons/light/bubbles', array('class'=>'icon')).'<span>Enviar para os selecionados</span>', '#sendSmsToSelectedPlayers()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
			</div>
			
			<?php
				echo form_tag('eventLive/index', array('id'=>'eventLiveDisclosureSmsForm'));
				echo input_hidden_tag('className', 'EventLive');
				echo input_hidden_tag('objectId', $eventLiveObj->getId());
			?>
			<div class="formRow">
				<label>Mensagem</label>
				<div class="formRight">
					<?php echo textarea_tag('textMessage', $defaultMessage, array('style'=>'width: 250px; height: 85px; resize: none', 'onkeyup'=>'updateSmsCharCount()', 'onblur'=>'updateSmsCharCount()', 'id'=>'eventLiveTextMessage')); ?>
					<div class="formNote error" id="eventLiveFormErrorTextMessage"></div>
					<div class="formNote"><span id="eventLiveSmsCharCount"><?php echo $charsLeft ?></span> <span id="eventLiveSmsCharCountLabel"><?php echo ($charsLeft==1?'caracter restante':'caracteres restantes') ?><span></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<label>Crédito para envio</label>
				<div class="formRight">
					<span id="smsCredit"><?php echo Sms::getCurrentCredit() ?></span> <span id="smsCreditMessages">mensagens</span>
				</div>
				<div class="clear"></div>
			</div>
			</form>
			
			<div id="smsSenderProgressBarDiv" style="display: none" class="mb20 mt20">
				<label><b>Enviando</b></label>
	            <div class="formRight">
	                <div id="progressBarSms"></div>
	            </div>
	            <br/>
	        </div>
	        
	        <div class="widget">
				<div class="title">
					<span class="titleIcon titleIcon2"><input type="checkbox" checked id="titleCheck" name="titleCheck" /></span>
					<h6>Lista de jogadores do clube</h6>
				</div>                          
				<table cellpadding="0" cellspacing="0" width="100%" class="display sTable withCheck" id="checkAll2">
				    <thead>
						<tr>
							<th width="30"><?php echo image_tag('backend/icons/tableArrows') ?></th>
							<th>Jogador</th> 
							<th width="20%">Telefone</th> 
							<th width="15%">Data de envio</th> 
							<th width="10%" colspan="2">Status</th> 
						</tr> 
					</thead> 
					<tbody id="smsPeopleListTbody"> 
						<?php
							$criteria = new Criteria();
							$criteria->add( PeoplePeer::PHONE_NUMBER, null, Criteria::NOT_EQUAL );
							foreach(Club::getPlayerList($clubId, $criteria) as $peopleObj):

								$eventLivePlayerDisclosureSmsObj = EventLivePlayerDisclosureSmsPeer::retrieveByPK( $eventLiveObj->getId(), $peopleObj->getId() );
								
								$emailLogObj                     = $eventLivePlayerDisclosureSmsObj->getSmsLog();
								$isNew                           = $emailLogObj->isNew();
								$errorMessage                    = $emailLogObj->getErrorMessage();
								$checkPeopleDisabled             = ($errorMessage || $isNew?false:true);							
						?>
						<tr class="gradeA" id="emailPeopleListRow-<?php echo $peopleObj->getId() ?>">
							<td><?php echo checkbox_tag('peopleId', $peopleObj->getId(), !$checkPeopleDisabled, array('disabled'=>$checkPeopleDisabled, 'class'=>($checkPeopleDisabled?'peopleId disabled':'peopleId'))) ?></td> 
							<td><?php echo $peopleObj->getName() ?></td> 
							<td><?php echo $peopleObj->getPhoneNumber() ?></td> 
							<td id="smsPeopleListCreatedAtTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo $emailLogObj->getCreatedAt('d/m/Y H:i') ?></td>
							<td id="smsPeopleListStatusTd-<?php echo $peopleObj->getId() ?>" align="center"><?php echo (!$isNew?image_tag('backend/icons/notifications/'.($errorMessage?'exclamation':'successGreen'), array('title'=>$errorMessage?$errorMessage:'Enviado com sucesso')):'&nbsp;') ?></td> 
						</tr> 
						<?php endforeach; ?>
					</tbody> 
				</table>
			</div>		
		</div>