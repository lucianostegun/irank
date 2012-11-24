<div class="clear"></div>
<div id="blogHighlight">
	<?php
		echo link_to(image_tag('home/blog'), 'blog/index');
		
		$blogObj = Blog::getLastArticle();
	?>
	<h1><?php echo link_to('<span>iRank Blog</span> :: '.$blogObj->getTitle(), 'blog/article?'.$blogObj->getPermalink().'=') ?></h1>
	<h2><?php echo sprintf('Publicado em %s por <b>%s</b> - %s', $blogObj->getPublishDate('d/m/Y H\hm'), $blogObj->getPeople()->getNickname(), $blogObj->getBlogCategory()->getDescription()) ?></h2>
	<div class="clear"></div>
	<div class="resume">
		<?php echo $blogObj->getResume() ?>
		<div class="textR"><?php echo link_to('Ler artigo completo', 'blog/article?'.$blogObj->getPermalink().'=') ?></div>
	</div>
<hr/>
</div>
<div class="blog suggest">
<?php
	$criteria = new Criteria();
	
	$criteria->addJoin( BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID, Criteria::INNER_JOIN );
	
	$criteria->add( BlogPeer::ID, $blogObj->getId(), Criteria::NOT_EQUAL );
	$criteria->add( BlogPeer::IS_DRAFT, false );
	
	$criterion = $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, date('Y-m-d'), Criteria::LESS_EQUAL );
	$criterion->addOr( $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, null ) );
	$criteria->add($criterion);
	
	$criteria->setLimit(5);
	$criteria->setOffset(0);
	$blogObjList = Blog::getList($criteria);
	
	foreach($blogObjList as $blogObj):
?>
	<a href="<?php echo url_for('blog/article?'.$blogObj->getPermalink().'=') ?>">
	<h1>[<?php echo $blogObj->getPublishDate('d/m/Y H\hm') ?>]</h1><h2><?php echo $blogObj->getTitle() ?></h2>
	<div class="clear"></div>
	</a>
	<div class="mb5"></div>
<?php endforeach; ?>
</div>