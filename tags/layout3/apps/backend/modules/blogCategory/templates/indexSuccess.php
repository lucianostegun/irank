<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Categorias de artigos</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th>Nome</th> 
				</tr> 
			</thead> 
			<tbody id="blogCategoryTbody"> 
				<?php
					$criteria = new Criteria();
					foreach(VirtualTable::getList('blogCategory') as $blogCategoryObj):
						
						$blogCategoryId  = $blogCategoryObj->getId();
						$onclick = 'goToPage(\'blogCategory\', \'edit\', \'blogCategoryId\', '.$blogCategoryId.')"';
				?>
				<tr class="gradeA" id="blogCategoryIdRow-<?php echo $blogCategoryId ?>">
					<td onclick="<?php echo $onclick ?>"><?php echo $blogCategoryObj->getDescription() ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>