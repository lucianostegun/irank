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
  	
  	$this->facebookMetaList = array();
	$this->facebookMetaList['image'] = array('http://[host]/images/chipCalculator/logo.png');
	$this->facebookMetaList['url']         = 'http://www.irank.com.br/chipCalculator';
  }
  
  public function executeIndex($request){
    
  }
  
  public function executeGetChipSet($request){
    
  	$gameDuration  = $request->getParameter('gameDuration');
  	$blindDuration = $request->getParameter('blindDuration');
  	$allowAnte     = $request->getParameter('allowAnte');
  	$forceRandom   = $request->getParameter('forceRandom');
  	$httpReferer   = $_SERVER['HTTP_REFERER'];
  	
  	if( !preg_match('/https?:\/\/(www\.)*irank\.com\.br\/((debug|index)\.php\/)?chipCalculator.*/', $httpReferer) &&
  		!preg_match('/http:\/\/irank\/((debug|index)\.php\/)?chipCalculator.*/', $httpReferer) ){
  		
  		Log::doLog('Tentativa de acesso a calculadora por página sem referência', false, array(), Log::LOG_CRITICAL);
  		throw new Exception('Invalid reference page request');
  	}
  	
  	try{
  		
		$chipSet = $this->getChipSet($request);
		prexit($chipSet);
  	}catch(Exception $e){
  		
  		Util::forceError('invalidChipset - '.$e->getMessage());
  	}

	exit;
  }
  
  public function getChipSet($request){
  	
  	$chipList   = $request->getParameter('chips');
  	$startStack = $request->getParameter('startStack');
  	$players    = $request->getParameter('players');
  	$allowRebuy = $request->getParameter('allowRebuy');
  	$allowAddon = $request->getParameter('allowAddon');
  	
  	$startStack = str_replace(' ', '', $startStack);
  	if( preg_match('/^[0-9]* ?k$/i', $startStack) )
  		$startStack = preg_replace('/k/i', '', $startStack)*1000;
  	
  	$chipList                = explode(',', $chipList);
  	$convertList             = array();
  	$chipAmountList          = array();
  	$chipAmountPerPlayerList = array();
  	$requiredChipsValue = $startStack*$players; // Total necessário em fichas para atender todos o jogadores

  	// Tratamento dos valores das fichas, converte os valores (caso necessário) e monta o array de quantidade disponível para cada ficha
  	foreach($chipList as $key=>$chip){
		
		$chipAmount = $request->getParameter('chipAmount-'.$chip);
		
		if( $chip <= 10 && $startStack > $chip*1000 )
			$chip *= 1000;
		
		$chipAmountList[$chip]          = $chipAmount;
		$chipAmountPerPlayerList[$chip] = floor($chipAmount/$players);
		
		$chipList[$key] = $chip;
  	}
  	
  	rsort($chipList);
  	krsort($chipAmountList);
  	
  	// Calcula o valor total da soma das fichas disponíveis
  	$availableChipsValue = 0;
  	foreach($chipList as $chip)
  		$availableChipsValue += $chip*$chipAmountList[$chip];
  	
  	// Se o valor total de fichas for menor do que a quantidade necessária para todos os jogadores, nem continua o cálculo de distribuição
  	if( $availableChipsValue < $requiredChipsValue )
  		throw new Exception('Quantidade de fichas insuficientes');
  		
  	$totalChips        = array_sum($chipAmountList);
  	$maxChipsPerPlayer = floor($totalChips/$players);

	echo '<pre>';
	echo "Stack inicial:          $startStack<br/>";
	echo "Fichas disponíveis:     ".implode(', ', $chipList)."<br/>";
	echo "Jogadores:              $players<br/>";
	echo "Total necessário:       $requiredChipsValue<br/>";
	echo "Total disponível:       $availableChipsValue<br/>";
	echo "Total de fichas:        $totalChips<br/>";
	echo "Max fichas por jogador: $maxChipsPerPlayer<br/>";
	echo "<hr/>";
	foreach($chipList as $chip)
  		echo "$chip: ".$chipAmountList[$chip]." (max. de  por ".$chipAmountPerPlayerList[$chip]." jogador)<br/>";
	echo "<hr/>";
	
	$playerList = array();
	for($playerIndex=0; $playerIndex < $players; $playerIndex++){
		
		$player = array_fill_keys($chipList, 0);
		$player['complete'] = 0;
		$playerList[] = $player;
	}
	
	$count = 0;
	do{
		
		foreach($chipList as $chip){
			
			foreach($playerList as $key=>$player){
				
				if( $chipAmountList[$chip]==0 )
					break;
				
				$player[$chip] += $chip;
				$chipAmountList[$chip]--;
				
				if( array_sum($player)>=$startStack )
					$player['complete'] = true;
				
				$playerList[$key] = $player;
			}
		}
		
		$complete = true;
		foreach($playerList as $player)
			$complete = $complete&&$player['complete'];
			
	}while(!$complete);
	
	foreach($playerList as &$player){
		
		unset($player['complete']);
//		while( array_sum($player) != $startStack ){
			
			if( array_sum($player) > $startStack )
				$player = $this->decraseChipSet($player, $chipList, $startStack);
			
//			if( array_sum($player) < $startStack )
//				$player = $this->incraseChipSet($player, $chipList, $startStack);
//		}
		break;
	}
			
	print_r($chipAmountList);	
	echo "<hr/>";
	prexit($playerList);
	
	
	
	
	
	
	
	exit;	
  }
  
  public function decraseChipSet($chipSet, $chipList, $startStack){
  	
	$count = 0;
	while( array_sum($chipSet) > $startStack && $count++ < 30 ){
		
		foreach($chipList as $chip){
			
			$difference = array_sum($chipSet)-$startStack;
			if( $chip > $difference )
				continue;
			
			$chipSet[$chip] -= $chip;
			
			if( array_sum($chipSet) <= $startStack )
				break;
		}
	}
	
	return $chipSet;
  }

  public function incraseChipSet($chipSet, $chipList, $startStack){
  	
  	sort($chipList);
  	
	$count = 0;
	while( array_sum($chipSet) < $startStack && $count++ < 50 ){
		
		foreach($chipList as $chip){
			
			$difference = $startStack-array_sum($chipSet);
			
			if( $chip <= $difference )
				$chipSet[$chip] += $chip;
				
			if( array_sum($chipSet) >= $startStack )
				break;
		}
	}
	
	return $chipSet;
  }
  
  private function validateChipSet($chipSet, $chipAmountList, $startStack, $players){
		
	// Verifica se a soma dos valores das fichas é igual ao stack inicial desejado
	if( array_sum($chipSet)!=$startStack )
		throw new Exception('Valor errado');
	
	foreach($chipSet as $chipValue=>$chipsValue){

		$chipsNeeded = ($chipsValue/$chipValue)*$players;
		if( $players > 0 && $chipsNeeded > $chipAmountList[$chipValue] )
			throw new Exception('INVÁLIDO - Fichas insuficientes');

		$chipsTmp = $chipsValue/$chipValue;
		// Se o valor em fichas de alguma ficha for menor que zero, a configuração não é válida
		if( $chipsValue < 0 )
			throw new Exception('Fichas negativas');
	}
  }
}
