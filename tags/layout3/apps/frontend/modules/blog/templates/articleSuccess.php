<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Artigos'=>'blog/index', $blogObj->getShortTitle()=>null)));
	
	sfContext::getInstance()->getResponse()->setTitle('iRank Blog :: '.$blogObj->getTitle());
?>
<div class="moduleIntro">
	
	<h1><?php echo $blogObj->getBlogCategory()->getDescription() ?></h1>
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
	<div class="share addthis_default_style">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet" style="position: relative; left: -10px"></a>
		<a class="addthis_counter addthis_pill_style" style="position: absolute; margin-left: 182px"></a>
	</div>
	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-501b327e1cbc0097"></script>
	<!-- AddThis Button END -->
	<br/>
	<br/>
	<br/>
	<?php
		$glossary     = $blogObj->getGlossary();
		$glossaryList = explode(',', $glossary);
		$content = $blogObj->getContent();
		foreach($glossaryList as $glossary)
			$content = preg_replace('/('.$glossary.')/i', '<a class="dictionary" title="Clique para saber a definição de &quot;\1&quot;">\1</a>', $content);
		
		echo $content;
	?>
</div>
<div class="clear"></div>