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
    
  	$chipList    = $request->getParameter('chips');
  	$startStack  = $request->getParameter('startStack');
  	$players     = $request->getParameter('players');
  	$forceRandom = $request->getParameter('forceRandom');
  	
  	$startStack = str_replace(' ', '', $startStack);
  	if( preg_match('/^[0-9]* ?k$/i', $startStack) )
  		$startStack = preg_replace('/k/i', '', $startStack)*1000;
  	
  	$chipList    = explode(',', $chipList);
  	$convertList = array();
  	
	// Verifica se o stack é muito grande e usa as fichas baixas com valores de milhares
	foreach($chipList as $key=>$chip)
		if( $startStack >= $chip*1000 && 
			($chip*1000) <= $startStack*0.2 ||
			max($chipList)*10 < $startStack ){
				
				$chipList[$key] *= 1000;
				$convertList[$chip] = $chipList[$key];
			}
	
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
	$percentSetList[5][] = array(70, 22, 4, 3, 2); // Ideal para stacks até 7000
	$percentSetList[5][] = array(75, 20, 3, 1.25, 0.75); // Ideal para stacks acima de 10000
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
			}else{
				
				$percentList[$key+1] += $percentDiff;
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
		if( $chipsTmp > ($chips/$availableChips*2) )
			throw new Exception('INVÁLIDO - Fichas demais '."($chipsTmp > ".($chips/$availableChips*2).")");
	}
  }
}
