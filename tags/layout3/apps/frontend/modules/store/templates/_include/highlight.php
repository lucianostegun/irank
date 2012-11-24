<?php
	$highlights      = 5;
	$activeHighlight = rand(1,5);
?>
<div class="homeHighlight">
	<div class="content">
		<div class="contentItem <?php echo ($activeHighlight==1?'active':'') ?>" id="homeHighlight1" style="background: url('/images/store/product/highlight/irktsbl-005.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==2?'active':'') ?>" id="homeHighlight2" style="background: url('/images/store/product/highlight/irkbl-005-000-02.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==3?'active':'') ?>" id="homeHighlight3" style="background: url('/images/store/product/highlight/irkts-005-000-02.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==4?'active':'') ?>" id="homeHighlight4" style="background: url('/images/store/product/highlight/irkts-005-000-04.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==5?'active':'') ?>" id="homeHighlight5" style="background: url('/images/store/product/highlight/irkts-005-000-05.jpg') left center no-repeat"></div>
		
		<div class="descriptionArea"></div>
		<div class="descriptionText">
		 	<ul>
				<li id="contentItemText1" class="<?php echo ($activeHighlight==1?'active':'') ?>"><h1><?php echo link_to('Camiseta da sorte', '/store/details?IRKTS-005=') ?></h1><p>Edição especial por <b>tempo limitado</b>!<br/></p></li>
				<li id="contentItemText2" class="<?php echo ($activeHighlight==2?'active':'') ?>"><h1><?php echo link_to('Baby Look', '/store/details?IRKBL-005=') ?></h1><p>Disponível também em camisetas <b>Baby Look</b> femininas.</p></li>
				<li id="contentItemText3" class="<?php echo ($activeHighlight==3?'active':'') ?>"><h1><?php echo link_to('Feliz 2013', '/store/details?IRKTS-005=') ?></h1><p>Aproveite e adquire sua versão branca para começar 2013 com muita sorte!</p></li>
				<li id="contentItemText4" class="<?php echo ($activeHighlight==4?'active':'') ?>"><h1><?php echo link_to('Todos os tamanhos', '/store/details?IRKTS-005=') ?></h1><p>Disponíveis nso tamanhos P, M, G e GG.<br/><i>Tamanhos diferenciados sob consulta</i></p></li>
				<li id="contentItemText5" class="<?php echo ($activeHighlight==5?'active':'') ?>"><h1><?php echo link_to('Brilho', '/store/details?IRKTS-005=') ?></h1><p>Estampas metálicas discretas e modernas em peças 100% algodão.<br/>Conforto e confiança em qualquer ocasião.</p></li>
			</ul>
		</div>
		
		<ul class="selector">
			<?php for($highlight=1; $highlight <= $highlights; $highlight++): ?>
			<li id="contentItemSelector<?php echo $highlight ?>" onclick="changeContentItem(<?php echo $highlight ?>)" class="<?php echo ($highlight==$activeHighlight?'active':'') ?>"></li>
			<?php endfor; ?>
		</ul>
	</div>
	<div class="info">
		<h1>Oferta iRank Store</h1>
		<p>A camiseta <b>Lucky Tshirt</b> é uma edição especial e limitada que estará disponível apenas até o dia 15/12/2012.</p>
		<p>Ela foi criada especialmente para ser a sua camiseta da sorte em 2013 e a versão branca é ideal para passar o a virada de ano com os amigos.</p>
		<p>Produzida em 100% algodão e disponível também na cor preta, as estampas metálicas foscas te farão se sentir confortável e confiante em qualquer ocasião.</p>
		<div class="clear priceInfo">
			<label class="price">Valor unit.</label>
			<span class="price">R$ 34,90</span>
			<?php echo link_to(image_tag('store/buy'), '/store/details?IRKTS-005=') ?>
		</div>
	</div>
</div>

<script>
	setupHomeHighlight(5, <?php echo $activeHighlight ?>);
</script>