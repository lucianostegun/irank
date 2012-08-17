	<div class="formRow">
		<label>Nome</label>
		<div class="formRight">
			<?php echo input_tag('firstName', $peopleObj->getFirstName(), array('size'=>30, 'maxlength'=>30, 'id'=>'peopleFirstName')) ?>
			<div class="formNote error" id="peopleFormErrorFirstName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Sobrenome</label>
		<div class="formRight">
			<?php echo input_tag('lastName', $peopleObj->getLastName(), array('size'=>30, 'maxlength'=>30, 'id'=>'peopleLastName')) ?>
			<div class="formNote error" id="peopleFormErrorLastName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Apelido</label>
		<div class="formRight">
			<?php echo input_tag('nickname', $peopleObj->getNickname(), array('size'=>20, 'maxlength'=>16, 'id'=>'peopleNickname')) ?>
			<div class="formNote error" id="peopleFormErrorNickname"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>E-mail</label>
		<div class="formRight">
			<?php echo input_tag('emailAddress', $peopleObj->getEmailAddress(), array('size'=>50, 'maxlength'=>100, 'id'=>'peopleEmailAddress')) ?>
			<div class="formNote error" id="peopleFormErrorEmailAddress"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Telefone</label>
		<div class="formRight">
			<?php echo input_tag('phoneNumber', $peopleObj->getPhoneNumber(), array('size'=>15, 'maxlength'=>14, 'class'=>'maskPhone', 'id'=>'peoplePhoneNumber')) ?>
			<div class="formNote error" id="peopleFormErrorPhoneNumber"></div>
			<div class="formNote">Formato: (00) 0000-0000</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tipo</label>
		<div class="formRight">
			<div class="text"><?php echo $peopleObj->getPeopleType()->getDescription() ?></div>
		</div>
		<div class="clear"></div>
	</div>
