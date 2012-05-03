<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'ranking_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingLivePeer extends BaseRankingLivePeer
{
	
	public static function validateScoreFormula($scoreFormula){
		
		$position     = 1;
		$events       = 1;
		$prize        = 1;
		$players      = 1;
		$totalBuyins  = 1;
		$buyin        = 1;
		$itm          = 1;
		
		$scoreFormulaOption = MyTools::getRequestParameter('scoreFormulaOption');
		$scoreFormulaCustom = MyTools::getRequestParameter('scoreFormulaCustom');
		
		if( $scoreFormulaOption=='multiple' )
			$scoreFormulaList = explode('|', $scoreFormulaCustom);
		else
			$scoreFormulaList = array($scoreFormula);
		
		$validate = true;
		
		foreach($scoreFormulaList as $scoreFormula){
			
			$scoreFormula = preg_replace('/^.*: ?/', '', $scoreFormula);
			$validate &= self::validateFormulaPart($scoreFormula);
		}

		if( !$validate ){
			
			MyTools::setError('scoreFormula', 'Fórmula de pontuação inválida');
			return false;
		}

		return true;
	}

	public static function validateFormulaPart($formula){
		
		$position     = 1;
		$events       = 1;
		$prize        = 1;
		$players      = 1;
		$totalBuyins  = 1;
		$buyin        = 1;
		$itm          = 1;
		
		$scoreFormulaOption = MyTools::getRequestParameter('scoreFormulaOption');
		
		$formula = strtolower($formula);
		
		$patternList = array('/posi[cç][aã]o|position/'=>'$position',
							 '/eventos|events/'=>'$events',
							 '/pr[eê]mio|prize/'=>'$prize',
							 '/jogadores|players/'=>'$players',
							 '/buyins/'=>'$totalBuyins',
							 '/buyin/'=>'$buyin',
							 '/itm/'=>'$itm',
							 '/arred_cima/'=>'ceil',
							 '/arred_baixo/'=>'floor',
							 '/%/'=>'/100');

		// Valida se tem alguma variável ou função não permitida
		$formulaCheck = $formula;
		foreach($patternList as $pattern=>$replace)
			$formulaCheck = preg_replace($pattern, '1', $formulaCheck);
		
		$formulaCheck  = !preg_match('/[^0-9 \.)\(%\-\+\*\/]/', $formulaCheck);
		$formulaResult = null;
		
		// A partir daqui, com a fórmula já validada, verifica se a expressão matemática é valida
		if( $formulaCheck ){
			
			foreach($patternList as $pattern=>$replace)
				$formula = preg_replace($pattern, $replace, $formula);
			
			@eval('$formulaResult = ('.$formula.');');
		}

		if( $formulaResult===null || !is_numeric($formulaResult) )
			return false;

		return true;
	}
	
	public static function validateBlindTime($blindTime){
		
		$blindTime = strtolower($blindTime);
		$blindTime = str_replace(' ', '', $blindTime);
		
		if( preg_match('/^[0-5]?[0-9]+(m(in)?|h)$/', $blindTime) )
			return true;
		else
			return Validate::validateTime($blindTime);
	}
	
	public static function validatePrizeSplit($prizeSplit){
		
		$prizeConfig = split(EventLive::PRIZE_SPLIT_PATTERN, $prizeSplit);
		
		return array_sum($prizeConfig)==100;
	}
}
