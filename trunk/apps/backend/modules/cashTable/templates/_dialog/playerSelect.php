<div class="uDialog">
    <div id="playerSelectDialog" title="Inclusão de jogador">
        <p>Informe o nome ou e-mail do jogador que deseja incluir na posição <span id="cashTablePlayerSelectPosition"></span>.</p>
        
        <?php
			echo form_tag('', array('class'=>'form', 'onsubmit'=>'addPlayer(); return false', 'id'=>'cashTablePlayerSelectForm'));
			
			echo input_hidden_tag('cashTableId', $cashTableId, array('id'=>'cashTablePlayerSelectCashTableId'));
			echo input_hidden_tag('peopleId', null, array('id'=>'cashTablePlayerSelectPeopleId'));
			echo input_hidden_tag('tablePosition', null, array('id'=>'cashTablePlayerSelectTablePosition'));
		?>
        <table>
        	<tr>
        		<td style="width: 145px">
        			<div id="cashTablePeoplePicture"></div>
        			<div class="textL">
        			<?php echo link_to(image_tag('backend/icons/light/upload', array('class'=>'mt5 mr5')).'Carregar imagem', '#editPlayerInfo()') ?><br/>
        			<?php echo link_to(image_tag('backend/icons/light/create', array('class'=>'mt5 mr5')).'Editar informações', '#editPlayerInfo()') ?><br/>
        			</div>
        		</td>
        		<td style="width: 340px; vertical-align: top; text-align: center">
	        		<div class="formRow">
			        		<?php echo input_autocomplete_tag('pepleName', null, 'people/autoComplete?instanceName=players', 'doSelectCashTablePlayer', array('size'=>'100%', 'style'=>'font-size: 16px; font-weight: bold', 'maxlength'=>200, 'id'=>'cashTablePlayerSelectPeopleName')); ?>
			        		<div class="formNote error" id="cashTablePlayerSelectFormErrorPeopleName"></div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow">
						<label>Buyin</label>
						<div class="formRight">
							<?php echo input_tag('buyin', 0, array('size'=>8, 'maxlength'=>8, 'class'=>'textR', 'style'=>'font-size: 16px; font-weight: bold', 'id'=>'cashTablePlayerSelectBuyin')); ?>
							<div class="formNote error" id="cashTablePlayerSelectFormErrorBuyin"></div>
						</div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow">
						<label>E-mail</label>
						<div class="formRight"><label id="cashTablePlayerSelectEmailAddress"></label></div>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow">
						<label>Telefone</label>
						<div class="formRight"><label id="cashTablePlayerSelectPhoneNumber"></label></div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow">
						<label>Último jogo</label>
						<div class="formRight"><label id="cashTablePlayerSelectLastGame"></label></div>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow">
						<label>Restrição</label>
						<div class="formRight"><label id="cashTablePlayerSelectRestriction"></label></div>
						<div class="clear"></div>
	        		</div>
        		</td>
        	</tr>
        </table>
        <?php echo submit_image_tag('blank.gif', array('class'=>'invisible')); ?>
        </form>
    </div>
</div>