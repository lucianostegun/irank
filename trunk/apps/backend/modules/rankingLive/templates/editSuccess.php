    <!-- Fullscreen tabs -->
    <div class="widget">    
        <ul class="tabs">
            <li><a href="#tab1">Principal</a></li>
            <li><a href="#tab2">Etapas</a></li>
            <li><a href="#tab3">Classificação</a></li>
			<?php if( $iRankAdmin ): ?>
            <li><a href="#tab4">Clubes</a></li>
			<?php endif; ?>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#rankingLiveForm").submit()')); ?>
        </ul>
        <div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('rankingLive/tab/main', array('rankingLiveObj'=>$rankingLiveObj, 'iRankAdmin'=>$iRankAdmin, 'userAdminId'=>$userAdminId)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('rankingLive/tab/event', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
			<?php if( $iRankAdmin ): ?>
			<div id="tab4" class="tab_content"><?php include_partial('rankingLive/tab/club', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
			<?php endif; ?>
        </div>	
        <div class="clear"></div>		 
    </div>