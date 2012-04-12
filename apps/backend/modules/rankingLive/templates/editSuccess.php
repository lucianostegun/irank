<?php
	echo form_tag('', array('class'=>'form', 'id'=>'rankingLiveForm'));
//	echo form_remote_tag(array(
//		'url'=>'rankingLive/save',
//		'success'=>'handleSuccessRankingLive(request.responseText)',
//		'failure'=>'handleFailureRankingLive(request.responseText)',
//		'loading'=>'showIndicator("rankingLive")',
//		'encoding'=>'UTF8',
//	), array('id'=>'rankingLiveForm'));
//	
	$iRankAdmin  = $sf_user->hasCredential('iRankAdmin');
	$userAdminId = $sf_user->getAttribute('userAdminId');
	$clubId      = $sf_user->getAttribute('clubId');
	
	echo input_hidden_tag('rankingLiveId', $rankingLiveObj->getId());
	
	if( !$iRankAdmin && $clubId )
		echo input_hidden_tag('clubId', $clubId);
?>

    <!-- Fullscreen tabs -->
    <div class="widget">       
        <ul class="tabs">
            <li><a href="#tab1">Principal</a></li>
            <li><a href="#tab2">Etapas</a></li>
            <li><a href="#tab3">Classificação</a></li>
			<?php if( $iRankAdmin ): ?>
            <li><a href="#tab4">Clubes</a></li>
			<?php endif; ?>
        </ul>

        
        <div class="tab_container">
			<div class="tab_container">
				<div id="tab1" class="tab_content"><?php include_partial('rankingLive/tab/main', array('rankingLiveObj'=>$rankingLiveObj, 'iRankAdmin'=>$iRankAdmin, 'userAdminId'=>$userAdminId)) ?></div>
				<div id="tab2" class="tab_content"><?php include_partial('rankingLive/tab/event', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
				<?php if( $iRankAdmin ): ?>
				<div id="tab4" class="tab_content"><?php include_partial('rankingLive/tab/club', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
				<?php endif; ?>
			</div>
        </div>	
        <div class="clear"></div>		 
    </div>