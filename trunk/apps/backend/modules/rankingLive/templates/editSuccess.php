<?php
	$userAdminId = $sf_user->getAttribute('userAdminId');
?>
<div class="wrapper">
	<!-- Fullscreen tabs -->
    <div class="widget">    
        <ul class="tabs">
            <li><a href="#tab1">Principal</a></li>
            <li><a href="#tab2">Padrão</a></li>
            <li><a href="#tab3">Etapas</a></li>
            <li><a href="#tab4">Classificação</a></li>
			<?php if( $iRankAdmin ): ?>
            <li><a href="#tab5">Clubes</a></li>
			<?php endif; ?>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#rankingLiveForm").submit()')); ?>
        </ul>
        <div class="tab_container">
		<?php
			echo form_remote_tag(array(
				'url'=>'rankingLive/save',
				'success'=>'handleSuccessRankingLive(response)',
				'failure'=>'handleFailureRankingLive(response.responseText)',
				'loading'=>'showIndicator()',
				),
				array('class'=>'form', 'id'=>'rankingLiveForm'));
//			echo form_tag('rankingLive/save', array('class'=>'form', 'id'=>'rankingLiveForm'));
		
			$iRankAdmin  = $sf_user->hasCredential('iRankAdmin');
			$userAdminId = $sf_user->getAttribute('userAdminId');
			$clubId      = $sf_user->getAttribute('clubId');
			
			echo input_hidden_tag('rankingLiveId', $rankingLiveObj->getId());
			
			if( !$iRankAdmin && $clubId )
				echo input_hidden_tag('clubId', $clubId);
		?>
			<div id="tab1" class="tab_content"><?php include_partial('rankingLive/tab/main', array('rankingLiveObj'=>$rankingLiveObj, 'iRankAdmin'=>$iRankAdmin, 'userAdminId'=>$userAdminId)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('rankingLive/tab/default', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
			<?php if( $iRankAdmin ): ?>
			<div id="tab5" class="tab_content"><?php include_partial('rankingLive/tab/club', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
			<?php endif; ?>
			<div id="tab3" class="tab_content"><?php include_partial('rankingLive/tab/event', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
		</form>
			<div id="tab4" class="tab_content"><?php include_partial('rankingLive/tab/classify', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
        </div>	
        <div class="clear"></div>		 
    </div>
</div>