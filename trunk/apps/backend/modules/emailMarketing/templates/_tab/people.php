<div class="form internalTable">
	
	<div class="mt20 mb20">
	<?php echo link_to(image_tag('backend/icons/light/arrowLeft', array('class'=>'icon')).'<span>Voltar</span>', '#hideEventLiveEmailOptions()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
	<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Enviar para os selecionados</span>', '#sendEmailToSelectedPlayers()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
	</div>
	
	<?php
		echo form_tag('emailMarketing/getPeopleList', array('id'=>'emailMarketingPeopleForm'));
		$isUserSite      = false;
		$isRankingPlayer = false;
	?>
	<br/>
	<h5>Filtros de pessoas</h5>
	<hr/>
	<div class="formRow">
		<label>Tipo de usuário</label>
		<div class="formRight">
			<?php echo checkbox_tag('isUserSite', true, false, array('id'=>'emailMarketingIsUserSite')) ?><label class="checkbox" for="emailMarketingIsUserSite">Usuários do site</label>
			<?php echo checkbox_tag('isRankingPlayer', true, false, array('id'=>'emailMarketingIsRankingPlayer')) ?><label class="checkbox" for="emailMarketingRankingPlayer">Jogadores não cadastrados</label>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<?php echo link_to(image_tag('backend/icons/light/refresh', array('class'=>'icon')).'<span>Pesquisar</span>', '#loadPeopleList()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')) ?>
	</div>
	
	<div id="emailSenderProgressBarDiv" style="display: none" class="mb20 mt20">
		<label><b>Enviando e-mail</b></label>
        <div class="formRight">
            <div id="progressBarEmail"></div>
        </div>
        <br/>
    </div>
    
    <div id="emailMarketingPeopleListDiv">
		<?php include_partial('emailMarketing/include/people', array('emailMarketingId'=>$emailMarketingId, 'isUserSite'=>$isUserSite, 'isRankingPlayer'=>$isRankingPlayer)) ?>
	</div>
	</form>		
</div>