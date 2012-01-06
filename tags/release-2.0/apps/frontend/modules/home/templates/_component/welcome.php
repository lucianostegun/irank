<div class="commonBar"><span>Home</span></div>
<table width="100%" cellspacing="0" cellpadding="0" border="0" id="welcomeLogo">
	<tr>
		<td valign="top">
			<h1>Seja bem-vindo</h1>
			<p>O iRank é um site gratuito para criação e organização de rankings online para jogos de Poker.</p>
			<p>Aqui você poderá criar seus próprios rankings, definir as configurações de jogo e organizar os eventos, classificações e estatísticas dos torneios entre seus amigos.</p>
			<p>Se você ainda não é cadastrado, <?php echo link_to('clique aqui', 'sign') ?> e comece agora mesmo a controlar seus jogos!</p>
		</td>
		<td valign="top">
			<?php echo image_tag('frontend/layout/welcomeChips') ?>
		</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" style="padding-top: 7px; height: 150px">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="homeDistinct">
				<tr>
					<th valign="top"><?php echo image_tag('layout/feedNews.png', array('align'=>'left')) ?></th>
					<td colspan="6" class="newsList">
						<span><?php echo __('home.feedNews') ?></span>
						<?php
							foreach(News::getLastNews($limit=5) as $key=>$newsObj):
								$description = $newsObj->getDescription();
						?>
						<div class="news<?php echo ($key==$limit-1?' last':'') ?>">
							<?php
								if( $description )
									echo link_to(image_tag('icon/plus.gif', array('style'=>'absmiddle')), '#toggleNews('.$newsObj->getId().')');
							?>
							<span class="date"><?php echo $newsObj->getNewsDate('d/m/Y') ?></span> - <?php echo link_to($newsObj->getNewsTitle(), $newsObj->getInternalLink()) ?>
							<div class="description" id="newsDescription<?php echo $newsObj->getId() ?>"><?php echo $description ?></div>
						</div>
						<?php endforeach; ?>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top" rowspan="2" style="width: 300px; padding-top: 7px; background: #F5F5F5; border: none" align="center">
			<div class="distinct">
				<div class="image"><?php echo image_tag('layout/stats.png', array('align'=>'left')) ?></div>
				<div class="description">
					<span><?php echo __('home.statistics') ?></span><br/>
					<?php echo __('home.statistics.description') ?>
				</div>
			</div>
			<div class="distinct">
				<div class="image"><?php echo image_tag('layout/event.png', array('align'=>'left')) ?></div>
				<div class="description">
					<span><?php echo __('home.eventNotify') ?></span><br/>
					<?php echo __('home.eventNotify.description') ?>
				</div>
			</div>
			<div class="distinct">
				<div class="image"><?php echo image_tag('layout/photo.png', array('align'=>'left')) ?></div>
				<div class="description">
					<span><?php echo __('home.photoWall') ?></span><br/>
					<?php echo __('home.photoWall.description') ?>
				</div>
			</div>
			<div class="distinct">
				<div class="image"><?php echo image_tag('layout/rankingHistory.png', array('align'=>'left')) ?></div>
				<div class="description">
					<span><?php echo __('home.history') ?></span><br/>
					<?php echo __('home.history.description') ?>
				</div>
			</div>
			
			
			<table cellspacing="0" cellpadding="0" border="0" class="mobile">
				<tr>
					<th valign="top">
						<h1>iRank Mobile</h1>
						<?php echo __('home.mobile'); ?>
					</th>
					<td valign="top"><?php echo image_tag('iphone', array('align'=>'right', 'style'=>'margin-left: 10px')) ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top"><?php include_partial('home/include/photoWall'); ?></td>
	</tr>
</table>