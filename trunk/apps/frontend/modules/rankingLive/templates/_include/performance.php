<?php
	$peopleId        = $sf_user->getAttribute('peopleId');
	$isAuthenticated = UserSite::isAuthenticated();
	
	if( !$isAuthenticated ):
?>
	<div class="textC mt40">Para visualizar as estatísticas de seu desempenho no ranking é preciso estar logado.</div>
<?php elseif(!$rankingLiveObj->isPlayer($peopleId)): ?>
	<div class="textC mt40">Desculpe, você não participou de nenhuma etapa deste ranking.</div>
<?php else: ?>
	<div class="textC mt10"><?php echo image_tag(url_for($imageUrl=('rankingLive/chart?rankingLiveId='.$rankingLiveObj->getId(true))), array('noExtension'=>true)) ?>
	<?php echo link_to('Fazer o download do gráfico', $imageUrl) ?>
<?php endif; ?>