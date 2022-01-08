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
		
	$criterion = $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, date('Y-m-d H:i:s'), Criteria::LESS_EQUAL );
	$criterion->addOr( $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, null ) );
	$criteria->add($criterion);

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
		<?php echo sprintf('Publicado em %s por <b>%s</b> - %s', $blogObj->getPublishDate('d/m/Y H\hm'), $blogObj->getPeople()->getNickname(), $blogObj->getBlogCategory()->getDescription()) ?>
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
		echo $blogObj->getResume();
	?>
	<br/>
	<?php echo link_to('Ler artigo completo', 'blog/article?'.$blogObj->getPermalink().'=') ?>
	<hr/>

<?php
		endforeach;
	endif;
?>
</div>
<div class="clear ml30 pt10" style="width: 728px">
	
	<script type="text/javascript"><!--
	google_ad_client = "ca-pub-0504466650636760";
	/* iRank Blog */
	google_ad_slot = "1066169165";
	google_ad_width = 728;
	google_ad_height = 90;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
</div>

<div class="clear"></div>
