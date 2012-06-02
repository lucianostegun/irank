<style>

</style>
<?php
	$criteria = new Criteria();
	if( $clubId )
		$criteria->add( ClubPeer::ID, $clubId);
	
	foreach(CashTable::getList($criteria) as $cashTableObj):
		
		$cashTableId  = $cashTableObj->getId();
		$onclick = 'goToPage(\'cashTable\', \'edit\', \'cashTableId\', '.$cashTableId.')"';
?>
<div class="cashTableLayout" ondblclick="<?php echo $onclick ?>" style="position: absolute; width: 250px; height: 153px; left: 0px; top: 0px; background: url('/images/backend/cashTable/thumb/table.png') no-repeat">
	<div style="width:100%; text-align: center; position: absolute; top: 30px; font-size: 12px; color: #FAFAFA; font-weight: bold"><?php echo $cashTableObj->getCashTableName() ?></div>
	<div style="width:100%; text-align: center; position: absolute; top: 50px; font-size: 12px; color: #FAFAFA; font-weight: bold"><?php echo $cashTableObj->getTableStatus(true) ?></div>
	<div style="width:100%; text-align: center; position: absolute; top: 70px; font-size: 12px; color: #FAFAFA; font-weight: bold"><?php echo $cashTableObj->getPlayers() ?> jogadores</div>
</div>
<?php endforeach; ?>
<div class="clear"></div>

<script>
	$('.cashTableLayout').draggable({
		stop: function(event, ui){
			alert(event.pageX+'x'+event.pageY);
		}
	});
</script>