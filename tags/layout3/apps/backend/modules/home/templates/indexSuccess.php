<?php
	$clubId = $sf_user->getAttribute('clubId');
?>
    <div class="wrapper">
        <div class="pageTitle">
        	<h5>Administração iRank</h5>

        	<span>Seja bem-vindo ao centro de controle e gerenciamento de rankings, eventos e resultados do <b>iRank</b><br/>
        	Navegue pelo menu ao lado para acessar suas opções ou utilize as opções rápidas abaixo, que representam suas opções mais acessadas.</span>
    	</div>
        <div class="clear"></div>
    </div>
    <div class="line"></div>    
    <div class="wrapper">
    	<!-- Title area -->
    	<?php include_partial('home/club/resume', array('clubId'=>$clubId)) ?>
    	<?php include_partial('home/club/calendar', array('clubId'=>$clubId)) ?>
    	<div class="clear"></div>
	</div>