<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Glossário de termos</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th>Termo</th>
				</tr> 
			</thead> 
			<tbody id="glossaryTbody">
				<?php
					$criteria = new Criteria();
					foreach(Glossary::getList($criteria) as $glossaryObj):
						
						$glossaryId  = $glossaryObj->getId();
						$onclick = 'goToPage(\'glossary\', \'edit\', \'glossaryId\', '.$glossaryId.')"';
				?>
				<tr class="gradeA" id="glossaryIdRow-<?php echo $glossaryId ?>">
					<td onclick="<?php echo $onclick ?>"><?php echo $glossaryObj->getTerm() ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>