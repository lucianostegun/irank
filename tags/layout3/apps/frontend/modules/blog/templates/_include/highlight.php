<div id="blogHighlight">
	<?php
		echo link_to(image_tag('home/blog'), 'blog/index');
		
		$blogObj = Blog::getLastArticle();
	?>
	<h1><?php echo link_to($blogObj->getTitle(), 'blog/article?'.$blogObj->getPermalink().'=') ?></h1>
	<h2><?php echo sprintf('Publicado em %s por <b>%s</b> - %s', $blogObj->getCreatedAt('d/m/Y H\hm'), $blogObj->getPeople()->getNickname(), $blogObj->getBlogCategory()->getDescription()) ?></h2>
	<div class="clear"></div>
	<div class="resume">
		<?php echo $blogObj->getResume() ?>
		<div class="textR"><?php echo link_to('Ler o artigo completo', 'blog/article?'.$blogObj->getPermalink().'=') ?></div>
	</div>
</div>
