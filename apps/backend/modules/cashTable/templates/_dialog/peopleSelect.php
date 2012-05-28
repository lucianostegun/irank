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
		        		<?php echo input_autocomplete_tag('peopleName', null, 'people/autoComplete?instanceName=players&suggestNew=1', 'doSelectCashTablePlayer', array('maxlength'=>200, 'id'=>'cashTablePeoplePeopleName')); ?>
		        		<h1 id="cashTablePeoplePeopleNameLabel"></h1>
		        		<div class="formNote error" id="cashTablePeopleFormErrorPeopleName"></div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow" id="cashTablePeopleBuyinDiv">
						<label>Buyin</label>
						<div class="formRight">
							<?php echo input_tag('buyin', 0, array('size'=>8, 'maxlength'=>8, 'class'=>'textR', 'style'=>'font-size: 16px; font-weight: bold', 'id'=>'cashTablePeopleBuyin')); ?>
							<div class="formNote error" id="cashTablePeopleFormErrorBuyin"></div>
						</div>
						<div class="clear"></div>
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