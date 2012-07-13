<?php
	$numStatList = People::getFullResume($peopleObj->getId(), $userSiteObj->getId());
	foreach($numStatList as &$numStat){
		
		$numStat = array('value'=>$numStat);
	}
	
    $numStatList['fee']['label']      = 'Taxas';
    $numStatList['buyin']['label']    = 'Buyin';
    $numStatList['addon']['label']    = 'Addon';
    $numStatList['rebuy']['label']    = 'Rebuy';
    $numStatList['prize']['label']    = 'Prêmio';
    $numStatList['score']['label']    = 'Pontos';
    $numStatList['balance']['label']  = 'Balanço';
    $numStatList['average']['label']  = 'Média';
    $numStatList['rankings']['label'] = 'Rankings';
    $numStatList['events']['label']   = 'Eventos';
    $numStatList['comments']['label'] = 'Coment.';
    $numStatList['photos']['label']   = 'Fotos';
    
    $numStatList['fee']['decimalPlaces']      = '2';
    $numStatList['buyin']['decimalPlaces']    = '2';
    $numStatList['addon']['decimalPlaces']    = '2';
    $numStatList['rebuy']['decimalPlaces']    = '2';
    $numStatList['prize']['decimalPlaces']    = '2';
    $numStatList['score']['decimalPlaces']    = '3';
    $numStatList['balance']['decimalPlaces']  = '2';
    $numStatList['average']['decimalPlaces']  = '2';
    $numStatList['rankings']['decimalPlaces'] = '0';
    $numStatList['events']['decimalPlaces']   = '0';
    $numStatList['comments']['decimalPlaces'] = '0';
    $numStatList['photos']['decimalPlaces']   = '0';
?>
<div class="numStats">
	<ul>
		<?php
			$i = 0;
			foreach($numStatList as $key=>$info):
				$i++;
				
				$label         = $info['label'];
				$value         = $info['value'];
				$decimalPlaces = $info['decimalPlaces'];
		?>
    	<li class="<?php echo ($i==count($numStatList)?'last':'') ?>" title="<?php echo Util::formatFloat($value, true, $decimalPlaces) ?>">
    		<label><?php echo Util::formatFloat($value, true, ($key=='average'?3:0)) ?></label>
    		<span><?php echo $label ?></span>
    	</li>
    	<?php endforeach; ?>
    </ul>
    <div class="clear"></div>
</div>
<div class="sidebarSep"></div>