    <div class="widget">
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable">
		    <thead>
				<tr>
					<th>Data</th> 
					<th>Endereço IP</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php
					$criteria = new Criteria();
					$criteria->addDescendingOrderByColumn( AccessAdminLogPeer::CREATED_AT );
					
					foreach($userAdminObj->getAccessAdminLogList($criteria) as $accessLogAdminObj):
				?>
				<tr class="gradeA">
					<td width="20%" class="center"><?php echo $accessLogAdminObj->getCreatedAt('d/m/Y H:i:s') ?></td> 
					<td width="80%"><?php echo $accessLogAdminObj->getIpAddress() ?></td> 
				</tr> 
				<?php endforeach; ?>
			</tbody> 
		</table>
	</div>
