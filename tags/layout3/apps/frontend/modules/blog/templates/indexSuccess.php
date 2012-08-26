<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Blog'=>'blog/index')));
?>
<div class="moduleIntro article index">
<?php
	$tag      = $sf_request->getParameter('tag');
	$category = $sf_request->getParameter('category');
	
	$criteria = new Criteria();
	
	$criteria->addJoin( BlogPeer::BLOG_CATEGORY_ID, VirtualTablePeer::ID, Criteria::INNER_JOIN );
	
	$criteria->add( BlogPeer::IS_DRAFT, false );
	if( $tag )
		$criteria->add( BlogPeer::TAGS, "%$tag%", Criteria::ILIKE );

	if( $category )
		$criteria->add( VirtualTablePeer::DESCRIPTION, "%$category%", Criteria::ILIKE );
	
	$criteria->setLimit(10);
	$criteria->setOffset(0);
	$blogObjList = Blog::getList($criteria);
	
	if( empty($blogObjList) ):
		include_partial('blog/include/empty');
		include_partial('blog/include/suggest', array('blogId'=>null));
	else:	
		foreach($blogObjList as $blogObj):
?>	
	<h1><?php echo link_to($blogObj->getTitle(), 'blog/article?'.$blogObj->getPermalink().'=') ?></h1>
	<h2>
		<?php echo sprintf('Publicado em %s por <b>%s</b> - %s', $blogObj->getCreatedAt('d/m/Y H\hm'), $blogObj->getPeople()->getNickname(), $blogObj->getBlogCategory()->getDescription()) ?>
		<span>
		<?php
			$tags = $blogObj->getTags();
			$tagList = explode(',', $tags);
			
			foreach($tagList as &$tag){
				
				$tag = trim($tag);
				$tag = link_to($tag, 'blog?tag='.$tag);
			}
			
			echo implode(' ', $tagList);
		?>
		</span>
	</h2>
	<?php
		$content = $blogObj->getContent();
		preg_match('/(.*)<hr class="intro"\/?>/ims', $content, $matches);
		$content = $matches[1];
		$content = preg_replace('/<h1 class="imageFooter">.*<\/h1>/i', '', $content);
		$content = strip_tags($content, '<p><b><span><br><br/>');
		$content = trim($content);
		$content = preg_replace('/^<br\/?>/', '', $content);
		$content = str_replace('<p><br></p>', '', $content);
		$content = preg_replace('/<br\/?> *?\n?$/', '', $content);
		$content = trim($content);
		echo $content;
	?>
	<br/>
	<?php echo link_to('Ler o artigo completo', 'blog/article?'.$blogObj->getPermalink().'=') ?>
	<hr/>

<?php
		endforeach;
	endif;
?>
</div>
<div class="clear"></div>