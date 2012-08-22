<div class="blog suggest">
<h3 class="header">Leia também...</h3>
<?php
	$criteria = new Criteria();
	
	$criteria->addJoin( BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID, Criteria::INNER_JOIN );
	
	$criteria->add( BlogPeer::ID, $blogId, Criteria::NOT_EQUAL );
	$criteria->add( BlogPeer::IS_DRAFT, false );
	
	$criteria->setLimit(7);
	$criteria->setOffset(0);
	$blogObjList = Blog::getList($criteria);
	
	foreach($blogObjList as $blogObj):
?>
	<h1><?php echo $blogObj->getCreatedAt('d/m/Y H\hm') ?></h1><h2><?php echo $blogObj->getTitle() ?></h2>
	<h3><?php echo $blogObj->getCaption() ?></h3>
	<div class="clear"></div>
<?php endforeach; ?>
</div>