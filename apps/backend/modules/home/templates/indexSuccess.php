<?php
	$clubId     = $sf_user->getAttribute('clubId');
	$iRankAdmin = $sf_user->hasCredential('iRankAdmin');
?>
    <div class="wrapper">
        <div class="pageTitle">
        	<h5>Administração iRank</h5>

        	<span>Seja bem-vindo ao centro de controle e gerenciamento de rankings, eventos e resultados do <b>iRank</b><br/>
    	</div>
        <div class="clear"></div>
    </div>
    <div class="line"></div>    
    <div class="wrapper">
    	<!-- Title area -->
    	<?php
    		if( $iRankAdmin )
    			include_partial('home/store/resume');
    		
    		include_partial('home/club/resume', array('clubId'=>$clubId));
    		include_partial('home/club/calendar', array('clubId'=>$clubId));
    	?>
    	<div class="clear"></div>
	</div>