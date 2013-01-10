<?php

/**
 * chipCalculator actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class chipCalculatorActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeIndex($request){
    
  }
  
  public function executeGetChipSet($request){
    
  	$chipList      = $request->getParameter('chips');
  	$startStack    = $request->getParameter('startStack');
  	$players       = $request->getParameter('players');
  	$gameDuration  = $request->getParameter('gameDuration');
  	$blindDuration = $request->getParameter('blindDuration');
  	$allowRebuy    = $request->getParameter('allowRebuy');
  	$allowAddon    = $request->getParameter('allowAddon');
  	$allowAnte     = $request->getParameter('allowAnte');
  	$forceRandom   = $request->getParameter('forceRandom');
  	
  	$startStack = str_replace(' ', '', $startStack);
  	if( preg_match('/^[0-9]* ?k$/i', $startStack) )
  		$startStack = preg_replace('/k/i', '', $startStack)*1000;
  	
  	$chipList    = explode(',', $chipList);
  	$convertList = array();

	// Verifica se o stack é muito grande e usa as fichas baixas com valores de milhares
	foreach($chipList as $key=>$chip){
		
		if( $chip==10 && $startStack > 1000 && !in_array(1000, $chipList) ){
			
			$chipList[$key] *= 100;
			$convertList[$chip] = $chipList[$key];
			continue;
		}
		
		if( $startStack >= $chip*1000 && 
			($chip*1000) <= $startStack*0.2 ||
			max($chipList)*10 < $startStack ){
				
				// Se converteu ficha de 1 pra 1000 mas a ficha de 1000 ja estava na lista, então apaga a ficha de 1
				if( $chip==1 && in_array(1000, $chipList) ){
					
					unset($chipList[$key]);
					continue;
				}
				
				$chipList[$key] *= 1000;
				$convertList[$chip] = $chipList[$key];
			}
			
		if( !in_array($chip, $convertList) && $chip < 25 && $chip < $startStack/100 ||
			!in_array($chip, $convertList) && $chip < 50 && $startStack >= 20000 || 
			!in_array($chip, $convertList) && $chip < 100 && $startStack > 20000 || 
			!in_array($chip, $convertList) && $chip < 500 && $startStack > 50000 ){
			
			unset($chipList[$key]);
			continue;
		}
	}
	
	foreach($chipList as $key=>$chip)
		if( $chip >= $startStack )
			unset($chipList[$key]);
	
	sort($chipList);

	if( $forceRandom )
		$chipSet = $this->getChipSetRandom($chipList, $startStack);
	else
		$chipSet = $this->getChipSet($chipList, $startStack);
	
	if( is_null($chipSet) )
		Util::forceError('invalid chipSet');
	
	foreach($chipSet as $chipValue=>$chipTotalValue){
		
		if( $key = array_search($chipValue, $convertList) )
			$chipSet[$chipValue] = array('original'=>$key, 'totalValue'=>$chipTotalValue);
			
		if( $chipTotalValue==0 )
			unset($chipSet[$chipValue]);
	}
	
	
	
	
	
	
	
	
	
		
	$chipList = array_keys($chipSet);
//	prexit($chipSet);
//	prexit($chipList);

	// --------------------------------------
	
	$blindSetPercentList = array();
	$blindIncrasePercentList[100]   = array(4,8,12,16,20,24,30,40,50,60,70,80,100,120,150,200,250,300,350,400);
	$blindIncrasePercentList[200]   = array(4,8,12,16,20,24,30,40,50,60,70,80,100,120,150,200,250,300,350,400);
	$blindIncrasePercentList[300]   = array(6.67,13.33,20,26.67,33.33,40,50,66.67,83.33,100,133.33,166.67,200,266.67,200,400,533.33,666.67,800,933.33,1066.67,1200);
	$blindIncrasePercentList[400]   = array(4,8,12,16,20,24,30,40,50,60,70,80,100,120,150,200,250,300,350,400);
	$blindIncrasePercentList[500]   = array(4,8,12,16,20,24,28,32,36,40,50,60,70,80,100,120,160,200,240,280,320,400,480,560,640,600,1000);
	$blindIncrasePercentList[600]   = array(6.67,13.33,20,26.67,33.33,40,50,66.67,83.33,100,133.33,166.67,200,266.67,200,400,533.33,666.67,800,933.33,1066.67,1200);
	$blindIncrasePercentList[800]   = array(4,8,12,16,20,24,30,40,50,60,70,80,100,120,150,200,250,300,350,400);
	$blindIncrasePercentList[1000]  = array(4,8,12,16,20,24,30,40,50,60,70,80,100,120,150,200,250,300,350,400);
	$blindIncrasePercentList[1500]  = array(3.33,6.66,10,13.33,20,26.66,33.33,40,46.66,53.33,66.66,80,93.33,106.66,133.33,160,186.66,240,266.66,333.33,400,466.66,533.33,666.66,800,1000,1333.33);
	$blindIncrasePercentList[2000]  = array(4,8,12,16,20,24,30,40,50,60,70,80,100,120,150,200,250,300,350,400);
	$blindIncrasePercentList[2500]  = array(2,4,6,8,10,12,14,16,20,24,28,32,40,48,64,80,96,112,144,160,200,240,280,320,400,480,600,800);
	$blindIncrasePercentList[3000]  = array(1.67,3.33,5,6.66,16.66,20,23.33,26.66,33.33,40,46.66,53.33,66.66,80,93.33,120,133.33,166.66,200,233.33,266.66,333.33,400,500,666.66);
	$blindIncrasePercentList[4000]  = array(4,8,12,16,20,24,30,40,50,60,70,80,100,120,150,200,250,300,350,400);
	$blindIncrasePercentList[5000]  = array(2,3,4,6,8,10,12,16,20,24,32,40,48,56,64,80,100,120,140,160,200,300,400,600);
	$blindIncrasePercentList[6000]  = array(0.83,1.66,2.5,3.33,5,6.66,8.33,10,11.66,13.33,16.66,20,23.33,26.66,33.33,40,46.66,60,66.66,83.33,100,116.66,133.33,166.66,200,250,333.33);
	$blindIncrasePercentList[8000]  = array(2,3,4,6,8,10,12,16,20,24,32,40,48,56,64,80,100,120,140,160,200,300,400,600);
	$blindIncrasePercentList[10000] = array(2,3,4,6,8,10,12,16,20,24,32,40,48,56,64,80,100,120,140,160,200,300,400,600);
	$blindIncrasePercentList[15000] = array(0.33,0.66,1,1.33,2,2.66,3.33,4,4.66,5.33,6.66,8,9.33,10.66,13.33,16,18.66,24,26.66,33.33,40,46.66,53.33,66.66,80,100,133.33);
	$blindIncrasePercentList[20000] = array(0.25,0.5,0.75,1,1.5,2,2.5,3,3.5,4,5,6,7,8,10,12,14,18,20,25,30,35,40,50,60,75,100);
	$blindIncrasePercentList[30000] = array(0.66,1.33,2,2.66,3.33,4,4.66,5.33,6.66,8,9.33,12,13.33,16.66,20,23.33,26.66,33.33,40,50,66.66,100,133.33,166.66,200,266.66,333.33);
	$blindIncrasePercentList[40000] = array(0.5,0.75,1,1.25,1.5,1.75,2,2.5,3,3.5,4,5,6,7,9,10,12.5,15,17.5,20,25,30,37.5,50,75,100,125,150,200,250);
	$blindIncrasePercentList[50000] = array(0.4,0.8,1.2,1.6,2,2.4,2.8,3.2,4,4.8,5.6,7.2,8,10,12,14,16,20,24,30,40,60,80,100,120,160,200);
	$blindIncrasePercentList[100000] = array(2,2.4,2.8,3.6,4,5,6,7,8,10,12,15,20,30,40,50,60,80,100);
	
	$smallestChip    = min($chipList);
	$gameDurationMin = $gameDuration*60;
	$levels          = $gameDurationMin/$blindDuration;
	$bigBlind        = $startStack/($startStack > 10000?300:($startStack > 1000?100:($startStack >= 500?25:20)));
	$smallBlind      = floor($bigBlind/2);
	
	if( $smallBlind < $smallestChip ){
		
		$smallBlind = $smallestChip;
		$bigBlind   = $smallBlind*2;
	}

	if( $smallBlind%$smallestChip!=0 )
		$smallBlind = $bigBlind-$smallestChip;
	
	if( $smallBlind%$smallestChip!=0 ){
		
		$smallBlind = $smallestChip;
		$bigBlind   = $smallBlind*2;
	}
	
//	echo '<pre>';
//	echo "stack: $startStack\n";
//	echo "smallestChip: $smallestChip\n";
//	echo "game duration: $gameDurationMin minutos\n";
//	echo "levels: $levels\n";
//	echo "blind duration: $blindDuration\n";
//	echo "blind: $smallBlind/$bigBlind\n";
//	echo '<hr>';
	
	$timeElapsed = $blindDuration;
	
	$blindIncrasePercent = $blindIncrasePercentList[$startStack];
	$levelIncrase = 0;
	
	$blindSet = array();
	
	for($level=1; $level <= $levels && $level < count($blindIncrasePercent); $level++, $timeElapsed+=$blindDuration){
		
		$percent = ($timeElapsed*100/$gameDurationMin);
		
		$ok = ($smallBlind%$smallestChip==0);
		
//		echo sprintf('Level #%02d: %d / %d    - %02d min (%02d%%) - %s', $level, $smallBlind, $bigBlind, $blindDuration, $percent, $ok?'OK':'NOK');
//		echo "\n";
		$blindSet[] = "$smallBlind,$bigBlind";
		
		do{
			
			$bigBlindTmp = $startStack*$blindIncrasePercent[$level+$levelIncrase]/100;
			
			// Se o nobo blind for menor ou igual ao nivel anterior, usa a proxima sequencia das porcentagens
			if( $bigBlindTmp <= $bigBlind ){
				
				$levelIncrase++;
				$bigBlindTmp = $startStack*$blindIncrasePercent[$level+$levelIncrase]/100;
			}
			
			$smallBlindTmp = $bigBlindTmp/2;
			
			$fit = ($smallBlindTmp%$smallestChip)==0;
			
			// Se a configuração das fichas não conseguir pagar um small blind (Ex. a menor ficha sendo 50 não pode haver um small de 75);
			if( !$fit ){
	
				$smallBlindTmp = $smallBlind+$smallestChip;
				$bigBlindTmp   = $smallBlindTmp*2;
				break;
			}
		}while(!$fit || $bigBlindTmp <= $bigBlind);
		
			$bigBlind   = $bigBlindTmp;
			$smallBlind = $smallBlindTmp;
	}
	// --------------------------------------

	$chipSet['blindSet'] = $blindSet;	

	echo Util::parseInfo($chipSet);
	exit;
  }
	
	
	
  private function getChipSet($chipList, $startStack){
		
	$availableChips = count($chipList);
	
	$percentSetList = array(3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());
	
	$percentSetList[3][] = array(50, 30, 20); // Ideal para stacks até de 1000 com fichas: 25, 50, 100
	
	$percentSetList[4][] = array(50, 25, 15, 10); // Ideal para stacks até de 1000 com fichas: 10, 25, 50, 100
	$percentSetList[4][] = array(50, 30, 15, 5);  // Ideal para stacks até de 1000 com fichas: 5, 25, 50, 100
	
	$percentSetList[5][] = array(50, 30, 15, 5, 0); // Ideal para stacks até de 2500
	$percentSetList[5][] = array(0, 40, 30, 16, 10, 4); // Ideal para stacks até de 5000
	
	if( $startStack <= 7000 ){
		
		$percentSetList[5][] = array(71, 15, 9, 3, 3); // Ideal para stacks até 7000
		$percentSetList[5][] = array(70, 22, 4, 3, 2); // Ideal para stacks até 7000
	}
	
	$percentSetList[5][] = array(75, 20, 3, 1.25, 0.75); // Ideal para stacks acima de 10000
	$percentSetList[5][] = array(50, 40, 7, 2, 1); // Ideal para stacks até 10000
	$percentSetList[5][] = array(75, 20, 3.5, 1, 0.5); // Ideal para stacks acima de 10000
	$percentSetList[5][] = array(80, 14, 3, 2, 1); // Ideal para stacks acima de 30000
	
	if( $startStack <= 7000 ){
		
		$percentSetList[6][] = array(0, 20, 50, 12, 10, 8); // Ideal para stacks até 5000
		$percentSetList[6][] = array(0, 50, 20, 15, 10, 5); // Ideal para stacks até 7000
	}elseif( $startStack <= 10000 )
		$percentSetList[6][] = array(50, 30, 10, 6, 2.5, 1.5); // Ideal para stacks até 10000
		
	$percentSetList[6][] = array(75, 15, 5, 3, 1.25, 0.75); // Ideal para stacks acima de 10000
	$percentSetList[6][] = array(75, 15, 5, 3, 1.5, 0.5); // Ideal para stacks acima de 10000
	
	$attempts = count($percentSetList[$availableChips]);
	$attempt  = 0;
	
	if( !$attempts )
		return $this->getChipSetRandom($chipList, $startStack);

	$valid = false;
	
	do{
		
		$attempt++;
		
		$percentList = $percentSetList[$availableChips][$attempt-1];
		
		$chipSetObj = $this->buildChipSet($chipList, $percentList, $startStack);
		$chipSet = $chipSetObj->chipSet;			
		$chips   = $chipSetObj->chips;			
		
		try{
			
			$this->validateChipSet($chipSet, $startStack, $chips, $availableChips);

			$valid = true;
		}catch(Exception $e){

			$valid = false;
//				echo '<br>'.$e->getMessage().'<br><br><br>';
			$chipSet = array();
			continue;
		}
	}while( !$valid && $attempt < $attempts );
	
	if( empty($chipSet) )
		return $this->getChipSetRandom($chipList, $startStack);
	
	return $chipSet;
  }
	
  private function getChipSetRandom($chipList, $startStack){
		
	$attempts = 3000;
	$attempt  = 0;
	
	$availableChips = count($chipList);
	
	do{
		
		$attempt++;
		
		$percentTotal = 100;
		$percentList = array();
		foreach($chipList as $key=>$chip){
			
			if( $key==count($chipList) )
				$percent = $percentTotal;
			else
				$percent = rand(0, round($percentTotal*0.75));
			
			$percentTotal -= $percent;
			$percentList[] = $percent;
		}
		
		$chipSetObj = $this->buildChipSet($chipList, $percentList, $startStack);
		$chipSet = $chipSetObj->chipSet;			
		$chips   = $chipSetObj->chips;
					
		try{
			
			$this->validateChipSet($chipSet, $startStack, $chips, $availableChips);
			
			$valid = true;
		}catch(Exception $e){
			
			$valid = false;
//				echo '<br>'.$e->getMessage().'<br><br><br>';
			$chipSet = array();
			continue;
		}
//	}while( !$valid );
	}while( !$valid && $attempt < $attempts );
		
	if( empty($chipSet) )
		return null;
	
	return $chipSet;
  }
	
  private function buildChipSet($chipList, $percentList, $startStack){
	
	$stack = 0;
	$chips = 0;
//		echo "------------ATTEMPT #$attempt----------<br/>";
	
	$chipSet = array();
	
	rsort($chipList);
	
	$count = count($chipList);
	foreach($chipList as $key=>$chip){
		
		$percent = $percentList[$key];
		$count--;
		
		if( $count==0 ){
			
			$value = $startStack-$stack;
			
			if( $value <=0 )
				break;
		}else{
			
			$value = $startStack * $percent/100;
		}
		
		$chipsTmp = $value/$chip;
		
		if( $chipsTmp!=intval($chipsTmp) ){
			
			$chipsTmp    = round($chipsTmp);
			$value       = $chipsTmp*$chip;
			$percentDiff = $percent - ($value*100/$startStack);
			
			if( isset($percentList[$key+2]) ){
				
				$percentList[$key+1] += $percentDiff*0.75;
				$percentList[$key+2] += $percentDiff*0.25;
			}elseif( isset($percentList[$key+1]) ){
				
				$percentList[$key+1] += $percentDiff;
			}else{
				
				$percentList[$key] += $percentDiff;
			}
		}
		
//			echo "$chip => $value ($chipsTmp chips)";
		
		$chipSet[$chip] = $value;
		$stack += $value;
		$chips += $chipsTmp;
		
//			echo '<hr>';
	}
	
//		echo "$stack ($chips chips)";

	$chipSetObj = new StdClass();
	$chipSetObj->chipSet = $chipSet;
	$chipSetObj->chips   = $chips;

	return $chipSetObj;
  }
	
  private function validateChipSet($chipSet, $startStack, $chips, $availableChips){
		
	// Verifica se a soma dos valores das fichas é igual ao stack inicial desejado
	if( array_sum($chipSet)!=$startStack )
		throw new Exception('INVÁLIDO - Valor errado');
	
	foreach($chipSet as $chipValue=>$chipsValue){

		$chipsTmp = $chipsValue/$chipValue;
		// Se o valor em fichas de alguma ficha for menor que zero, a configuração não é válida
		if( $chipsValue < 0 )
			throw new Exception('INVÁLIDO - Fichas negativas');
		
		// Se a quantidade de fichas maior que a média de fichas por valor, a configuração não é válida
		if( $chipsTmp > ($chips/$availableChips*2) || $chipsTmp > 10 )
			throw new Exception('INVÁLIDO - Fichas demais '."($chipsTmp > ".($chips/$availableChips*2).")");
	}
  }
}
