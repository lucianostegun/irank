<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Blog</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th>Artigo</th> 
					<th width="100">Categoria</th> 
					<th width="100">Autor</th> 
					<th width="120">Publicado em</th> 
					<th width="30">&nbsp;</th> 
				</tr> 
			</thead> 
			<tbody id="blogTbody"> 
				<?php
					$criteria = new Criteria();
					foreach(Blog::getList($criteria) as $blogObj):
						
						$blogId  = $blogObj->getId();
						$onclick = 'goToPage(\'blog\', \'edit\', \'blogId\', '.$blogId.')"';
				?>
				<tr class="gradeA" id="blogIdRow-<?php echo $blogId ?>">
					<td onclick="<?php echo $onclick ?>"><?php echo $blogObj->getTitle() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $blogObj->getVirtualTable()->getDescription() ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $blogObj->getPeople()->getNickname() ?></td> 
					<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $blogObj->getCreatedAt('d/m/Y H\hm') ?></td> 
					<td onclick="<?php echo $onclick ?>" style="vertical-align: middle"><?php echo ($blogObj->getIsDraft()?image_tag('backend/icons/control/16/document-library', array('title'=>'Rascunho')):'') ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody>
		</table>
	</div>
</div>