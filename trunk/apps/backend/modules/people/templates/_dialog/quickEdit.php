<?php
	sfContext::getInstance()->getResponse()->addJavascript('backend/peopleQuickEdit');
	sfContext::getInstance()->getResponse()->addStylesheet('backend/peopleQuickEdit');
?>

<?php

?>
<div class="uDialog">
    <div id="peopleQuickEditDialog" title="Edição rápida das informações do jogador">
		<?php
			echo form_remote_tag(array(
				'url'=>'people/saveQuick',
				'success'=>'handleSuccessPeopleQuickEdit(response)',
				'failure'=>'handleFailurePeopleQuickEdit(response.responseText)',
				'loading'=>'showIndicator()',
				),
				array('class'=>'form', 'id'=>'peopleQuickEditForm'));
			
			echo input_hidden_tag('peopleId', null, array('id'=>'peopleQuickEditPeopleId'));
		?>
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="width: 145px">
			<div id="peopleQuickEditPeoplePicture"></div>
			<div class="textL">
    			<?php echo link_to(image_tag('backend/icons/light/upload', array('class'=>'linkIcon')).'Carregar imagem', '#editPlayerInfo()') ?><br/>
    			<?php echo link_to(image_tag('backend/icons/light/create', array('class'=>'linkIcon')).'Editar informações', '#editPlayerInfo()') ?><br/>
			</div>        		
		</td>
		<td style="vertical-align: top">
			<div class="formRow">
				<label>Nome completo</label>
				<div class="formRight">
					<?php echo input_tag('peopleName', null, array('size'=>40, 'maxlength'=>100, 'id'=>'peopleQuickEditPeopleName')) ?>
					<div class="formNote error" id="peopleQuickEditFormErrorPeopleName"></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="formRow">
				<label>E-mail</label>
				<div class="formRight">
					<?php echo input_tag('emailAddress', null, array('size'=>25, 'id'=>'peopleQuickEditEmailAddress')) ?>
					<div class="formNote error" id="peopleQuickEditFormErrorEmailAddress"></div>
				</div>
				<div class="clear"></div>
			</div>
		
			<div class="formRow">
				<label>Telefone</label>
				<div class="formRight">
					<?php echo input_tag('phoneNumber', null, array('size'=>15, 'maxlength'=>14, 'class'=>'maskPhone', 'id'=>'peopleQuickEditPhoneNumber')) ?>
					<div class="formNote error" id="peopleQuickEditFormErrorPhoneNumber"></div>
					<div class="formNote">Formato: (00) 0000-0000</div>
				</div>
				<div class="clear"></div>
			</div>
		</td>
	</tr>
</table>
        <?php echo submit_image_tag('blank.gif', array('class'=>'invisible')); ?>
		</form>
    </div>
</div>