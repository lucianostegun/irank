<div class="uDialog">
    <div id="peopleSelectDialog" title="Inclusão de jogador">
        <p id="peopleSelectIntro"></p>
        
        <?php
			echo form_remote_tag(array(
				'url'=>'cashTable/savePlayer',
				'success'=>'handleSuccessCashTablePeople(response)',
				'failure'=>'handleFailureCashTablePeople(response.responseText)',
				'before'=>'if( !confirmCashout() ) return false',
				'loading'=>'showIndicator()',
				),
				array('class'=>'form', 'id'=>'cashTablePeopleForm'));
			
			echo input_hidden_tag('cashTableId', $cashTableId, array('id'=>'cashTablePeopleCashTableId'));
			echo input_hidden_tag('peopleId', null, array('id'=>'cashTablePeoplePeopleId'));
			echo input_hidden_tag('tablePosition', null, array('id'=>'cashTablePeopleTablePosition'));
			echo input_hidden_tag('saveAction', null, array('id'=>'cashTablePeopleSaveAction'));
		?>
        <table width="100%" cellspacing="0" cellpadding="0">
        	<tr>
        		<td style="width: 145px">
        			<div id="cashTablePeoplePicture"></div>
        			<div class="textL">
	        			<?php echo link_to(image_tag('backend/icons/light/upload', array('class'=>'mt5 mr5')).'Carregar imagem', '#editPlayerInfo()') ?><br/>
	        			<?php echo link_to(image_tag('backend/icons/light/create', array('class'=>'mt5 mr5')).'Editar informações', '#editPlayerInfo()') ?><br/>
        			</div>
        		</td>
        		<td style="vertical-align: top">
	        		<div class="formRow">
		        		<?php echo input_autocomplete_tag('peopleName', null, 'people/autoComplete?instanceName=players&suggestNew=1', 'doSelectCashTablePlayer', array('maxlength'=>200, 'id'=>'cashTablePeoplePeopleName')); ?>
		        		<h1 id="cashTablePeoplePeopleNameLabel"></h1>
		        		<div class="formNote error" id="cashTablePeopleFormErrorPeopleName"></div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow" id="cashTablePeopleBuyinDiv">
						<label>Buyin</label>
						<div class="formRight">
							<?php echo input_tag('buyin', 0, array('size'=>8, 'maxlength'=>8, 'class'=>'textR', 'style'=>'font-size: 16px; font-weight: bold', 'id'=>'cashTablePeopleBuyin')); ?>
							<div class="clear"></div>
							<div class="formNote error" id="cashTablePeopleFormErrorBuyin"></div>
						</div>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow" id="cashTablePeoplePayMethodIdDiv">
						<label>Forma pagto.</label>
						<div class="formRight">
							<?php echo select_tag('payMethodId', VirtualTable::getOptionsForSelect('payMethod', false, false, VirtualTablePeer::ID), array('onchange'=>'checkPayMethod(this.value)', 'id'=>'cashTablePeoplePayMethodId')); ?>
							<div class="clear"></div>
							<div class="formNote error" id="cashTablePeopleFormErrorPayMethodId"></div>
						</div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRowWrapper" id="cashTablePeopleCheckInfoDiv">
		        		<div class="formRow">
							<label>Número cheque</label>
							<div class="formRight">
								<?php echo input_tag('checkNumber', true, array('size'=>10, 'maxlength'=>10, 'style'=>'font-size: 16px; font-weight: bold', 'id'=>'cashTablePeopleCheckNumber')); ?>
								<div class="clear"></div>
								<div class="formNote error" id="cashTablePeopleFormErrorCheckNumber"></div>
							</div>
							<div class="clear"></div>
		        		</div>
		        		
		        		<div class="formRow">
							<label>Nome titular</label>
							<div class="formRight">
								<?php echo input_tag('checkNominal', true, array('maxlength'=>50, 'style'=>'width: 100%; font-size: 16px; font-weight: bold', 'id'=>'cashTablePeopleCheckNominal')); ?>
								<div class="clear"></div>
								<div class="formNote error" id="cashTablePeopleFormErrorCheckNominal"></div>
							</div>
							<div class="clear"></div>
		        		</div>
		        		
		        		<div class="formRow">
							<label>Banco</label>
							<div class="formRight">
								<?php echo input_tag('checkBank', true, array('maxlength'=>20, 'style'=>'width: 100%; font-size: 16px; font-weight: bold', 'id'=>'cashTablePeopleCheckBank')); ?>
								<div class="clear"></div>
								<div class="formNote error" id="cashTablePeopleFormErrorCheckBank"></div>
							</div>
							<div class="clear"></div>
		        		</div>

		        		<div class="formRow" id="cashTablePeopleCheckDateDiv">
							<label>Data</label>
							<div class="formRight">
								<?php echo input_tag('checkDate', null, array('size'=>10, 'maxlength'=>10, 'class'=>'maskDate datepickerClean', 'style'=>'font-size: 16px; font-weight: bold', 'id'=>'cashTablePeopleCheckDate')); ?>
								<div class="clear"></div>
								<div class="formNote error" id="cashTablePeopleFormErrorCheckDate"></div>
							</div>
							<div class="clear"></div>
		        		</div>
	        		</div>

	        		<div class="formRow" id="cashTablePeopleExtraOptionDiv">
						<?php echo link_to(image_tag('backend/icons/light/money2', array('class'=>'icon')).'<span>Recompra</span>', '#showPeopleRebuyOptions()', array('class'=>'button greenB', 'id'=>'cashTablePeopleSelectRebuyLink')) ?>
						<?php echo link_to(image_tag('backend/icons/light/maleContour', array('class'=>'icon')).'<span>Cash out</span>', '#showPeopleCashoutOptions()', array('class'=>'button redB')) ?>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow" id="cashTablePeopleBankrollDiv">
						<label>Bankroll atual</label>
						<div class="formRight">
							<label id="cashTablePeopleBankroll"></label>
						</div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow">
						<label>E-mail</label>
						<div class="formRight"><label id="cashTablePeopleEmailAddress"></label></div>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow">
						<label>Telefone</label>
						<div class="formRight"><label id="cashTablePeoplePhoneNumber"></label></div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow" id="cashTablePeopleLastGameDiv">
						<label>Último jogo</label>
						<div class="formRight"><label id="cashTablePeopleLastGame"></label></div>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow" id="cashTablePeopleRestrictionDiv">
						<label>Restrição</label>
						<div class="formRight"><label id="cashTablePeopleRestriction"></label></div>
						<div class="clear"></div>
	        		</div>
        		</td>
        	</tr>
        </table>
        <?php echo submit_image_tag('blank.gif', array('class'=>'invisible')); ?>
        </form>
    </div>
</div>