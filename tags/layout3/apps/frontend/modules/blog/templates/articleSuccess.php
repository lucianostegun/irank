<?php
	$blogCategory = $blogObj->getBlogCategory()->getDescription();
	include_partial('home/component/commonBar', array('pathList'=>array('Blog'=>'blog/index', $blogCategory=>'blog/index?category='.$blogCategory, $blogObj->getShortTitle()=>null)));
	
	sfContext::getInstance()->getResponse()->setTitle('iRank Blog :: '.$blogObj->getTitle());
?>
<div class="moduleIntro article">
	
	<h1><?php echo $blogCategory ?></h1>
	<h2><?php echo $blogObj->getTitle() ?></h2>
	<h3>Publicado por <b><?php echo $blogObj->getPeople()->getNickname() ?></b> em <b><?php echo $blogObj->getCreatedAt('d/m/Y H\hm') ?></b> nas categorias&nbsp;</h3>
	<h3 class="tags">
		<?php
			$tags = $blogObj->getTags();
			$tagList = explode(',', $tags);
			
			foreach($tagList as &$tag){
				
				$tag = trim($tag);
				$tag = link_to($tag, 'blog?tag='.$tag);
			}
			
			echo implode(', ', $tagList);
		?> 
	</h3>
	<div class="clear"></div>
		<!-- AddThis Button BEGIN -->
		<div style="float: left; margin-right: 5px"><iframe src="http://www.facebook.com/plugins/like.php?href=http://<?php echo $sf_request->getHost() ?>/blog/article/<?php echo $blogObj->getPermalink() ?>&amp;layout=button_count&amp;show_faces=true&amp;width=120&amp;height=25&amp;action=recommend&amp;font=arial&amp;colorscheme=light" id="fbLikeIframe" name="fbLikeIframe" allowtransparency="true" class="fbLikeContainer" style="border:none; overflow:hidden; width:120px; height:25px; display:inline;" frameborder="0" scrolling="no"></iframe></div>
		<div class="share addthis_default_style header">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
			<a class="addthis_button_tweet" style="position: relative; left: -10px"></a>
			<a class="addthis_counter addthis_pill_style" style="position: absolute; margin-left: 182px"></a>
		</div>
		<!-- AddThis Button END -->
	<br/>
	<br/>
	<br/>
	<?php
		$content  = $blogObj->getContent();
		$glossary = $blogObj->getGlossary();
		if( $glossary ){
			
			$glossaryList = explode(',', $glossary);
			foreach($glossaryList as $glossary)
				$content = preg_replace('/('.$glossary.')/i', '<a class="dictionary" title="Clique para saber a definição de &quot;\1&quot;">\1</a>', $content, 1);
		}
		
		$content = preg_replace('/<hr class="intro"\/?>/', '', $content);
		echo $content;
	?>
</div>
	<div class="mt50 ml30">
		<!-- AddThis Button BEGIN -->
		<div style="float: left; margin-right: 5px"><iframe src="http://www.facebook.com/plugins/like.php?href=http://<?php echo $sf_request->getHost() ?>/blog/article/<?php echo $blogObj->getPermalink() ?>&amp;layout=button_count&amp;show_faces=true&amp;width=120&amp;height=25&amp;action=recommend&amp;font=arial&amp;colorscheme=light" id="fbLikeIframe" name="fbLikeIframe" allowtransparency="true" class="fbLikeContainer" style="border:none; overflow:hidden; width:120px; height:25px; display:inline;" frameborder="0" scrolling="no"></iframe></div>
		<div class="share addthis_default_style bottom">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
			<a class="addthis_button_tweet" style="position: relative; left: -10px"></a>
			<a class="addthis_counter addthis_pill_style" style="position: absolute; margin-left: 182px"></a>
		</div>
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-501b327e1cbc0097"></script>
		<!-- AddThis Button END -->
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
<?php include_partial('blog/include/suggest', array('blogId'=>$blogObj->getId())); ?>